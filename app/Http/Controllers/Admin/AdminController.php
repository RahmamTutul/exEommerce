<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\OtherSettings;
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
            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status'=>1])){
                 Alert::success('Success!', ' Login Successfully!');
                 return redirect('admin/dashboard');
            }else{
                Alert::error('Sorry!', ' Incorrect email And password!');
                return redirect()->back();
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
    public function AddAdmin(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
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
            $admin = New Admin;
            $admin->name=$data['name'];
            $admin->email=$data['email'];
            $admin->mobile=$data['mobile'];
            $admin->type=$data['type'];
            $admin->password=bcrypt($data['password']);
            $admin->image=$imageName;
            $admin->status=1;
            $admin->save();
            Alert::success('Success!', 'New admin added!');
            return redirect('admin/admin-subadmin');
        }
        return view('backend.pages.Admins.add');
    }
    public function EditAdmin(Request $request, $id){
        $adminInfo= Admin::find($id);
        // dd($adminInfo);
        if($request->isMethod('post')){
           $data= $request->all();

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
               $imageName=$adminInfo->image;
           }

           $adminInfo->name=$data['name'];
           $adminInfo->email=$data['email'];
           $adminInfo->mobile=$data['mobile'];
           $adminInfo->type=$data['type'];
           if(!empty($data['password'])){
            $adminInfo->password=bcrypt($data['password']);
           }
           $adminInfo->image=$imageName;
           $adminInfo->status=1;
           $adminInfo->update();
           Alert::success('Success!', 'Admin info updated!');
           return redirect('admin/admin-subadmin');
        };
        return view('backend.pages.Admins.edit')->with(compact('adminInfo'));
    }

    public function ChangeRole(Request $request ,$id){
        $adminId= $id;
        if($request->isMethod('post')){
           $data= $request->all();
           unset($data['_token']);
           unset($data['_method']);
           AdminRole::where('admin_id',$id)->delete();
           foreach ($data as $key => $value) {
              if(isset($value['view'])){
                 $view= $value['view'];
              }else{
                $view=0;
              }
              if(isset($value['edit'])){
                $edit= $value['edit'];
             }else{
               $edit=0;
             }
             if(isset($value['full'])){
                $full= $value['full'];
             }else{
               $full=0;
             }
             AdminRole::where('admin_id',$id)->insert(['admin_id'=>$id, 'module'=>$key, 'view_access'=>$view, 'edit_access'=>$edit, 'full_access'=>$full]);
           }

           Alert::success('Success!', 'Admin permission inserted!');
           return redirect()->back();
        }
        $adminRole =AdminRole::where('admin_id',$id)->get();
        // dd($adminRole);
       return view('backend.pages.Admins.update-role')->with(compact('adminId','adminRole'));
    }
    public function OtherSettings(Request $request, $id){
        $otherSettings= OtherSettings::where('id',1)->first()->toArray();

        if($request->isMethod('post')){
             $data= $request->all();
             OtherSettings::where('id',$id)->update(['min_cart_value'=>$request->min, 'max_cart_value'=>$request->max]);
             Alert::success('Success!', 'Min/Max value Updated!');
             return redirect()->back();
        }
        return view('backend.pages.Admins.other-settings')->with(compact('otherSettings'));
    }
}
