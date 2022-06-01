<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Matters;
use App\Models\payments;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentFlowController extends Controller
{
    public function index(){
        return view('frontend.payment.input');
    }

    public function hash($param){

      $trading_id = $param['trading_id'];
      $payment_type = '02,05';
      $id = $param['id'];
      $seq_merchant_id = $param['seq_merchant_id'];
      $payment_class = '1';
      $hash_key = $param['hash_key'];
  
      // create hash hex string
      $org_str = $trading_id .
                $payment_type .
                $id .
                $seq_merchant_id .
                $payment_class .
                $hash_key;
      $hash_str = hash("sha256", $org_str);
  
      // create random string
      $rand_str = "";
      $rand_char = array('a','b','c','d','e','f','A','B','C','D','E','F','0','1','2','3','4','5','6','7','8','9');
      for($i=0; ($i<20 && rand(1,10) != 10); $i++){
        $rand_str .= $rand_char[rand(0, count($rand_char)-1)];
      }
      return $hash_str . $rand_str;
    }

    public function paygent($id){

        $status = Matters::STATUS_WAITING_PAYMENT;
        //請求書情報のデータ更新
        Matters::where('id', $id)->update(['status' => $status]);
        $amount =  Matters::where('id', $id)->value('invoice_amount');
        //paymentデータの更新
        payments::insert([
          'trading_id'     => $id,
          'payment_status' => $status,  
        ]);

        $seq_merchant_id = env('SEQ_MERCHANT_ID');
        $hash            = env('HASH_KEY');
        $url             = env('PAYGENT_URL');
        
        $param['trading_id']      = $id;
        $param['id']              = $amount;
        $param['seq_merchant_id'] = $seq_merchant_id;
        $param['hash_key']        = $hash;
        $param['hash']            = $this->hash($param);
        $param['url']             = $url;

        return $param;
    }

    

    public function check(Request $request){
        $checkAmount = config('const.amount_for_loan');
        $request->validate(
            [
                'cris_no' => 'required|numeric',
                'mail'    => 'required|email'
            ],
            [
                'cris_no.required' => '必須項目です。入力をお願いします。',
                'cris_no.numeric'  => '数を入力してください。',
                'mail.required'    => '必須項目です。入力をお願いします。',
                'mail.email'       => 'メールアドレス形式で指定してください。'
            ]
        );

        $bill = Matters::where('cris_no', $request->cris_no)
                ->where('mail', $request->mail)
                ->where([
                    ['status', '>', Matters::STATUS_DRAFT],
                    ['status', '!=', Matters::STATUS_PAYMENT_EXPIRED],
                    ['status', '!=', Matters::STATUS_REVIEW_IMPOSSIBLE],
                    ['status', '!=', Matters::STATUS_CANCEL],
                    ['status', '!=', Matters::STATUS_PAYMENT_ERROR],
                    ['status', '!=', Matters::STATUS_PAYMENT_EXPIRED],
                    ['status', '!=', Matters::STATUS_PROCESS_EXPIRED],
                    ['status', '!=', Matters::STATUS_PAYMENT_CONFIRMED],
                ])->first();

        if (!$bill) {
            return redirect()->back()->with('error', 'error');
        }else{
            session()->put('CURRENT_BILL', $bill);
            if ($bill->invoice_amount < $checkAmount) {

                $id = $bill->id;
                $param = $this->paygent($id);
                return view('frontend.payment.conf3', ['param' => $param, 'bill' => $bill]);
            }else{

                $id = $bill->id;
                $param = $this->paygent($id);
                return view('frontend.payment.conf2', ['param' => $param, 'bill' => $bill]);
            }
        }
    }

    public function showPDF(Request $request, $file_name)
    {
        $currentBill = (is_null(session()->get('CURRENT_BILL')) ? '' : session()->get('CURRENT_BILL'));
        if ( !isset($currentBill->invoice_pdf) || !isset($file_name) || $currentBill->invoice_pdf != $file_name) {
            return abort(404);
        }else {
            $path = storage_path('app/pdf/'.$file_name);
            return response()->make(file_get_contents($path), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$file_name.'"'
            ]);
        }
    }
    public function conf($id){
        $bill= Matters::find($id);
        return view('frontend.payment.conf',compact('bill'));
    }
    public function conf2(){
        return view('frontend.payment.conf2');
    }
    public function conf3(){
        return view('frontend.payment.conf3');
    }

    public function tokusyohou()
    {
        return view('frontend.payment.tokusyohou');
    }
    public function completed()
    {
        return view('frontend.payment.completed');
    }
    public function cash_error()
    {
        return view('frontend.payment.cash_error');
    }
    public function system_error()
    {
        return view('frontend.payment.system_error');
    }
}
