<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return view('trangdanhsach.danhsach');
    }

    public function apiSearch(Request $request)
    {
        $keyword = trim($request->input('q', ''));

        if ($keyword === '') {
            return response()->json([]);
        }

        $sachs = Sach::query()
            ->select('sach.*')
            ->leftJoin('sach_tacgia', 'sach.ISBN13', '=', 'sach_tacgia.ISBN13')
            ->leftJoin('tacgia', 'sach_tacgia.MaTG', '=', 'tacgia.MaTG')
            ->leftJoin('nhaxuatban', 'sach.MaNXB', '=', 'nhaxuatban.ID')
            ->whereRaw("
                MATCH(sach.TenSach, sach.NguoiDich)
                    AGAINST (? IN NATURAL LANGUAGE MODE)
                OR MATCH(tacgia.TenTG)
                    AGAINST (? IN NATURAL LANGUAGE MODE)
                OR MATCH(nhaxuatban.TenNXB)
                    AGAINST (? IN NATURAL LANGUAGE MODE)
            ", [$keyword, $keyword, $keyword])
            ->with(['tacGias', 'nhaXuatBan', 'theLoais'])
            ->groupBy('sach.ISBN13')
            ->limit(50)
            ->get()
            ->map(fn ($book) => $book->toApiArray());

        return response()->json($sachs);
    }
}
