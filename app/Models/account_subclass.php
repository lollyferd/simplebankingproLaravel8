<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_subclass extends Model
{
    use HasFactory;
    protected $fillable = [
        'subclass',
        'classid',
       
    ];
}
