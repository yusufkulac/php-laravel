<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjeKategori extends Model
{
    use HasFactory;

    public $table   = 'proje_kategori';

    public $timestamps = false;

    public function projeler(){
        return $this->hasMany(Urun::class,'kategori_id');
    }

   
}