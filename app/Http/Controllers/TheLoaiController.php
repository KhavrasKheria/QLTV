<?php

namespace App\Http\Controllers;

use App\Models\TheLoai;
use Illuminate\Http\Request;

class TheLoaiController extends Controller
{
    public function index()
    {
        $theloais = TheLoai::all();
        return view('theloai.index', compact('theloais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'TenTheLoai' => 'required|string|max:255'
        ]);

        TheLoai::create([
            'TenTheLoai' => $request->TenTheLoai
        ]);

        return redirect()->route('theloai.index')
            ->with('success', 'Thêm thể loại thành công');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TenTheLoai' => 'required|string|max:255'
        ]);

        $theloai = TheLoai::findOrFail($id);
        $theloai->update([
            'TenTheLoai' => $request->TenTheLoai
        ]);

        return redirect()->route('theloai.index')
            ->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        TheLoai::destroy($id);

        return redirect()->route('theloai.index')
            ->with('success', 'Xóa thể loại thành công');
    }
}
