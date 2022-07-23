<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HaberResim extends Model
{
    use HasFactory;

    public $table   = 'haber_resim';

    public $timestamps = false;

    public function haber(){
        return $this->hasOne(Haber::class, 'id', 'haber_id');
    }
}