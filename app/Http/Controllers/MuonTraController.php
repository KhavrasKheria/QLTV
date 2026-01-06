<?php

namespace App\Http\Controllers;

use App\Models\MuonTra;
use App\Models\MuonTraChiTiet;
use App\Models\Sach;
use App\Models\TheDocGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MuonTraController extends Controller
{
    /**
     * Trang mượn sách
     */
    public function index()
    {
        return view('muontra.index', [
            'docGias' => TheDocGia::where('TrangThai', 'HoatDong')->get(),
            'sachs'   => Sach::where('SoLuong', '>', 0)->get(),
            'hanTraMacDinh' => Carbon::now()->addDays(7)->format('Y-m-d'),
        ]);
    }

    /**
     * Lưu phiếu mượn (NHIỀU SÁCH – TỐI ĐA 3)
     */
    public function store(Request $request)
    {
        $request->validate([
            'MaDocGia'  => 'required|exists:thedocgia,MaDocGia',
            'ISBN13s'   => 'required|array|min:1|max:3',
            'ISBN13s.*' => 'exists:sach,ISBN13',
            'HanTra'    => 'nullable|date|after_or_equal:today',
        ], [
            'MaDocGia.required' => 'Vui lòng chọn độc giả',
            'MaDocGia.exists' => 'Độc giả không tồn tại',
            'ISBN13s.required' => 'Vui lòng chọn ít nhất 1 sách',
            'ISBN13s.min' => 'Vui lòng chọn ít nhất 1 sách',
            'ISBN13s.max' => 'Chỉ được mượn tối đa 3 cuốn sách',
            'ISBN13s.*.exists' => 'Sách không tồn tại',
            'HanTra.after_or_equal' => 'Hạn trả phải từ ngày hôm nay trở đi',
        ]);

        // Kiểm tra độc giả còn phiếu đang mượn
        $dangMuon = MuonTra::where('MaDocGia', $request->MaDocGia)
            ->where('TrangThai', 'DangMuon')
            ->exists();

        if ($dangMuon) {
            return back()
                ->withErrors(['MaDocGia' => 'Độc giả chưa trả sách của lần mượn trước'])
                ->withInput();
        }

        try {
            DB::transaction(function () use ($request) {
                $hanTra = $request->HanTra
                    ? Carbon::parse($request->HanTra)
                    : Carbon::now()->addDays(7);

                // Tạo phiếu mượn
                $muonTra = MuonTra::create([
                    'MaDocGia'  => $request->MaDocGia,
                    'user_id'   => Auth::id(),
                    'NgayMuon'  => now(),
                    'HanTra'    => $hanTra,
                    'TrangThai' => 'DangMuon',
                ]);

                // Tạo chi tiết cho từng sách
                foreach ($request->ISBN13s as $isbn) {
                    $sach = Sach::lockForUpdate()->where('ISBN13', $isbn)->firstOrFail();

                    if ($sach->SoLuong <= 0) {
                        throw new \Exception("Sách '{$sach->TenSach}' đã hết");
                    }

                    // Trừ số lượng
                    $sach->decrement('SoLuong');

                    // Lưu chi tiết mượn
                    MuonTraChiTiet::create([
                        'MaMuon' => $muonTra->MaMuon,
                        'ISBN13' => $isbn,
                    ]);
                }
            });

            return redirect()
                ->route('muontra.lichsu')
                ->with('success', 'Mượn sách thành công! Vui lòng nhớ trả đúng hạn.');

        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Lịch sử mượn – trả
     */
    public function lichsu(Request $request)
    {
        $query = MuonTra::with(['chiTiet.sach', 'docGia', 'user']);

        // Lọc theo trạng thái
        if ($request->filled('trangthai')) {
            $query->where('TrangThai', $request->trangthai);
        }

        // Sắp xếp theo ngày mượn
        $sapXep = $request->get('sapxep', 'desc');
        $query->orderBy('NgayMuon', $sapXep);

        $muonTras = $query->get();

        return view('muontra.lichsu', [
            'muonTras' => $muonTras,
        ]);
    }

    /**
     * Chi tiết phiếu mượn
     */
    public function chiTiet($MaMuon)
    {
        $phieuMuon = MuonTra::with(['docGia', 'user', 'chiTiet.sach'])
            ->findOrFail($MaMuon);

        return view('muontra.chi-tiet', compact('phieuMuon'));
    }

    /**
     * Trả TOÀN BỘ phiếu mượn
     */
    public function traPhieu($MaMuon)
    {
        try {
            DB::transaction(function () use ($MaMuon) {
                $muonTra = MuonTra::with('chiTiet.sach')
                    ->where('MaMuon', $MaMuon)
                    ->where('TrangThai', 'DangMuon')
                    ->firstOrFail();

                // Cộng lại số lượng sách
                foreach ($muonTra->chiTiet as $ct) {
                    if ($ct->sach) {
                        $ct->sach->increment('SoLuong');
                    }
                }

                // Cập nhật phiếu
                $muonTra->update([
                    'TrangThai' => 'DaTra',
                    'NgayTra'   => now(),
                ]);
            });

            return back()->with('success', 'Trả sách thành công!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Có lỗi xảy ra khi trả sách: ' . $e->getMessage()]);
        }
    }

    /**
     * Gia hạn phiếu mượn
     */
    public function giaHan(Request $request, $MaMuon)
    {
        $request->validate([
            'HanTraMoi' => 'required|date|after:today',
        ], [
            'HanTraMoi.required' => 'Vui lòng chọn hạn trả mới',
            'HanTraMoi.after' => 'Hạn trả mới phải sau ngày hôm nay',
        ]);

        $phieuMuon = MuonTra::where('MaMuon', $MaMuon)
            ->where('TrangThai', 'DangMuon')
            ->firstOrFail();

        $phieuMuon->update([
            'HanTra' => $request->HanTraMoi,
        ]);

        return back()->with('success', 'Gia hạn phiếu mượn thành công!');
    }
}