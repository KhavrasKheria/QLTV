<?php

namespace App\Http\Controllers;

use App\Models\ViTri;
use App\Models\Sach;

class VitriController extends Controller
{
    public function index()
    {
        // Lấy toàn bộ vị trí
        $vitris = ViTri::all();

        // Lấy toàn bộ sách
        $books = Sach::all();

        // Gom sách theo vị trí
        $booksByLocation = [];

        foreach ($books as $b) {
            $booksByLocation[$b->MaVT][] = $b;
        }

        return view('vitri.index', compact('vitris', 'booksByLocation'));
    }
}
