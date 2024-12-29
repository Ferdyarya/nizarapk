<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masteranggota extends Model
{
    use HasFactory;
    protected $fillable = [
         'nama', 'email','no_telp','jabatan','cabang','jeniskelamin'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_anggota');
    }
}
