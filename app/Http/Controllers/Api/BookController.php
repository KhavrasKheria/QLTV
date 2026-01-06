<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sach;

class BookController extends Controller
{
    public function index()
    {
        $books = Sach::with(['tacGias', 'nhaXuatBan', 'theLoais'])
            ->get()
            ->map(function ($book) {
                return [
                    'ISBN13'      => $book->ISBN13,   // ✅ đổi từ MaSach
                    'TenSach'     => $book->TenSach,
                    'TomTat'      => $book->TomTat,
                    'NguoiDich'   => $book->NguoiDich,
                    'SoLuong'     => $book->SoLuong,
                    'SoTrang'     => $book->SoTrang,
                    'NamXuatBang' => $book->NamXuatBang,
                    'TrangThai'   => $book->TrangThai,
                    'MaVT'        => $book->MaVT,
                    'MaNXB'       => $book->MaNXB,
                    'TenNXB'      => optional($book->nhaXuatBan)->TenNXB,
                    'TacGias'     => $book->tacGias->pluck('TenTG'),
                    'TheLoais'    => $book->theLoais->pluck('TenTheLoai'),
                    'Anh' => $book->Anh
                        ? (str_starts_with($book->Anh, 'http')
                            ? $book->Anh
                            : asset($book->Anh))
                        : asset('img_book/default.jpg'),
                ];
            });

        return response()->json($books);
    }
}
