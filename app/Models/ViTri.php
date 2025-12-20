<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViTri extends Model
{
    protected $table = 'vitri';
    protected $primaryKey = 'MaVT';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['MaVT', 'Khu', 'Day', 'Ke'];

    // Một vị trí có nhiều sách
    public function sachs()
    {
        return $this->hasMany(Sach::class, 'MaVT', 'MaVT');
    }
}
