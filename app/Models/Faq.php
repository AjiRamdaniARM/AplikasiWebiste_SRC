<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'question',
        'slug',
        'answare',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'question',
            ],
        ];
    }
}
