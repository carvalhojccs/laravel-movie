<?php

namespace App\Models;

use App\Enums\GenresTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['tmdb_id', 'type','slug', 'title'];

    protected $casts = [
        'type' => GenresTypeEnum::class,
    ];
}
