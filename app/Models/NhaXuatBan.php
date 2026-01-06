<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhaXuatBan extends Model
{
    use HasFactory;

    protected $table = 'nhaxuatban';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'TenNXB'
    ];

    /**
     * Relationship: Một NXB có nhiều sách
     */
    public function sachs()
    {
        return $this->hasMany(Sach::class, 'MaNXB', 'ID');
    }

    /**
     * Scope: Tìm kiếm theo tên
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $keyword = null)
    {
        if (empty($keyword)) {
            return $query;
        }

        return $query->where('TenNXB', 'like', '%' . $keyword . '%');
    }

    /**
     * Scope: Sắp xếp theo tên
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByName($query, $direction = 'asc')
    {
        return $query->orderBy('TenNXB', $direction);
    }

    /**
     * Kiểm tra xem NXB có đang được sử dụng không
     * 
     * @return bool
     */
    public function isInUse()
    {
        return $this->sachs()->count() > 0;
    }

    /**
     * Lấy số lượng sách của NXB
     * 
     * @return int
     */
    public function getBooksCountAttribute()
    {
        return $this->sachs()->count();
    }

    /**
     * Lấy thống kê tổng quan
     * 
     * @return array
     */
    public static function getStatistics()
    {
        return [
            'total' => self::count(),
            'with_books' => self::has('sachs')->count(),
            'without_books' => self::doesntHave('sachs')->count(),
        ];
    }
}