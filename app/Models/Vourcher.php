<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vourcher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'diskon',
        'valid_from',
        'valid_until',
        'status',
    ];
}
