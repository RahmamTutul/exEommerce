<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subCategories(){
       return $this->hasMany('App\Models\Category','parent_id')->where('status',1);
    }
    public function section(){
        return $this->belongsTo('App\Models\Section','section_id')->select('id','name');
    }
    public function parentcategory(){
        return $this->belongsTo('App\Models\Category','parent_id')->select('id','category_name');
    }
    public static function catDetails($url){

        $catDetails=Category::where('url',$url)->with(['subCategories'])->first()->toArray();
        if($catDetails['parent_id']==0){
            //  Show Breadcrumb Like Home/Category/
            $breadcrumbs= '<a href="'.url($catDetails['url']).'">'.$catDetails['category_name'].'</a>';
        }else{
            $parentCategory=Category::select('category_name','url')->where('id',$catDetails['parent_id'])->first()->toArray();
            $breadcrumbs= '<a href="'.url($parentCategory['url']).'">'.$parentCategory['category_name'].'</a> / <a href="'.url($catDetails['url']).'">'.$catDetails['category_name'].'</a>';
        }

        $catIds=array();
        $catIds[]=$catDetails['id'];
        foreach($catDetails['sub_categories'] as $key=>$subCat){
            $catIds[]=$subCat['id'];
        }
        return array('catDetails'=>$catDetails,'catIds'=>$catIds, 'breadcrumbs'=>$breadcrumbs);

    }
}
// =>function($query){$query->select('id','parent_id','category_name','id','url','description')->where('status',1);}
 // protected $fillable=['category_name','section_id','parent_id','category_discount','description','url','category_image','meta_title','meta_description','meta_keywords',];
