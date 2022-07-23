<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjeResim extends Model
{
    use HasFactory;

    public $table   = 'proje_resim';

    public $timestamps = false;

    public function proje(){
        return $this->hasOne(Urun::class, 'id', 'proje_id');
    }

    
}