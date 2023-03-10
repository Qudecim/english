<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'word_1', 'word_2'];

    protected $hidden = ['user_id'];
}
