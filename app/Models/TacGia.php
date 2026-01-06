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

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'MaTG',
        'TenTG'
    ];

    /**
     * Quan hệ nhiều-nhiều với sách
     */
    public function saches()
    {
        return $this->belongsToMany(
            Sach::class,
            'sach_tacgia',
            'MaTG',
            'ISBN13'
        );
    }

    /**
     * Tạo mã tác giả tự động theo dạng TG_1, TG_2, ...
     * 
     * @return string
     */
    public static function generateMaTG()
    {
        // Lấy số lớn nhất hiện có
        $lastMaTG = self::where('MaTG', 'like', 'TG_%')
            ->orderByRaw('CAST(SUBSTRING(MaTG, 4) AS UNSIGNED) DESC')
            ->value('MaTG');

        if ($lastMaTG) {
            // Tách số từ mã (TG_10 -> 10)
            $number = (int) substr($lastMaTG, 3);
            $newNumber = $number + 1;
        } else {
            // Nếu chưa có mã nào, bắt đầu từ 1
            $newNumber = 1;
        }

        return 'TG_' . $newNumber;
    }

    /**
     * Kiểm tra xem tác giả có thể xóa không (không có sách liên quan)
     * 
     * @return bool
     */
    public function canDelete()
    {
        return $this->saches()->count() === 0;
    }

    /**
     * Lấy số lượng sách của tác giả
     * 
     * @return int
     */
    public function getSoLuongSachAttribute()
    {
        return $this->saches()->count();
    }

    /**
     * Scope tìm kiếm tác giả
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $keyword)
    {
        if (empty($keyword)) {
            return $query;
        }

        return $query->where(function ($q) use ($keyword) {
            $q->where('TenTG', 'like', "%$keyword%")
              ->orWhere('MaTG', 'like', "%$keyword%");
        });
    }

    /**
     * Scope sắp xếp theo số thứ tự trong mã
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByNumber($query, $direction = 'DESC')
    {
        return $query->orderByRaw("CAST(SUBSTRING(MaTG, 4) AS UNSIGNED) $direction");
    }

    /**
     * Boot model - tự động tạo mã khi thêm mới
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tacgia) {
            if (empty($tacgia->MaTG)) {
                $tacgia->MaTG = self::generateMaTG();
            }
        });
    }
}