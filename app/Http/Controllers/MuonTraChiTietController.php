<?php

namespace App\Http\Controllers;

use App\Models\Sach;
use Illuminate\Http\Request;

class MuonTraChiTietController extends Controller
{
    /**
     * Thông tin sách theo ISBN (API cho AJAX)
     */
    public function thongTinSach($ISBN13)
    {
        $sach = Sach::where('ISBN13', $ISBN13)->first();

        if (!$sach) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy sách'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'ISBN13' => $sach->ISBN13,
                'TenSach' => $sach->TenSach,
                'SoLuong' => $sach->SoLuong,
                'MaVT' => $sach->MaVT ?? 'Chưa cập nhật',
                'TacGia' => $sach->TacGia ?? null,
                'NhaXuatBan' => $sach->NhaXuatBan ?? null,
            ]
        ]);
    }
}