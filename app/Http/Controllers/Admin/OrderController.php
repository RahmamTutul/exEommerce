<?php

namespace App\Http\Controllers\Admin;
use Dompdf\Dompdf;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Order_status;
use App\Models\OrdersLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;


class OrderController extends Controller
{
    public function Index(){
        $orders = Order::with('orders_products')->orderBy('id','Desc')->get()->toArray();
        //  dd($orders);
        return view('backend.pages.order.index')->with(compact('orders'));;
    }
    public function View($id){
        $orders = Order::with('orders_products')->where('id',$id)->first()->toArray();
        $userDetails = User::where('id',$orders['user_id'])->first()->toArray();
        $statuses =Order_status::where('status',1)->get()->toArray();
        $histories = OrdersLog::where('order_id',$id)->get()->toArray();
        return view('backend.pages.order.view')->with(compact('orders','userDetails','statuses','histories'));
    }
    Public function Invoice($id){
        $orders = Order::with('orders_products')->where('id',$id)->first()->toArray();
        $userDetails = User::where('id',$orders['user_id'])->first()->toArray();
        return view('backend.pages.order.invoice')->with(compact('orders','userDetails'));
    }
    Public function PrintPdf($id){
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $output = "";
        $dompdf->loadHtml($output);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

        $orders = Order::with('orders_products')->where('id',$id)->first()->toArray();
        $userDetails = User::where('id',$orders['user_id'])->first()->toArray();
        return view('backend.pages.order.printPdf')->with(compact('orders','userDetails'));
    }
    public function UpdateOrderStatus(Request $request){
        $data= $request->all();
        $id= $data['id'];
        $orders = Order::with('orders_products')->where('id',$id)->first()->toArray();

        // Update Order status courier Info

        if(!empty($data['courier_name']) && !empty($data['tracking_number'])){
            Order::where('id',$id)->update(['courier_name'=>$data['courier_name'],'tracking_number'=>$data['tracking_number']]);
        }
        $email=$orders['email'];
        $mobile=$orders['mobile'];
        $massageData=[
            'email'=>$email,
            'name'=>$orders['name'],
            'mobile'=>$mobile,
            'order_id'=>$id,
            'orderDetails'=>$orders,
        ];

        Mail::send('frontend.emails.order_status',$massageData,function($massage) use($email){
            $massage->to($email)->subject('Your Order shipment is in progress!.');
        });
        Order::where('id',$data['id'])->update(['order_status'=>$data['order_status']]);
        // Update Order Logs in table
        $log = New OrdersLog;
        $log->order_id = $data['id'];
        $log->order_status = $data['order_status'];
        $log->save();
        Alert::success('Success!','Order status updated!');
        return redirect()->back();
        }

}
