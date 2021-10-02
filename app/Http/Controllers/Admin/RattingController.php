<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RattingController extends Controller
{
    public function index(){
        $ratings= Rating::with(['user','product'])->get()->toArray();
        // dd($ratings);
        return view('backend.pages.ratting.index')->with(compact('ratings'));
    }
    public function updateRatingStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Rating::where('id',$data['rating_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'rating_id'=>$data['rating_id']]);
         }
    }
   
}
