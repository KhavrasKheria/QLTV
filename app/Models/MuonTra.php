<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuonTra extends Model
{
    use HasFactory;

    protected $table = 'muontra';
    protected $primaryKey = 'MaMuon';
    public $timestamps = false;
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'MaDocGia',
        'user_id',
        'NgayMuon',
        'HanTra',
        'NgayTra',
        'TrangThai',
    ];

    /**
     * Chi tiết mượn (nhiều sách)
     */
    public function chiTiet()
    {
        return $this->hasMany(
            MuonTraChiTiet::class,
            'MaMuon', // FK ở bảng con
            'MaMuon'  // PK ở bảng cha
        );
    }

    /**
     * Độc giả
     */
    public function docGia()
    {
        return $this->belongsTo(TheDocGia::class, 'MaDocGia', 'MaDocGia');
    }

    /**
     * Thủ thư
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
