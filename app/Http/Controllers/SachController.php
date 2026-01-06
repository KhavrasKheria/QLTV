<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\TacGia;
use App\Models\TheLoai;
use App\Models\NhaXuatBan;

class SachController extends Controller
{
    /**
     * Hiển thị danh sách sách
     */
    public function index(Request $request)
    {
        $query = Sach::with(['nhaXuatBan', 'tacGias', 'theLoais']);

        $notFound = false;

        if ($request->filled('isbn')) {
            $query->where('ISBN13', $request->isbn);

            // kiểm tra tồn tại
            if (!Sach::where('ISBN13', $request->isbn)->exists()) {
                $notFound = true;
            }
        }

        $sachs = $query->get();

        return view('sach.index', compact('sachs', 'notFound'));
    }


    /**
     * Form thêm sách
     */
    public function create()
    {
        $tacGias = TacGia::all();
        $theLoais = TheLoai::all();
        $nhaXuatBans = NhaXuatBan::all();

        return view('sach.create', compact('tacGias', 'theLoais', 'nhaXuatBans'));
    }

    /**
     * Lưu sách mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'ISBN13'      => 'required|size:13|unique:sach,ISBN13',
            'TenSach'     => 'required',
            'TomTat'      => 'nullable',
            'NguoiDich'   => 'nullable',
            'SoLuong'     => 'required|integer',
            'SoTrang'     => 'required|integer',
            'NamXuatBang' => 'required|integer',
            'TrangThai'   => 'required|in:Con,Het,ThuThuDangXuLy',
            'MaVT'        => 'required',
            'MaNXB'       => 'nullable|integer',
            'Anh'         => 'nullable|file|image|mimes:jpg,jpeg,png,gif|max:2048',
            'tacGias'     => 'nullable|array',
            'theLoais'    => 'nullable|array',
        ]);

        // Upload ảnh
        $anhPath = 'img_book/' . $request->ISBN13 . '.jpg';
        if ($request->hasFile('Anh')) {
            $file = $request->file('Anh');
            $filename = $request->ISBN13 . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img_book'), $filename);
            $anhPath = 'img_book/' . $filename;
        }

        $sach = Sach::create([
            'ISBN13'      => $request->ISBN13,
            'TenSach'     => $request->TenSach,
            'TomTat'      => $request->TomTat,
            'NguoiDich'   => $request->NguoiDich,
            'SoLuong'     => $request->SoLuong,
            'SoTrang'     => $request->SoTrang,
            'NamXuatBang' => $request->NamXuatBang,
            'TrangThai'   => $request->TrangThai,
            'MaVT'        => $request->MaVT,
            'MaNXB'       => $request->MaNXB,
            'Anh'         => $anhPath,
        ]);

        if ($request->tacGias) {
            $sach->tacGias()->attach($request->tacGias);
        }

        if ($request->theLoais) {
            $sach->theLoais()->attach($request->theLoais);
        }

        return redirect()->route('sach.index')->with('success', 'Thêm sách thành công!');
    }

    /**
     * Form sửa sách
     */
    public function edit($ISBN13)
    {
        $sach = Sach::with('tacGias', 'theLoais')->findOrFail($ISBN13);
        $tacGias = TacGia::all();
        $theLoais = TheLoai::all();
        $nhaXuatBans = NhaXuatBan::all();

        return view('sach.edit', compact('sach', 'tacGias', 'theLoais', 'nhaXuatBans'));
    }

    /**
     * Cập nhật sách
     */
    public function update(Request $request, $ISBN13)
    {
        $request->validate([
            'TenSach'     => 'required',
            'TomTat'      => 'nullable',
            'NguoiDich'   => 'nullable',
            'SoLuong'     => 'required|integer',
            'SoTrang'     => 'required|integer',
            'NamXuatBang' => 'required|integer',
            'TrangThai'   => 'required|in:Con,Het,ThuThuDangXuLy',
            'MaVT'        => 'required',
            'MaNXB'       => 'nullable|integer',
            'Anh'         => 'nullable|file|image|mimes:jpg,jpeg,png,gif|max:2048',
            'tacGias'     => 'nullable|array',
            'theLoais'    => 'nullable|array',
        ]);

        $sach = Sach::findOrFail($ISBN13);

        $anhPath = $sach->Anh;
        if ($request->hasFile('Anh')) {
            $file = $request->file('Anh');
            $filename = $sach->ISBN13 . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img_book'), $filename);
            $anhPath = 'img_book/' . $filename;
        }

        $sach->update([
            'TenSach'     => $request->TenSach,
            'TomTat'      => $request->TomTat,
            'NguoiDich'   => $request->NguoiDich,
            'SoLuong'     => $request->SoLuong,
            'SoTrang'     => $request->SoTrang,
            'NamXuatBang' => $request->NamXuatBang,
            'TrangThai'   => $request->TrangThai,
            'MaVT'        => $request->MaVT,
            'MaNXB'       => $request->MaNXB,
            'Anh'         => $anhPath,
        ]);

        $sach->tacGias()->sync($request->tacGias ?? []);
        $sach->theLoais()->sync($request->theLoais ?? []);

        return redirect()->route('sach.index')->with('success', 'Cập nhật sách thành công!');
    }

    /**
     * Hiển thị chi tiết sách
     */
    public function show($ISBN13)
    {
        $sach = Sach::with('tacGias', 'theLoais', 'nhaXuatBan')->findOrFail($ISBN13);

        $tacGias = $sach->tacGias->pluck('TenTG')->toArray();
        $theLoais = $sach->theLoais->pluck('TenTheLoai')->toArray();

        return view('trangchitiet.chitiet', compact('sach', 'tacGias', 'theLoais'));
    }

    /**
     * Xóa sách
     */
    public function destroy($ISBN13)
    {
        $sach = Sach::findOrFail($ISBN13);

        $sach->tacGias()->detach();
        $sach->theLoais()->detach();
        $sach->delete();

        return redirect()->route('sach.index')->with('success', 'Xóa sách thành công!');
    }
}
