<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public static function banner(){
        $banner= Banner::where('status',1)->get()->toArray();
        return $banner;
    }
}
