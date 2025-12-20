<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhaXuatBan extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'nhaxuatban';

    // Khóa chính
    protected $primaryKey = 'ID';

    // Auto-increment
    public $incrementing = true;

    // Laravel quản lý timestamps mặc định
    public $timestamps = false;

    // Trường có thể gán giá trị
    protected $fillable = [
        'TenNXB'
    ];

    // Quan hệ 1-nhiều với sách
    public function sachs()
    {
        return $this->hasMany(Sach::class, 'MaNXB', 'ID');
    }
}
