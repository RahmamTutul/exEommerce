<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function index(){
        $coupons= Coupon::get();
        return view('backend.pages.coupon.coupon')->with(compact('coupons'));
    }
    public function updateCouponStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Coupon::where('id',$data['coupon_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['coupon_id']]);
        }

    }

    public function createCoupon(){
        $categories=Section::with('categories')->get()->toArray();
        $users = User::select('email')->where('status',1)->get()->toArray();
        return view('backend.pages.coupon.create_coupon')->with(compact('categories','users'));
    }
    public function storeCoupon(Request $request){
        $data= $request->all();
        $request->validate([
           'coupon_option'=>'required',
           'categories'=>'required',
           'coupon_type'=>'required',
           'amount_type'=>'required',
           'amount'=>'required|numeric',
           'expiry_date'=>'required',
        ]);
        $coupon =New Coupon;
        if(isset($data['users'])){
            $users= implode(',',$data['users']);
        }else{
            $users="";
        }
        if(isset($data['categories'])){
            $categories= implode(',',$data['categories']);
        }
        if($data['coupon_option']=="Automatic"){
            $coupon_code = Str::random(8);
        }else{
            $coupon_code = $data['coupon_code'];
        }

        $coupon->coupon_option = $data['coupon_option'];
        $coupon->coupon_code   = $coupon_code;
        $coupon->categories    = $categories;
        $coupon->users         = $users;
        $coupon->coupon_type   = $data['coupon_type'];
        $coupon->amount_type   = $data['amount_type'];
        $coupon->amount        = $data['amount'];
        $coupon->expiry_date   = $data['expiry_date'];
        $coupon->status        = 1;
        $coupon->save();
        Alert::success('Success!',"New coupon has been added!");
        return redirect()->back();
    }

    public function editCoupon($id){
        $categories=Section::with('categories')->get()->toArray();
        $users = User::select('email')->where('status',1)->get()->toArray();
         $coupon= Coupon::find($id)->toArray();
         $selCat= explode(',',$coupon['categories']);
         $selUsers= explode(',',$coupon['users']);
        return view('backend.pages.coupon.edit_coupon')->with(compact('categories','users','coupon','selCat','selUsers'));
    }
    public function updateCoupon(Request $request, $id){
        $request->validate([
            'categories'=>'required',
            'coupon_type'=>'required',
            'amount_type'=>'required',
            'amount'=>'required|numeric',
            'expiry_date'=>'required',
         ]);
        if(isset($request['users'])){
            $users= implode(',',$request['users']);
        }else{
            $users="";
        }
        if(isset($request['categories'])){
            $categories= implode(',',$request['categories']);
        }
        $coupon= Coupon::find($id);
        $coupon->coupon_option = $request['coupon_option'];
        $coupon->categories    = $categories;
        $coupon->users         = $users;
        $coupon->coupon_type   = $request['coupon_type'];
        $coupon->amount_type   = $request['amount_type'];
        $coupon->amount        = $request['amount'];
        $coupon->expiry_date   = $request['expiry_date'];
        $coupon->status        = 1;
        $coupon->save();
        Alert::success('Success!',"Cupon has been updated!");
        return redirect()->back();
    }
    public function DeleteCoupon($id){
        $data= Coupon::find($id);
        $data->delete();
        Alert::success('Success!','Banner Deleted successfully!');
      return redirect()->back();
    }
}
