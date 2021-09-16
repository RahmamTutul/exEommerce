<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
class AdminController extends Controller
{
    public function index(){
        return view('backend.pages.index');
    }


    public function login(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            // echo "<pre>"; print_r($data); die;
            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status'=>1])){
                 Alert::success('Success!', ' Login Successfully!');
                return redirect('admin/dashboard');
            }else{
                Alert::error('Sorry!', ' Incorrect Email And Password!');
                return redirect('/admin')->with('massage');
            }

        }
        return view('backend.pages.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function settings(){
        $details = Auth::guard('admin')->user();
        return view('backend.pages.settings')
        ->with('detail', $details);

    }
    public function checkPassword(Request $request){
        $data= $request->all();
        if(Hash::check($data['current'], Auth::guard('admin')->user()->password)){

        }else{
            Alert::error('Invalid!', 'Current password do match!');
            return redirect()->back();
        }
    }

    public function UpdatePassword(Request $request){
       $request->validate([
           'current'=>'required',
           'new'=>'required',
           'confirm'=>'required'
       ]);
       $data= $request->all();
        if(Hash::check($data['current'], Auth::guard('admin')->user()->password)){
               if($data['new']==$data['confirm']){
                   Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new'])]);
                   Alert::success('Success!', 'Password Updated Successfully!');
                   return back();
               }
        }else{
            Alert::error('Invalid!', 'Passwords do match!');
            return redirect()->back();
        }
    }




    public function UpdateInfo(Request $request){
          if($request->isMethod('post')){

            $data=$request->all();
            $this->validate($request,[
                'name'=>'required|regex:/(^[A-Za-z]+$)+/',
                'phone'=>'required|numeric|digits:11',
                'image'=> 'image'
            ]);


            if($request->hasFile('image'))
            {

             $image=$request->file('image');
             $currentDate=Carbon::now()->toDateString();
             $imageName=$currentDate.'-'.uniqid().'-'.$image->getClientOriginalExtension();

             if(!Storage::disk('public')->exists('images/admin/profile'))
             {
                Storage::disk('public')->makeDirectory('images/admin/profile');
             }

             $profileImage = Image::make($image)->resize(400,400)->stream();
             Storage::disk('public')->put('images/admin/profile/'.$imageName,$profileImage);
            }else{
                $imageName= "default.png";
            }
            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['name'],'mobile'=>$data['phone'],'image'=>$imageName]);
            Alert::success('Success!', 'Information updated successfully!');
             return back();
          }

        $details = Auth::guard('admin')->user();
        return view('backend.pages.update-info')
        ->with('detail', $details);
    }
    public function AdminRole(){
        if(Auth::guard('admin')->user()->type=="subadmin"){
            Alert::error('Sorry!', 'You are not allowed to perform this action!');
            return redirect('admin/dashboard');
        }
        $allAdmins= Admin::get();
         return view('backend.pages.Admins.index')->with(compact('allAdmins'));
    }
    public function updateAdminStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Admin::where('id',$data['admin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['admin_id']]);
        }
    }
}
