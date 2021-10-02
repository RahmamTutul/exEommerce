<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OtherSettings;
use App\Models\Section;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Models\AdminRole;

class CategoryController extends Controller
{
    public function category(){
        $category=Category::with(['section','parentcategory'])->get();
        $category = json_decode(json_encode($category));
        $permission = AdminRole::where(['admin_id'=>Auth::guard('admin')->user()->id, 'module'=>'categories'])->count();
        if($permission==0){
            Alert::error('Sorry!','You are not permitted for this action!');
            return redirect()->back();
        }
        return view('backend.pages.category.category')->with('categories', $category);
    }
    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'category_id'=>$data['category_id']]);
         }
    }


    public function AddCategory(){
        $sections = Section::get();
        return view('backend.pages.category.add-category')->with('sections',$sections);
    }
    public function createCategory(Request $request){
       $request->validate([
          'category_name'=>'required',
          'section_id'=>'required',
          'parent_id'=>'required',
          'category_discount'=>'required',
          'category_image'=>'image|required|mimes:jpg,png,jpeg',
       ]);



       if($request->hasFile('category_image'))
       {

        $image=$request->file('category_image');
        $currentDate=Carbon::now()->toDateString();
        $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();

        if(!Storage::disk('public')->exists('images/admin/category'))
        {
           Storage::disk('public')->makeDirectory('images/admin/category');
        }

        $categoryImage = Image::make($image)->resize(400,400)->stream();
        Storage::disk('public')->put('images/admin/category/'.$imageName,$categoryImage);
       }else{
           $imageName= "default.png";
       }
       $url =Str::slug($request->category_name);
       $data= new Category();
       $data->category_name=$request->category_name;
       $data->section_id=$request->section_id;
       $data->parent_id=$request->parent_id;
       $data->url=$url;
       $data->category_discount=$request->category_discount;
       $data->description=$request->description;
       $data->category_image=$imageName;
       $data->meta_title=$request->meta_title;
       $data->meta_description=$request->meta_description;
       $data->meta_keywords=$request->meta_keywords;
       $data->status=1;
       $data->save();
       Alert::success('Success!','Category uploaded successfully!');
       return redirect()->route('admin.category.index');
    }

    public function appendCategoryLevel(Request $request){
          if($request->ajax()){
              $data=$request->all();
              $category= Category::with('subCategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0, 'status'=>1])->get();
              $category=json_decode(json_encode($category),true);
            //   echo "<pre>"; print_r($category); die;
              return view('backend.pages.category.append_categories_level')->with('categories',$category);
          }
    }


    public function destroyCategory($id){
        $work=Category::find($id);
           if(Storage::disk('public')->exists('images/admin/category/'.$work->category_image))
            {
               Storage::disk('public')->delete('images/admin/category/'.$work->category_image);
            }
            $work->delete();
            Alert::success('Success!','Category deleted successfully!');
            return redirect()->route('admin.category.index');
    }


    public function EditCategory($id){
        $categoryData=Category::find($id);
        $sections = Section::get();
        return view('backend.pages.category.Edit-Category')
        ->with('category',$categoryData)
        ->with('sections',$sections);
    }

    public function updateCategory(Request $request, $id){
        $data=Category::find($id);
        $request->validate([
            'category_name'=>'required',
            'section_id'=>'required',
            'parent_id'=>'required',
            'category_discount'=>'required',
            'category_image'=>'image|required|mimes:jpg,png,jpeg',
        ]);



        if($request->hasFile('category_image'))
        {

        $image=$request->file('category_image');
        $currentDate=Carbon::now()->toDateString();
        $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();

        if(!Storage::disk('public')->exists('images/admin/category'))
        {
            Storage::disk('public')->makeDirectory('images/admin/category');
        }

        if(Storage::disk('public')->exists('images/admin/category/'.$data->category_image))
        {
           Storage::disk('public')->delete('images/admin/category/'.$data->category_image);
        }

        $categoryImage = Image::make($image)->resize(400,400)->stream();
        Storage::disk('public')->put('images/admin/category/'.$imageName,$categoryImage);

        }else{
           $imageName=$data->category_image;
        }
        $url =Str::slug($request->category_name);
        $data->category_name=$request->category_name;
        $data->section_id=$request->section_id;
        $data->parent_id=$request->parent_id;
        $data->url=$request->url;
        $data->category_discount=$request->category_discount;
        $data->description=$request->description;
        $data->category_image=$imageName;
        $data->meta_title=$request->meta_title;
        $data->meta_description=$request->meta_description;
        $data->meta_keywords=$request->meta_keywords;
        $data->status=1;
        $data->save();
        Alert::success('Success!','Category updated successfully!');
        return redirect()->route('admin.category.index');
    }

    public function DeleteCategoryImage($id){
       $data= Category::find($id);
       if(Storage::disk('public')->exists('images/admin/category/'.$data->category_image))
       {
          Storage::disk('public')->delete('images/admin/category/'.$data->category_image);
       }
       $data->update(['category_image'=>'']);
       Alert::success('Success!','Category image deleted successfully!');
       return redirect()->back();
    }

}
