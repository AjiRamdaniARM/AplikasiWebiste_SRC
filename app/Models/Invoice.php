<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'jumlah',
        'diskon',
        'status',
        'snap_token',
        'id_seleksi',

    ];

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->locale('id')
            ->translatedFormat('d F Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itemRace()
    {
        return $this->belongsToMany(Race::class, 'invoice_races');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'invoice_id');
    }
}
