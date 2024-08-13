<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'juknis_lomba',
        'point',
        'duration',
        'session',
        'date_race',
        'price',
        'deadline_reg',
        'team',
        'max_people',
        'document',
        'image',
    ];

    protected $dates = [
        'duration',
        'date_race',
        'deadline_reg',
    ];

    public function getDeadlineRegAttribute($value)
    {
        // Set locale to Indonesian
        Carbon::setLocale('id');

        // Format the date
        return Carbon::parse($value)->translatedFormat('d F Y');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function price()
    {
        return 'Rp. '.number_format($this->price, 0, ',', '.');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'race_id');
    }
}
