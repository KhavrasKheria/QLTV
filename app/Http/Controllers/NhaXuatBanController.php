<?php

namespace App\Http\Controllers;

use App\Models\NhaXuatBan;
use Illuminate\Http\Request;

class NhaXuatBanController extends Controller
{
    /**
     * Hiển thị danh sách + tìm kiếm
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        
        $dsNXB = NhaXuatBan::when($keyword, function ($query) use ($keyword) {
            $query->where('TenNXB', 'like', "%$keyword%")
                ->orWhere('ID', 'like', "%$keyword%");
        })
        ->orderBy('TenNXB', 'asc')
        ->get();

        // Nếu là AJAX request thì trả về JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'nhaxuatbans' => $dsNXB
            ]);
        }

        // Nếu là request thông thường thì trả về view
        return view('nhaxuatban.index', compact('dsNXB', 'keyword'));
    }

    /**
     * Form thêm
     */
    public function create()
    {
        return view('nhaxuatban.create');
    }

    /**
     * Lưu nhà xuất bản mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'TenNXB' => [
                'required',
                'string',
                'max:255',
                'unique:nhaxuatban,TenNXB'
            ]
        ], [
            'TenNXB.required' => 'Vui lòng nhập tên nhà xuất bản',
            'TenNXB.max' => 'Tên nhà xuất bản không được quá 255 ký tự',
            'TenNXB.unique' => 'Nhà xuất bản này đã tồn tại'
        ]);

        $nxb = NhaXuatBan::create([
            'TenNXB' => trim($request->TenNXB)
        ]);

        // Nếu là AJAX request (từ modal)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thêm nhà xuất bản thành công',
                'data' => [  // ✅ Đổi từ 'nhaxuatban' thành 'data'
                    'MaNXB' => $nxb->ID,      // ✅ Đổi 'ID' thành 'MaNXB' để khớp với script
                    'TenNXB' => $nxb->TenNXB,
                    'DiaChi' => null          // ✅ Thêm field này (hoặc $nxb->DiaChi nếu có)
                ]
            ]);
        }

        // Nếu là request thông thường
        return redirect()
            ->route('nhaxuatban.index')
            ->with('success', 'Thêm nhà xuất bản thành công');
    }

    /**
     * Form sửa
     */
    public function edit($id)
    {
        $nxb = NhaXuatBan::findOrFail($id);
        return view('nhaxuatban.edit', compact('nxb'));
    }

    /**
     * Cập nhật nhà xuất bản
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'TenNXB' => [
                'required',
                'string',
                'max:255',
                'unique:nhaxuatban,TenNXB,' . $id . ',ID'
            ]
        ], [
            'TenNXB.required' => 'Vui lòng nhập tên nhà xuất bản',
            'TenNXB.max' => 'Tên nhà xuất bản không được quá 255 ký tự',
            'TenNXB.unique' => 'Nhà xuất bản này đã tồn tại'
        ]);

        $nxb = NhaXuatBan::findOrFail($id);
        $nxb->update([
            'TenNXB' => trim($request->TenNXB)
        ]);

        return redirect()
            ->route('nhaxuatban.index')
            ->with('success', 'Cập nhật nhà xuất bản thành công');
    }

    /**
     * Xóa nhà xuất bản
     */
    public function destroy($id)
    {
        try {
            $nxb = NhaXuatBan::findOrFail($id);
            
            // Kiểm tra có sách đang sử dụng không
            if ($nxb->isInUse()) {
                return redirect()
                    ->route('nhaxuatban.index')
                    ->with('error', 'Không thể xóa nhà xuất bản. Có thể đang được sử dụng trong sách.');
            }
            
            $nxb->delete();

            return redirect()
                ->route('nhaxuatban.index')
                ->with('success', 'Xóa nhà xuất bản thành công!');
        } catch (\Exception $e) {
            return redirect()
                ->route('nhaxuatban.index')
                ->with('error', 'Không thể xóa nhà xuất bản. Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}