<?php

namespace App\Models;

use App\Models\User;
use App\Models\Masterpegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembangunanrumahkaca extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal','namarumah','id_masterpegawai','deskripsi','keperluandana','status'
    ];

    public function masterpegawai()
    {
        return $this->hasOne(Masterpegawai::class, 'id', 'id_masterpegawai');
    }
}
