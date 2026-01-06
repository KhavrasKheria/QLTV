<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheDocGia extends Model
{
    use HasFactory;

    protected $table = 'thedocgia';

    protected $primaryKey = 'MaDocGia';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'MaDocGia',
        'TenDocGia',
        'Khoa',
        'Lop',
        'TrangThai',
    ];

    /**
     * Một độc giả có nhiều lần mượn
     */
    public function muonTras()
    {
        return $this->hasMany(MuonTra::class, 'MaDocGia', 'MaDocGia');
    }
}
