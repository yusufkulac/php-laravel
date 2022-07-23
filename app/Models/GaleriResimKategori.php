<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriResimKategori extends Model
{
    use HasFactory;

    public $table   = 'galeri_resim_kategori';

    public $timestamps = false;     

    public function resimler(){
        return $this->hasMany(GaleriResim::class, 'galeri_id');
    }

   
    
}