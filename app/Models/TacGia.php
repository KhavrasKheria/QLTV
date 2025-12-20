<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TacGia extends Model
{
    use HasFactory;

    protected $table = 'tacgia';
    protected $primaryKey = 'MaTG';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['MaTG', 'TenTG'];

    // Quan hệ nhiều-nhiều với sách
    public function saches()
    {
        return $this->belongsToMany(
            Sach::class,
            'sach_tacgia',
            'MaTG',
            'MaSach'
        );
    }
}
