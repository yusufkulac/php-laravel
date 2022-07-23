<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HizmetResim extends Model
{
    use HasFactory;

    public $table   = 'hizmet_resim';

    public $timestamps = false;

    public function hizmet(){
        return $this->hasOne(Hizmet::class, 'id', 'hizmet_id');
    }

    
}