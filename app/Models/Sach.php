<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sach extends Model
{
    use HasFactory;

    // Tên bảng trong database
    protected $table = 'sach';

    // Khóa chính
    protected $primaryKey = 'MaSach';

    // Khóa chính là varchar, không auto-increment
    public $incrementing = false;

    // Laravel không tự động quản lý timestamp
    public $timestamps = false;

    // Các trường có thể gán giá trị
    protected $fillable = [
        'MaSach',
        'TenSach',
        'TomTat',
        'NguoiDich',
        'SoLuong',
        'SoTrang',
        'NamXuatBang',
        'TrangThai',
        'MaVT',
        'MaNXB',
        'Anh' // Thêm trường ảnh vào đây
    ];

    /**
     * Quan hệ với nhà xuất bản
     * Một sách thuộc về một nhà xuất bản
     */
    public function nhaXuatBan()
    {
        return $this->belongsTo(NhaXuatBan::class, 'MaNXB', 'ID');
    }

    /**
     * Quan hệ với tác giả
     * Một sách có thể có nhiều tác giả
     */
    public function tacGias()
    {
        return $this->belongsToMany(
            TacGia::class,      // model tác giả
            'sach_tacgia',      // bảng trung gian
            'MaSach',           // khóa của sách trong bảng trung gian
            'MaTG'              // khóa của tác giả trong bảng trung gian
        );
    }

    /**
     * Quan hệ với thể loại
     * Một sách có thể thuộc nhiều thể loại
     */
    public function theLoais()
    {
        return $this->belongsToMany(
            TheLoai::class,       // Model thể loại
            'sach_theloai',       // Bảng trung gian
            'MaSach',             // Khóa sách trong bảng trung gian
            'TheLoaiID'           // Khóa thể loại trong bảng trung gian
        );
    }
}
