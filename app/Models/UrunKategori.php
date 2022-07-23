<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrunKategori extends Model
{
    use HasFactory;

    public $table   = 'urun_kategori';

    public $timestamps = false;

    public function urun(){
        return $this->hasMany(Urun::class,'kategori_id');
    }

   
}