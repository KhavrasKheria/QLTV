<?php

namespace App\Http\Controllers;

use App\Models\NhaXuatBan;
use Illuminate\Http\Request;

class NhaXuatBanController extends Controller
{
    public function index()
    {
        $dsNXB = NhaXuatBan::all();
        return view('nhaxuatban.index', compact('dsNXB'));
    }

    public function create()
    {
        return view('nhaxuatban.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TenNXB' => 'required|string|max:255'
        ]);

        NhaXuatBan::create($request->all());
        return redirect()->route('nhaxuatban.index');
    }

    public function edit($id)
    {
        $nxb = NhaXuatBan::findOrFail($id);
        return view('nhaxuatban.edit', compact('nxb'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TenNXB' => 'required|string|max:255'
        ]);

        $nxb = NhaXuatBan::findOrFail($id);
        $nxb->update($request->all());

        return redirect()->route('nhaxuatban.index');
    }

    public function destroy($id)
    {
        NhaXuatBan::destroy($id);
        return redirect()->route('nhaxuatban.index');
    }
}
