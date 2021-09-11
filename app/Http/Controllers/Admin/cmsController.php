<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class cmsController extends Controller
{
    public function Index(){
       $cmsInfos = CMS::get()->toArray();
    //    dd($cmsInfos);
       return view('backend.pages.cms.index')->with(compact('cmsInfos'));
    }
    public function Create(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
             $request->validate([
                'title'=>'required',
                'url'=>'required',
                'meta_title'=>'required',
                'description'=>'required',
                'meta_description'=>'required',
                'meta_keywords'=>'required',
             ]);
            $Info= new CMS;
            $Info->title=$data['title'];
            $Info->url=$data['url'];
            $Info->meta_title=$data['meta_title'];
            $Info->description=$data['description'];
            $Info->meta_description=$data['meta_description'];
            $Info->meta_keywords=$data['meta_keywords'];
            $Info->status=1;
            $Info->save();
            Alert::success('Success!',"Uploaded successfully!");
            return redirect('admin/cms/index');
        }
        return view('backend.pages.cms.create');

    }

    public function Edit(Request $request, $id){
      $cms= CMS::find($id);
      if($request->isMethod('post')){
        $data= $request->all();
        $request->validate([
           'title'=>'required',
           'url'=>'required',
           'meta_title'=>'required',
           'description'=>'required',
           'meta_description'=>'required',
           'meta_keywords'=>'required',
        ]);
       $cms->title=$data['title'];
       $cms->url=$data['url'];
       $cms->meta_title=$data['meta_title'];
       $cms->description=$data['description'];
       $cms->meta_description=$data['meta_description'];
       $cms->meta_keywords=$data['meta_keywords'];
       $cms->status=1;
       $cms->save();
       Alert::success('Success!',"Updated successfully!");
       return redirect('admin/cms/index');
      }
      return view('backend.pages.cms.edit')->with(compact('cms'));
    }
    public function UpdateCmsStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            CMS::where('id',$data['cms_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['cms_id']]);
        }

    }
    public function DeleteCMS($id){
        CMS::find($id)->delete();
        Alert::success('Success!',"Deleted successfully!");
        return redirect()->back();
    }
}
