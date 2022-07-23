<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public $table   = 'blog';

    public function yazar(){
        return $this->hasOne(User::class, 'id', 'yazar_id');
    }

    public function updateUser(){
        return $this->hasOne(User::class, 'id', 'yazar_id');
    }

     public function resimler(){
        return $this->hasMany(BlogResim::class,'blog_id')->orderBy("sira", "asc");
    }
}