<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public static function section(){
       $getSection=Section::with('categories')->where('status',1)->get();
       $getSection=json_decode(json_encode($getSection),true);
       return $getSection;
    }

    public function categories(){
        return $this->hasMany('App\Models\Category','section_id')->where(['parent_id'=>'ROOT','status'=>1])->with('subCategories');
    }
}
