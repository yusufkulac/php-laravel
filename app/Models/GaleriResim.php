<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriResim extends Model
{
    use HasFactory;

    public $table   = 'galeri_resim';

    public $timestamps = false;

    public function kategori(){
        return $this->hasOne(Haber::class, 'id', 'galeri_id');
    }
}