<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rawatrumahkaca extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_masterrumahkaca','tanggal','deskripsi','keperluandana','status'
    ];

    public function masterrumahkaca()
    {
        return $this->hasOne(Masterrumahkaca::class, 'id', 'id_masterrumahkaca');
    }
}
