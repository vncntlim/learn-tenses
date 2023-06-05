<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verb extends Model
{
    protected $fillable = [
        'verb',
        'sentences'
    ];

    use HasFactory;
}
