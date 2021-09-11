<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class AddressController extends Controller
{

    public function addAddress(Request $request){
        $userId= Auth::user()->id;
        $userData= User::find($userId)->toArray();
        $countries= Countries::where('status',1)->get()->toArray();
        if($request->isMethod('post')){
            $address= New DeliveryAddress();
            $data= $request->all();
            $address->user_id= Auth::user()->id;
            $address->name=$data['name'];
            $address->address=$data['address'];
            $address->city=$data['city'];
            $address->state=$data['state'];
            $address->country=$data['country'];
            $address->pincode=$data['pincode'];
            $address->mobile=$data['mobile'];
            $address->save();
            Alert::success('Success!','Your information saved successfully.');
            return redirect(url('/checkout'));
        }
        return view('frontend.pages.add_address')->with(compact('countries','userData'));
    }
    public function EditAddress(Request $request, $id ){
        $addressInfo = DeliveryAddress::find($id);
        $countries= Countries::where('status',1)->get()->toArray();
        if($request->isMethod('post')){
            $data= $request->all();
            $addressInfo->user_id= Auth::user()->id;
            $addressInfo->name=$data['name'];
            $addressInfo->address=$data['address'];
            $addressInfo->city=$data['city'];
            $addressInfo->state=$data['state'];
            $addressInfo->country=$data['country'];
            $addressInfo->pincode=$data['pincode'];
            $addressInfo->mobile=$data['mobile'];
            $addressInfo->save();
            Alert::success('Success!','Your address saved successfully.');
            return redirect()->back();
        }
        return view('frontend.pages.edit_address')->with(compact('addressInfo','countries'));
    }
    public function DeleteAddress($id){
       DeliveryAddress::find($id)->delete();
       return redirect()->back();
    }
}
