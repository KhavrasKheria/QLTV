<?php

namespace App\Http\Controllers;

use App\Models\TheDocGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TheDocGiaController extends Controller
{
    /**
     * Hiển thị danh sách độc giả với tìm kiếm và lọc
     */
    public function index(Request $request)
    {
        $query = TheDocGia::query();

        // Tìm kiếm theo mã hoặc tên độc giả
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('MaDocGia', 'LIKE', "%{$search}%")
                  ->orWhere('TenDocGia', 'LIKE', "%{$search}%");
            });
        }

        // Lọc theo khoa
        if ($request->filled('khoa')) {
            $query->where('Khoa', $request->khoa);
        }

        // Lọc theo trạng thái
        if ($request->filled('trang_thai')) {
            $query->where('TrangThai', $request->trang_thai);
        }

        // Sắp xếp theo tên
        $query->orderBy('TenDocGia', 'asc');

        // Phân trang
        $docGias = $query->paginate(10);

        // Lấy danh sách khoa để hiển thị trong dropdown lọc
        $danhSachKhoa = TheDocGia::select('Khoa')
            ->whereNotNull('Khoa')
            ->where('Khoa', '!=', '')
            ->distinct()
            ->orderBy('Khoa')
            ->pluck('Khoa');

        return view('thedocgia.index', compact('docGias', 'danhSachKhoa'));
    }

    /**
     * Lưu độc giả mới
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'MaDocGia' => 'required|unique:thedocgia,MaDocGia|max:20',
            'TenDocGia' => 'required|max:100',
            'Khoa' => 'nullable|max:100',
            'Lop' => 'nullable|max:50',
            'TrangThai' => 'required|in:HoatDong,Khoa',
        ], [
            'MaDocGia.required' => 'Mã độc giả không được để trống',
            'MaDocGia.unique' => 'Mã độc giả đã tồn tại',
            'MaDocGia.max' => 'Mã độc giả không được quá 20 ký tự',
            'TenDocGia.required' => 'Tên độc giả không được để trống',
            'TenDocGia.max' => 'Tên độc giả không được quá 100 ký tự',
            'TrangThai.required' => 'Trạng thái không được để trống',
            'TrangThai.in' => 'Trạng thái không hợp lệ',
        ]);

        try {
            // Tạo độc giả mới
            TheDocGia::create($validated);

            return redirect()->route('thedocgia.index')
                ->with('success', 'Thêm độc giả thành công!');
        } catch (\Exception $e) {
            return redirect()->route('thedocgia.index')
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị chi tiết độc giả
     */
    public function show($maDocGia)
    {
        $docGia = TheDocGia::findOrFail($maDocGia);
        
        // Lấy lịch sử mượn trả nếu có
        $lichSuMuonTra = $docGia->muonTras()
            ->with('sach')
            ->orderBy('NgayMuon', 'desc')
            ->get();

        return view('thedocgia.show', compact('docGia', 'lichSuMuonTra'));
    }

    /**
     * Hiển thị form sửa độc giả
     */
    public function edit($maDocGia)
    {
        $docGia = TheDocGia::findOrFail($maDocGia);
        return view('thedocgia.edit', compact('docGia'));
    }

    /**
     * Cập nhật thông tin độc giả
     */
    public function update(Request $request, $maDocGia)
    {
        $docGia = TheDocGia::findOrFail($maDocGia);

        // Validate dữ liệu
        $validated = $request->validate([
            'TenDocGia' => 'required|max:100',
            'Khoa' => 'nullable|max:100',
            'Lop' => 'nullable|max:50',
            'TrangThai' => 'required|in:HoatDong,Khoa',
        ], [
            'TenDocGia.required' => 'Tên độc giả không được để trống',
            'TenDocGia.max' => 'Tên độc giả không được quá 100 ký tự',
            'TrangThai.required' => 'Trạng thái không được để trống',
            'TrangThai.in' => 'Trạng thái không hợp lệ',
        ]);

        try {
            $docGia->update($validated);

            return redirect()->route('thedocgia.index')
                ->with('success', 'Cập nhật thông tin độc giả thành công!');
        } catch (\Exception $e) {
            return redirect()->route('thedocgia.index')
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Xóa độc giả
     */
    public function destroy($maDocGia)
    {
        try {
            $docGia = TheDocGia::findOrFail($maDocGia);

            // Kiểm tra xem độc giả có lịch sử mượn sách không
            if ($docGia->muonTras()->exists()) {
                return redirect()->route('thedocgia.index')
                    ->with('error', 'Không thể xóa độc giả vì đã có lịch sử mượn sách!');
            }

            $docGia->delete();

            return redirect()->route('thedocgia.index')
                ->with('success', 'Xóa độc giả thành công!');
        } catch (\Exception $e) {
            return redirect()->route('thedocgia.index')
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Thay đổi trạng thái độc giả (Hoạt động <-> Khóa)
     */
    public function toggleStatus($maDocGia)
    {
        try {
            $docGia = TheDocGia::findOrFail($maDocGia);
            
            $docGia->TrangThai = ($docGia->TrangThai == 'HoatDong') ? 'Khoa' : 'HoatDong';
            $docGia->save();

            $status = ($docGia->TrangThai == 'HoatDong') ? 'mở khóa' : 'khóa';

            return redirect()->route('thedocgia.index')
                ->with('success', "Đã {$status} độc giả thành công!");
        } catch (\Exception $e) {
            return redirect()->route('thedocgia.index')
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Tìm kiếm độc giả qua API (cho QR Scanner)
     */
    public function search(Request $request)
    {
        $maDocGia = $request->input('ma_doc_gia');
        
        $docGia = TheDocGia::where('MaDocGia', $maDocGia)->first();

        if ($docGia) {
            return response()->json([
                'success' => true,
                'data' => $docGia
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy độc giả'
        ], 404);
    }
}