<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hizmet extends Model
{
    use HasFactory;

    public $table   = 'hizmetler';

    public $timestamps = false;

    public function resimler(){
        return $this->hasMany(HizmetResim::class,'hizmet_id')->orderBy("sira", "asc");
    }

     public function kategori(){
        return $this->hasOne(HizmetKategori::class, 'id', 'kategori_id');
    }
    
}