<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class CmsController extends Controller
{
   public function Index(){
      $getCurRout=url()->current();

      $getCurRout= str_replace("http://127.0.0.1:8000/","",$getCurRout);
      $cmsRoute =CMS::where('status',1)->select('url')->get()->pluck('url')->toArray();
    //   dd($cmsRoute);

      if(in_array($getCurRout, $cmsRoute)){
         $cmsPageDetails = CMS::where('url', $getCurRout)->first()->toArray();
        //  dd();
         return view('frontend.pages.cms_pages')->with(compact('cmsPageDetails'));
      }else{
          abort(404);
      }
   }

   public function Contact(Request $request){
       if($request->isMethod('post')){
           $data= $request->all();
          $email= "rahmantutul@yopmail.com";
          $massageData=[
              'name'=> $data['name'],
              'email'=> $data['email'],
              'subject'=> $data['subject'],
              'massage'=> $data['massage'],
          ];
          Mail::send('emails.enquiry', $massageData, function($massage) use($email) {
              $massage->to($email)->subject('Enquiry from E-commerce');
          });
          Alert::success('Success','Thank you for your enquiry!');
          return redirect()->back();
       }
       return view('frontend.pages.contact');
   }
}
