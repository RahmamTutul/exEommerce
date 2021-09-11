<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Countries;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function loginRegister(){
        return view('frontend.user.login-register');
    }
      // User Login
      public function UserLogin(Request $request){
         $data= $request->all();
          if($request->isMethod("post")){
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                //  Check user email is activated or not
                $userStatus = User::where('email',$data['email'])->first();
                if($userStatus->status==0){
                    Auth::logout();
                    Alert::error('Error!','Please confirm your email to activate account!');
                    return redirect()->back();
                }
                if(!empty(Session::get('session_id'))){
                    $session_id= Session::get('session_id');
                    $user_id= Auth::user()->id;
                    Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                }
                return redirect('/');
            }else{
                Alert::Error('Sorry!','Incorrect Email And Password!');
                return redirect()->back();
            }
          }
    }
    // User Registration
    public function UserRegister(Request $request){
        $data= $request->all();
        // dd($data);
        $checkEmail =User::where('email',$data['email']);
        if($checkEmail->count()>0){
            Alert::error('Sorry!','This Email is already taken!');
            return redirect()->back();
        }else{
            $user = New User;
            $user->email=$data['email'];
            $user->name=$data['name'];
            $user->mobile=$data['mobile'];
            $user->password= bcrypt($data['password']);
            $user->status=0;
            $user->save();
            // user email verification / send a verification code
            $email= $data['email'];
            $massageData=[
                'email'=>$data['email'],
                'name'=>$data['name'],
                'mobile'=>$data['mobile'],
                'code'=>base64_decode($data['email']),
            ];

            Mail::send('frontend.emails.register',$massageData,function($massage) use($email){
                $massage->to($email)->subject('Confirm your ex-commerce account.');
            });
            Alert::success('Success!','Please confirm your email to activate account!');
            return redirect()->back();

            // if( Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            //     if(!empty(Session::get('session_id'))){
            //         $session_id= Session::get('session_id');
            //         $user_id= Auth::user()->id;
            //         Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
            //     }
            //     // Send user a congratulation sms
            //         // $massage= "You are successfully registered! Happy Shopping! And keep connecting with us!";
            //         // $mobile= $data['mobile'];
            //         // sms::sendSms($massage,$mobile);

            //     // Send register user a congratulation email
            //       $email= $data['email'];
            //       $massageData= ['name'=>$data['name'], 'mobile'=>$data['mobile'], 'email'=>$data['email']];
            //       Mail::send('frontend.emails.register', $massageData, function($massage) use($email){
            //             $massage->to($email)->subject('Registered successfully! Happy Shopping!');
            //       });

            //         return redirect('/');
            // }
        }
    }
    // confirm email function
    public function confirmAccount($email){
        $email= base64_decode($email);
        // Check if already activated or not
        $userEmailCount = User::where('email',$email)->count();
        if($userEmailCount>0){
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status==1){
                Alert::success('Success!','Email is already activated! Just login.');
                return redirect()->back();
            }else{
                User::where('email',$email)->update(['status'=>1]);
                    // Send user a congratulation sms
                    // $massage= "You are successfully registered! Happy Shopping! And keep connecting with us!";
                    // $mobile= $data['mobile'];
                    // sms::sendSms($massage,$mobile);
                // Send register user a congratulation email
                  $massageData= ['name'=>$userDetails['name'], 'mobile'=>$userDetails['mobile'], 'email'=>$email];
                  Mail::send('frontend.confirm.register', $massageData, function($massage) use($email){
                        $massage->to($email)->subject('Registered successfully! Happy Shopping!');
                  });


            }
        }else{
            abort(404);
        }


    }

    // Forgot password
    public function forgotPassword(Request $request){
        if($request->isMethod('Post')){
            $data= $request->all();
            $emailCount= user::where('email',$data['email'])->count();
            if($emailCount==0){
                Alert::error('Error!','This email is not in our records!');
                return redirect()->back();
            }
            // Generate Random Password
             $random_password = Str::random(8);

            // Encode Password
            $new_password = bcrypt($random_password);

            // Update Password
            User::where('email',$data['email'])->update(['password'=>$new_password]);

            // Send new password
            $email= $data['email'];

            // Get user Name
            $userName = User::where('email',$email)->select('name')->first();

            $massageData =[
                'email'=>$email,
                'name'=>$userName,
                'password'=>$random_password,
            ];
            Mail::send('frontend.emails.forgot_password',$massageData,function($massage) use($email){
                $massage->to($email)->subject("Your New Password");
            });
            Alert::success('Success!','Check your email! We sent a new password.');
            return redirect('/login-register');
        }
        return view('frontend.user.forgot_password');
    }

    public function checkEmail(Request $request){
        // check if email is already exist or not
        $data=$request->all();
        $countEmail =User::where('email',$data['email'])->count();
        if($countEmail > 0){
            return "false";
        }else{
            return "true";
        }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    // My account function
    public function MyAccount(Request $request){
        $userId= Auth::user()->id;
        $userData= User::find($userId)->toArray();
        $counties= Countries::where('status',1)->get()->toArray();
        // dd($country);
        if($request->isMethod('post')){
            $data= $request->all();
            $userDetails = User::find($userId);
            $userDetails->name=$data['name'];
            $userDetails->address=$data['address'];
            $userDetails->city=$data['city'];
            $userDetails->state=$data['state'];
            $userDetails->country=$data['country'];
            $userDetails->pincode=$data['pincode'];
            $userDetails->mobile=$data['mobile'];
            $userDetails->save();
            Alert::success('Success!','Your information saved successfully.');
            return redirect()->back();
        }
        return view('frontend.user.my_account')->with(compact('userData','counties'));

    }
    // Check current password
    public function CheckCurrentPassword(Request $request){
      if($request->isMethod('post')){
            $data= $request->all();
            $user_id=Auth::user()->id;
            $checkPass=User::where('id',$user_id)->first();
            if(Hash::check($data['current'], $checkPass->password)){
                return "true";
            }else{
                return "false";
            }
      }
    }

    // Update password
    public function UpdateUserPassword(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
            $user_id=Auth::user()->id;
            $checkPass=User::where('id',$user_id)->first();
            if(Hash::check($data['current'], $checkPass->password)){
                $new_pswd = bcrypt($data['new']);
                User::where('id',$user_id)->update(['password'=>$new_pswd]);
                Alert::success('Success',"Password updated successfully!");
                return redirect()->back();
            }else{
                Alert::error("Something went wrong!"," Try Again.");
                return redirect()->back();
            }
      }
    }
}
