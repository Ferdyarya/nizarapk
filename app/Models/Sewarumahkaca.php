<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewarumahkaca extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_masterrumahkaca','namapenyewa','keperluan','tanggal','buktibayar','tanggal_start','tanggal_end'
    ];

    public function masterrumahkaca()
    {
        return $this->hasOne(Masterrumahkaca::class, 'id', 'id_masterrumahkaca');
    }
}
