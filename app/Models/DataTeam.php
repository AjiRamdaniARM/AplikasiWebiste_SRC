<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'nama_team',
        'id_participants_1',
        'id_participants_2'
    ];
}
