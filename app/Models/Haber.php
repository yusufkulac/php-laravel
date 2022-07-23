<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Haber extends Model
{
    use HasFactory;

    public $table   = 'haber';

    public function resimler(){
        return $this->hasMany(HaberResim::class,'haber_id')->orderBy("sira", "asc");
    }

    public function yazar(){
        return $this->hasOne(User::class, 'id', 'yazar_id');
    }

    public function updateUser(){
        return $this->hasOne(User::class, 'id', 'yazar_id');
    }
}