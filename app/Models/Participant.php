<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'race_id',
        'name',
        'kelas',
        'IdCard',
        'id_user',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function race()
    {
        return $this->belongsTo(Race::class, 'race_id');
    }

    public function projectonlines()
    {
        return $this->belongsTo(ProjectOnlines::class, 'id_upload');
    }
}
