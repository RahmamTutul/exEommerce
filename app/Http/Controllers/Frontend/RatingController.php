<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function submitRate(Request $request){
        $data= $request->all();
        // dd($data);
        if (!Auth::check()) {
            Alert::error('Sorry!','You need to login first!');
            return redirect('/login-register');die;
        }

        if(!isset($data['star'])){
            Alert::error('Sorry!','Make sure you choose start!');
            return redirect()->back();die;
        }

        $rateCount = Rating::where(['user_id'=> Auth::user()->id, 'product_id'=> $data['product_id']])->count();
        if($rateCount>0){
            Alert::error('Sorry!','You already rate this product!');
            return redirect()->back();die;
        }else{
            $rate =New Rating();
            $rate->user_id= Auth::user()->id;
            $rate->product_id= $data['product_id'];
            $rate->retting= $data['star'];
            $rate->review= $data['review'];
            $rate->status= 0;
            $rate->save();
            Alert::success('Thank you!','');
            return redirect()->back();die;
        }
    }
}
