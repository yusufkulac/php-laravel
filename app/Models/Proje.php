<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proje extends Model
{
    use HasFactory;

    public $table   = 'projeler'; 
    
    //public $timestamps = false;

    public function kategori(){
        return $this->hasOne(ProjeKategori::class, 'id', 'kategori_id');
    }

    public function resimler(){
        return $this->hasMany(ProjeResim::class,'proje_id')->orderBy("sira", "asc");
    }

   
}