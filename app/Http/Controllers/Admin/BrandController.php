<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function index(){
        $data= Brands::get();
        return view('backend.pages.brands.brands')->with('brands',$data);
    }
    public function updateBrandsStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Brands::where('id',$data['brands_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['brands_id']]);
        }
    }
    public function destroyBrands($id){
        Brands::find($id)->delete();
        Alert::success('Success!','Brand deleted successfully!');
        return redirect()->back();
    }
    public function StoreBrands(Request $request){

          $request->validate([
             'name'=>'required'
          ]);
        $data= new Brands;
        $data->name=$request->name;
        $data->status=1;
        $data->save();
        Alert::success('Success!','Brand added successfully!');
        return redirect()->back();
    }
    public function UpdateBrands(Request $request){
       $data= $request->all();
       foreach($data['id'] as $key=>$value){
         if(!empty($value)){
            Brands::where(['id'=>$data['id'][$key]])->update(['name'=>$data['name'][$key]]);
         }
       }

       Alert::success('Success!','Brand Updated successfully!');
        return redirect()->back();
    }
}
