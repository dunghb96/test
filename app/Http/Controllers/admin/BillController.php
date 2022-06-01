<?php

namespace App\Http\Controllers\admin;

use App\Exports\Export;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Matters;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRegisRequest;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\invoice_mail;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    private $matter;

    public function __construct(Matters $matter)
    {
        $this->matter = $matter;
    }

    public function index(Request $request)
    {
        try {
            $searchData = $request->except('page');
            $statusCountList = $this->matter->getStatusCounts();
            $bills = $this->matter->getAll($searchData)->appends($searchData);
            $isRememberChecked = strpos($request->headers->get('referer'), route('admin.home')) !== false;
            $statusCounts = [];
            foreach ($statusCountList as $item) {
                $statusCounts[$item->status] = $item->count;
            }

            if ($request->has('btnExport')) {
                $newSearchData = [];
                isset($searchData['status'])  ? $newSearchData['status'] =  'ステータス   ' . ':          ' . Matters::LIST_STATUS[$searchData['status']] : '';
                isset($searchData['id'])      ? $newSearchData['id']     =  'DB番号から   ' . ':          ' . $searchData['id'] : '';
                isset($searchData['id_2'])    ? $newSearchData['id_2']   =  'DB番号   ' . ':          ' . $searchData['id_2'] : '';
                isset($searchData['keyword']) ? $newSearchData['keyword']= 'キーワード'. ':           ' . $searchData['keyword'] : '';

                return Excel::download(new Export($bills, $newSearchData), 'Bills_' . Carbon::now() . '.csv');
            }
            return view('admin.bill.index', compact('bills', 'searchData', 'statusCounts', 'isRememberChecked'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

    public function create(Request $request)
    {
        $referrer = $request->headers->get('referer');
        if(strpos($referrer, route('admin.customer_register.confirm')) !== false || strpos($referrer, route('admin.customer_register.store')) !== false ) {
            $sessionData = Session::get("BILL_DATA");
        } else {
            Session::forget('BILL_DATA');
            $sessionData = [];
        }
        return view('admin.bill_registration.index', compact('sessionData'));
    }

    public function confirm(CustomerRegisRequest $request)
    {
        $sessionName = 'BILL_DATA';
        $postData = $request->all();
        if($request->invoice_amount){
            $postData['invoice_amount']  = str_replace(',', '', $postData['invoice_amount']);
        }
        if($request->estimate_amount){
            $postData['estimate_amount'] = str_replace(',', '', $postData['estimate_amount']);
        }
        if($request->pay_amount){
            $postData['pay_amount']      = str_replace(',', '', $postData['pay_amount']);
        }

        unset($postData['uploadFile']);
        if (isset($postData['customFile']) && $postData['customFile'] == '') {
            $postData['pdf_name'] = '';
        } else {
            $sessionNameFileInfo = $postData['customFile'];
            $postData['pdf_name'] = $sessionNameFileInfo == '' || is_null(session()->get($sessionNameFileInfo)) ? '' : session()->get($sessionNameFileInfo);

            if (isset($postData['id']) && $postData['pdf_name'] == '') {
                $bill = Matters::find($postData['id']);
                if (is_null($bill)) {
                    return abort(404);
                }
                $postData['customFile'] = $bill->invoice_pdf;
                $postData['pdf_name']   = $bill->pdf_name;
            }
        }

        Session::forget($sessionName);
        $postData['sessionName'] = $sessionName;
        session()->put($sessionName, $postData);

        return redirect()->route('admin.customer_register.show_confirm');
    }

    public function showConfirm(Request $request)
    {
        $sessionName = 'BILL_DATA';
        $sessionData = !is_null(Session::get($sessionName)) ? Session::get($sessionName) : '';
        if ($sessionData == '') {
            return redirect(route('admin.customer_register'));
        }
        return view('admin.bill_registration.confirm', compact('sessionData'));
    }

    public function invoice_mail($dataSave){

        $to_address = $dataSave['mail'];
        Mail::to($to_address)->send(new invoice_mail($dataSave));
    }

    public function store(Request $request) {
        $sessionName = 'BILL_DATA';
        $data = (is_null(session()->get($sessionName)) ? '' : session()->get($sessionName));

        if (empty($data)) {
            logger('session data not found');
            abort(400);
        }

        $ruleArr = [
            'cris_no'=>[
                'required',
                'numeric',
            ],
        ];
        if ($request->get('action') == 'save') {
            $ruleAdds = [
                'address'           =>  'required',
                'name'              =>  'required|max:255',
                'mail'              => [
                                        'required',
                                        'email'
                                        ],
                'check_code'        => [
                                        'nullable',
                                        'max:255',
                                        'regex:/^[a-zA-Z0-9]+$/'
                                        ],
                'invoice_day'       =>  'nullable|after:-10 year|before:+10 year',
                'invoice_no'        =>  'required|max:7|same:cris_no',
                'invoice_amount'    =>  'required|digits_between:1,11',
                'invoice_mail_info' =>  'required',
                'estimate_no'       =>  [
                                        'nullable',
                                        'max:255',
                                        'regex:/^[a-zA-Z0-9]+$/'
                                        ],
                'estimate_amount'   =>  'nullable|digits_between:1,11',
                'estimate_day'      =>  'nullable|after:-10 year|before:+10 year',
                'pay_amount'        =>  'nullable|digits_between:1,11',
                'contact_day'       =>  'nullable|after:-10 year|before:+10 year',
                'fix_day'           =>  'nullable|after:-10 year|before:+10 year',
                'pay_day'           =>  'nullable|after:-10 year|before:+10 year',
                'customFile'        =>  'required'
            ];
            foreach ($ruleAdds as $field => $rule) {
                $ruleArr[$field] = $rule;
            }
        }

        if ($request->get('action') == 'draft') {
            $ruleAdds = [
                'check_code'        => [
                                        'nullable',
                                        'max:255',
                                        'regex:/^[a-zA-Z0-9]+$/'
                                        ],

                'invoice_day'       =>  'nullable|after:-10 year|before:+10 year',
                'invoice_no'        =>  'max:7|same:cris_no',
                'invoice_amount'    =>  'digits_between:1,11',
                'estimate_no'       =>  [
                                        'nullable',
                                        'max:255',
                                        'regex:/^[a-zA-Z0-9]+$/'
                                        ],
                'estimate_amount'   =>  'nullable|digits_between:1,11',
                'estimate_day'      =>  'nullable|after:-10 year|before:+10 year',
                'pay_amount'        =>  'nullable|digits_between:1,11',
                'contact_day'       =>  'nullable|after:-10 year|before:+10 year',
                // 'contact_answer'=>'required|max:20',
                'fix_day'=>'nullable|after:-10 year|before:+10 year',
                'pay_day'=>'nullable|after:-10 year|before:+10 year'
                // 'pay_amount'=>'required|numeric',
                // 'pay_to'=>'required|max:20',
                // 'status'=>'required|max:20',
            ];
            foreach ($ruleAdds as $field => $rule) {
                $ruleArr[$field] = $rule;
            }
        }

        $validator = Validator::make($data, $ruleArr, Helper::ERROR_MESSAGE);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = [
            'cris_no',
            'address',
            'name',
            'mail',
            'check_code',
            'invoice_day',
            'invoice_no',
            'invoice_amount',
            'invoice_mail_info',
            'estimate_day',
            'estimate_no',
            'estimate_amount',
            'contact_day',
            'contact_answer',
            'fix_day',
            'fix_info',
            'pay_day',
            'pay_amount',
        ];

        $dataSave = [];
        foreach ($fields as $field) {
            if (isset($data[$field]) && trim($data[$field]) != '') {
                $dataSave[$field] = $data[$field];
            }
        }
        if (isset($data['customFile'])) {
            $dataSave['invoice_pdf'] = $data['customFile'];
            $dataSave['pdf_name'] = $data['pdf_name'];
        }

        if ($dataSave) {
            if (!empty($data['id'])) {
                if ($data['status'] == Matters::STATUS_DRAFT && $request->get('action') == 'save') {
                    $dataSave['status'] = Matters::STATUS_INVOICE_SENT;
                    $this->invoice_mail($dataSave);
                }
                $this->matter->where('id', $data['id'])->update($dataSave);
                Session::forget($sessionName);
                if($request->get('action') == 'save') {
                    return redirect()->route('admin.bill.edit', ['id'=>$data['id']])->with('success', 'edit');
                }else {
                    return redirect()->route('admin.bill.edit', ['id'=>$data['id']])->with('success', 'draft');
                }

            } else {
                if ($request->get('action') == 'save') {
                    $dataSave['status'] = Matters::STATUS_INVOICE_SENT;
                    $currentBill = $this->matter->create($dataSave);
                    $this->invoice_mail($dataSave);
                }else {

                    $dataSave['status'] = Matters::STATUS_DRAFT;
                    $currentBill = $this->matter->create($dataSave);
                    return redirect()->route('admin.bill.edit', ['id'=>$currentBill->id])->with('success', 'draft');

                }
            }
        }
        Session::forget("BILL_DATA");
        return redirect()->route('admin.bill.edit', ['id'=>$currentBill->id])->with('success', 'create');
    }

    public function edit(Request $request, $id) {
        if($request->back == 1) {
            $sessionData = Session::get("BILL_DATA");
        } else {
            Session::forget('BILL_DATA');
            $sessionData = $this->matter->find($id);
            $sessionData['customFile'] = $sessionData['invoice_pdf'];
        }
        return view('admin.bill_registration.index', compact('sessionData'));
    }

    public function delete(Request $request)
    {
        try {
            $id = json_decode($request->input('id'));
            $this->matter->find($id)->delete();
            $request->session()->flash('success', '請求書を削除しました。');
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (\Exception $exception) {
            $request->session()->flash('error', 'エラーが発生しました。');
            //DB::rollBack();
            Log::error('message:' . $exception->getMessage() . '----Line: ' . $exception->getMessage());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            $ids = json_decode($request->input('id'));
            $ids = array_unique($ids ?? []);
            if (empty($ids)) {
                Log::error('ids was not found');
                $request->session()->flash('error', 'エラーが発生しました。');
            }
            $this->matter->whereIn('id', $ids)->delete();
            $request->session()->flash('success', '請求書を削除しました。');
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'エラーが発生しました。');
            //DB::rollBack();
            Log::error('message:' . $exception->getMessage() . '----Line: ' . $exception->getMessage());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function showPdf($fileNameUrl = null) {
        $filename = $fileNameUrl;
        if(!isset($filename)){
            return abort(404);
        }
        $path = storage_path('app/pdf/'.$filename);
        return response()->make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
    public function uploadPdf(Request $request)
    {
        if (!$request->hasFile('uploadFile')) {
            return response()->json([]);
        }

        $fileName = 'invoice_'.uniqid() . '-' . time().'.pdf';
        $request->file('uploadFile')->storeAs('pdf', $fileName);
        $postData['pdf_name'] = $request->uploadFile->getClientOriginalName();
        $postData['customFile'] = $fileName;
        unset($postData['uploadFile']);

        $sessionName = $postData['customFile'];
        Session::forget($sessionName);
        session()->put($sessionName, $postData['pdf_name']);
        return response()->json([
            'customFile' => $postData['customFile'],
            'url' => route('admin.file', ['file_name'=>$postData['customFile']]),
            'pdf_name' => $postData['pdf_name']
        ]);
    }
}
