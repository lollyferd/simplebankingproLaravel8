<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gl_create extends Model
{
    use HasFactory;
    protected $fillable = [
        'subclassid',
        'glname',
        'classid',
       
    ];
}
