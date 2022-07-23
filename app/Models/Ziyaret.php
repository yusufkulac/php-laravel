<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ziyaret extends Model
{
    use HasFactory;

    public $table   = 'ziyaret';

    public $timestamps = false;
    
}