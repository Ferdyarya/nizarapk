<?php

namespace App\Models;

use App\Models\Masterderetkursi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Masternokursi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nokursi','id_masterderetkursi'
    ];

    public function masterderetkursi()
    {
        return $this->hasOne(Masterderetkursi::class, 'id', 'id_masterderetkursi');
    }
}
