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
    protected $primaryKey = 'ISBN13';

    // Khóa chính là varchar, không auto-increment
    public $incrementing = false;

    protected $keyType = 'string';

    // Laravel không tự động quản lý timestamp
    public $timestamps = false;

    // Các trường có thể gán giá trị
    protected $fillable = [
        'ISBN13',        // ✅ đổi từ MaSach
        'TenSach',
        'TomTat',
        'NguoiDich',
        'SoLuong',
        'SoTrang',
        'NamXuatBang',
        'TrangThai',
        'MaVT',
        'MaNXB',
        'Anh'
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
            TacGia::class,   // model tác giả
            'sach_tacgia',   // bảng trung gian
            'ISBN13',        // ✅ khóa sách
            'MaTG'           // khóa tác giả
        );
    }

    /**
     * Quan hệ với thể loại
     * Một sách có thể thuộc nhiều thể loại
     */
    public function theLoais()
    {
        return $this->belongsToMany(
            TheLoai::class,   // Model thể loại
            'sach_theloai',   // Bảng trung gian
            'ISBN13',         // ✅ khóa sách
            'TheLoaiID'       // khóa thể loại
        );
    }

    /**
     * Quan hệ với mượn trả
     */
    public function muonTras()
    {
        return $this->hasMany(MuonTra::class, 'ISBN13', 'ISBN13');
    }

    /**
     * Dữ liệu trả về API / AJAX
     */
    public function toApiArray()
    {
        return [
            'ISBN13'      => $this->ISBN13,
            'TenSach'     => $this->TenSach,
            'TomTat'      => $this->TomTat,
            'NguoiDich'   => $this->NguoiDich,
            'SoLuong'     => $this->SoLuong,
            'SoTrang'     => $this->SoTrang,
            'NamXuatBang' => $this->NamXuatBang,
            'TrangThai'   => $this->TrangThai,
            'MaVT'        => $this->MaVT,
            'MaNXB'       => $this->MaNXB,
            'TenNXB'      => optional($this->nhaXuatBan)->TenNXB,
            'TacGias'     => $this->tacGias->pluck('TenTG'),
            'TheLoais'    => $this->theLoais->pluck('TenTheLoai'),
            'Anh' => $this->Anh
                ? (str_starts_with($this->Anh, 'http') ? $this->Anh : asset($this->Anh))
                : asset('img_book/default.jpg'),
        ];
    }
}
