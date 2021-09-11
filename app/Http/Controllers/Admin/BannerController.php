<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function index(){
        $banners= Banner::get();
        return view('backend.pages.Banner.banner')->with('banners',$banners);
    }
    public function updateBannerStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['banner_id']]);
        }

    }
    public function DeleteBanner($id){
        $data= Banner::find($id);
        if(Storage::disk('public')->exists('images/admin/banner/'.$data->image))
        {
           Storage::disk('public')->delete('images/admin/banner/'.$data->image);
        }
        $data->delete();
        Alert::success('Success!','Banner Deleted successfully!');
      return redirect()->back();
    }
    public function create(){
        return view('backend.pages.banner.create_banner');
    }
    public function edit($id){
        $data=Banner::find($id);
        return view('backend.pages.banner.edit')->with('banner',$data);
    }

    public function store(Request $request){
        $data=new Banner;
        $request->validate([
            'image'=>'required|mimes:png,jpg,jpeg|max:5000',
           'title'=>'required',
           'link'=>'required',
           'alt'=>'required',
        ]);
        if($request->hasFile('image'))
        {

        $image=$request->file('image');
        $currentDate=Carbon::now()->toDateString();
        $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();
        if(!Storage::disk('public')->exists('images/admin/banner/'.$data->image))
        {
           Storage::disk('public')->makeDirectory('images/admin/banner/'.$data->image);
        }
        $bannerImage = Image::make($image)->resize(1500,800)->stream();
        Storage::disk('public')->put('images/admin/banner/'.$imageName,$bannerImage);
        $data->image=$imageName;
        }else{
            $imageName= "default.png";
        }
        $data->title=$request->title;
        $data->link=$request->link;
        $data->alt=$request->alt;
        $data->status=1;
        $data->save();
        Alert::success('Success!','Banner Uploaded successfully!');
        return redirect()->route('admin.banner.index');
    }

    public function update(Request $request ,$id){
        $data=Banner::find($id);
        $request->validate([
           'title'=>'required',
           'link'=>'required',
           'alt'=>'required',
        ]);
        if($request->hasFile('image'))
        {

        $image=$request->file('image');
        $currentDate=Carbon::now()->toDateString();
        $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();
        if(Storage::disk('public')->exists('images/admin/banner/'.$data->image))
        {
           Storage::disk('public')->delete('images/admin/banner/'.$data->image);
        }
        $bannerImage = Image::make($image)->resize(900,800)->stream();
        Storage::disk('public')->put('images/admin/banner/'.$imageName,$bannerImage);
        $data->image=$imageName;
        }else{
            $imageName= "default.png";
        }
        $data->title=$request->title;
        $data->link=$request->link;
        $data->alt=$request->alt;
        $data->status=1;
        $data->save();
        Alert::success('Success!','Banner Uploaded successfully!');
        return redirect()->route('admin.banner.index');
    }

}
