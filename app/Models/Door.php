<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    use HasFactory;

    protected $fillable = [
        'paint_color',
        'film_color',
        'handle_color',
        'width',
        'height',
        'opening',
        'accessories',
        'total_price',
    ];

    protected $casts = [
        'accessories' => 'array', // Преобразуем поле 'accessories' из JSON в массив при работе с моделью
    ];
}
