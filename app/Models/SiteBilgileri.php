<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteBilgileri extends Model
{
    
    use HasFactory;   

    public $table   = 'site_bilgileri';
    
    public $timestamps = false;


}
