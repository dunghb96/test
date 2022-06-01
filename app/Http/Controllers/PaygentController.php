<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matters;
use App\Models\payments;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Error_mail;


class PaygentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function payment_recv(Request $request){
      Log::debug($request);
      try{
        $trading_data = json_encode($request);
        $status_code = $request->payment_status;
        if($status_code == 10){
          //決済中
          $status = Matters::STATUS_WAITING_PAYMENT;
        }elseif($status_code == 11 || $status_code == 15 || $status_code == 33 || $status_code == 32 || $status_code == 31){
          //決済NG
          $status = Matters::STATUS_PAYMENT_ERROR;
        }elseif($status_code == 20 || $status_code == 30){
          //決済OK
          $status = Matters::STATUS_PAYMENT_CONFIRMED;
        }elseif($status_code == 40 || $status_code == 41 ){
          //入金確認済
          $status = Matters::STATUS_PAYMENT_CONFIRMED;
        }elseif($status_code == 42 || $status_code == 50 || $status_code == 60){
          //キャンセル
          $status = Matters::STATUS_CANCEL;

        }

        //paymentデータの更新
        $id = DB::table('payments')
                  ->where('trading_id', $request->trading_id)
                  ->max('id');
        payments::where('id' , $id)->update(['payment_status' => $status,'trading_data' => $trading_data]);
        //請求書情報のデータ更新
        Matters::where('id', $request->trading_id)->update(['status' => $status]); 

        if($status_code == 11 || $status_code == 15 || $status_code == 33 || $status_code == 32 || $status_code == 31){
          //キャンセル
          $Matters =  Matters::find($request->trading_id);
          if($Matters){
            $to_address = $Matters['mail'];
            Mail::to($to_address)->send(new Error_mail($Matters));
          }
        }

        echo('result=0');
      } catch (\Exception $e) {
        Log::debug($e->getMessage());
      }
  }
}