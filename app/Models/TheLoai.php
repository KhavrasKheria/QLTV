<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;

    protected $table = 'theloai';

    protected $primaryKey = 'id';   // PK đúng với DB

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'TenTheLoai'
    ];

    /**
     * Quan hệ nhiều-nhiều với sách
     */
    public function saches()
    {
        return $this->belongsToMany(
            Sach::class,
            'sach_theloai',
            'TheLoaiID', // FK thể loại trong pivot
            'ISBN13'     // ✅ đổi từ MaSach
        );
    }
}
