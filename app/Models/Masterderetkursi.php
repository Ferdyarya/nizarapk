<?php

namespace App\Models;

use App\Models\Masternokursi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Masterderetkursi extends Model
{
    use HasFactory;
    protected $fillable = [
        'deret','id_masternokursi'
    ];

    public function masternokursi()
    {
        return $this->hasOne(Masternokursi::class, 'id', 'id_masternokursi');
    }

}
