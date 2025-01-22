<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterrumahkaca extends Model
{
    use HasFactory;
    protected $fillable = [
        'rmhkaca','hargasewa'
    ];
}

