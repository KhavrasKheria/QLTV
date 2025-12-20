<?php

namespace App\Http\Controllers;

use App\Models\TacGia;
use Illuminate\Http\Request;

class TacGiaController extends Controller
{
    /**
     * Hiển thị danh sách + tìm kiếm
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $tacgias = TacGia::when($keyword, function ($query) use ($keyword) {
            $query->where('TenTG', 'like', "%$keyword%")
                ->orWhere('MaTG', 'like', "%$keyword%");
        })->get();

        return view('tacgia.index', compact('tacgias', 'keyword'));
    }

    /**
     * Form thêm
     */
    public function create()
    {
        return view('tacgia.create');
    }

    /**
     * Lưu tác giả mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'MaTG' => 'required|unique:tacgia,MaTG',
            'TenTG' => 'required',
        ], [
            'MaTG.unique' => 'Mã tác giả đã tồn tại',
            'MaTG.required' => 'Vui lòng nhập mã tác giả',
            'TenTG.required' => 'Vui lòng nhập tên tác giả',
        ]);

        TacGia::create($request->only(['MaTG', 'TenTG']));

        return redirect()->route('tacgia.index')->with('success', 'Thêm tác giả thành công');
    }


    /**
     * Form sửa
     */
    public function edit($MaTG)
    {
        $tacgia = TacGia::findOrFail($MaTG);
        return view('tacgia.edit', compact('tacgia'));
    }

    /**
     * Cập nhật tác giả
     */
    public function update(Request $request, $MaTG)
    {
        $request->validate([
            'TenTG' => 'required',
        ]);

        $tacgia = TacGia::findOrFail($MaTG);
        $tacgia->update([
            'TenTG' => $request->TenTG
        ]);

        return redirect()->route('tacgia.index')->with('success', 'Cập nhật tác giả thành công');
    }

    /**
     * Xóa tác giả
     */
    public function destroy($id)
    {
        TacGia::findOrFail($id)->delete();

        return redirect()
            ->route('tacgia.index')
            ->with('success', 'Xóa tác giả thành công!');
    }
}
