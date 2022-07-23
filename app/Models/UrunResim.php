<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrunResim extends Model
{
    use HasFactory;

    public $table   = 'urun_resim';

    public $timestamps = false;

    public function urun(){
        return $this->hasOne(Urun::class, 'id', 'urun_id');
    }

    
}