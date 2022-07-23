<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urun extends Model
{
    use HasFactory;

    public $table   = 'urunler'; 
    
    //public $timestamps = false;

    public function kategori(){
        return $this->hasOne(UrunKategori::class, 'id', 'kategori_id');
    }

    public function resimler(){
        return $this->hasMany(UrunResim::class,'urun_id')->orderBy("sira", "asc");
    }

   
}