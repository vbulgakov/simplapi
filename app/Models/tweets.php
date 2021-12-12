<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tweets extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator',
        'test',
    ];

}
