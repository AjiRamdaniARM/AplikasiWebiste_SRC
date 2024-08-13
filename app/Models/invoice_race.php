<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_race extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'race_id',
    ];
}
