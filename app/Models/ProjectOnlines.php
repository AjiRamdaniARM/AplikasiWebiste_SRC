<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectOnlines extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_project',
        'status',
        'id_participants',
        'id_user',
        'seleksi'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'id_participants');
    }
}
