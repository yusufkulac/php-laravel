<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HizmetKategori extends Model
{
    use HasFactory;

    public $table   = 'hizmet_kategori';

    public $timestamps = false;

    
    public function hizmetler(){
        return $this->hasMany(Hizmet::class, 'kategori_id')->where('aktif', 1)->orderBy("sira", "asc");
    }

    public function hizmetMenu(){
        return $this->hasMany(Hizmet::class, 'kategori_id')->where("aktif", 1)->orderBy("sira");
    }
    
}