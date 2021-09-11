<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ShippingController extends Controller
{
   public function Index(){
       $shipping_charges = ShippingCharge::get()->toArray();
    //    dd($shipping_charges);
       return view('backend.pages.shipping.index')->with(compact('shipping_charges'));
   }
   public function UpdateShippingStatus(Request $request){
    if($request->ajax()){
        $data= $request->all();
        if($data['status']=='Active'){
            $status=0;
        }else{
            $status=1;
        }
        ShippingCharge::where('id',$data['shipping_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status, 'id'=>$data['shipping_id']]);
    }
   }
   public function UpdateShippingCharges(Request $request, $id){
       if($request->isMethod('post')){
           $data= $request->all();
           ShippingCharge::where('id',$id)->update(['0_500g'=>$data['0_500g'],'501_1000g'=>$data['501_1000g'],'1001_2000g'=>$data['1001_2000g'],'2001_3000g'=>$data['2001_3000g'],'3001_4000g'=>$data['3001_4000g'],'above_5000g'=>$data['above_5000g']]);
           Alert::success('Success!','Shipping charge updated successfully!');
           return redirect()->back();
       }
       $shipping_charges= ShippingCharge::where('id',$id)->first()->toArray();
       return view('backend.pages.shipping.edit')->with(compact('shipping_charges'));
   }
}
