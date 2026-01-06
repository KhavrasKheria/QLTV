<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MuonTraChiTiet extends Model
{
    protected $table = 'muontra_chitiet';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'MaMuon',
        'ISBN13',
    ];

    /**
     * Phiếu mượn
     */
    public function muonTra()
    {
        return $this->belongsTo(
            MuonTra::class,
            'MaMuon',
            'MaMuon'
        );
    }

    /**
     * Sách
     */
    public function sach()
    {
        return $this->belongsTo(
            Sach::class,
            'ISBN13',
            'ISBN13'
        );
    }

    /**
     * Accessor: tên sách
     */
    public function getTenSachAttribute()
    {
        return optional($this->sach)->TenSach ?? '---';
    }
}
