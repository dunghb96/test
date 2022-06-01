
@extends('admin.layout.index')
@section('title')
    請求情報登録
@endsection
@section('content')
    <div class="container-fluid px-0" style="box-sizing: border-box">
        @include('admin.layout.breadcrumb_title', ['breadcrumb_title' => '請求情報編集'])
        <div class="container-form mt-4">
            <form action="{{route('admin.customer_register_confirm')}}" enctype="multipart/form-data" autocomplete="off" id="regis-form" method="get">
                @csrf
                <div class="border border-secondary top-form">
                    <div class="" style="margin: 0 20px">
                        <h4 style="margin-top: 20px">案件概要</h4>
                        <div class="form-group div-input">
                            <label for="...">CRIS No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="..." name="cris_no" value="{{$bill->cris_no}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="...">都道府県 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="..." name="address" value="{{$bill->address}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="text">部名 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="pwd" name="name" value="{{$bill->name}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="email">メールアドレス <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="mail" value="{{$bill->mail}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="...">点検コード等 <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="..." name="check_code" value="{{$bill->check_code}}">
                        </div>
                        <br>
                        <h4 style="margin-top: 20px">請求書情報</h4>
                        <div class="form-group div-input">
                            <label for="...">発行日 <span class="text-danger">*</span></label>
                            <input type="date" class="form-control w-auto" id="..." name="invoice_day" value="{{$bill->invoice_day}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="...">No. <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="..." name="invoice_no" value="{{$bill->invoice_no}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="...">金額<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="pwd" name="invoice_amount" value="{{$bill->invoice_amount}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="...">メール特筆記載項目</label>
                            <textarea name="invoice_mail_info" id="..." class="form-control" rows="6" placeholder="請求書送付メールに付記されます">{{$bill->invoice_mail_info}}</textarea>
                        </div>
                        <div class="form-group div-input">
                            <p>請求書PDFを登録</p>
                            <label class="btn btn-secondary" for="customFile" style="border: none"> ファイルを選択 </label>
                            <input type="file" id="customFile"  name="customFile" style="display: none" >
                        </div>
                    </div>
                </div>
                <div class="border border-secondary bot-form">
                    <div class="" style="margin: 0 20px">
                        <h4 style="margin-top: 20px">見積書</h4>
                        <div class="form-group div-input">
                            <label for="...">発行日</label>
                            <input type="date" class="form-control w-auto" id="..." name="estimate_day" value="{{$bill->estimate_day}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="...">No.</label>
                            <input type="number" class="form-control" id="..." name="estimate_no" value="{{$bill->estimate_no}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="...">金額</label>
                            <input type="number" class="form-control" id="..." name="estimate_amount" value="{{$bill->estimate_amount}}">
                        </div>
                        <br>
                        <h4 style="margin-top: 20px">可否連絡</h4>
                        <div class="form-group div-input">
                            <label for="...">受付日</label>
                            <input type="date" class="form-control w-auto" id="..." name="contact_day" value="{{$bill->contact_day}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="...">可否</label>
                            <select class="form-control w-auto">
                                <option>可</option>
                                <option>否</option>
                                <option>空白</option>
                            </select>
                        </div>
                        <br>
                        <h4 style="margin-top: 20px">修理</h4>
                        <div class="form-group div-input">
                            <label for="...">修理（修理完了後に入力）</label>
                            <input type="date" class="form-control w-auto" id="..." name="fix_day" value="{{$bill->fix_day}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="...">備考</label>
                            <textarea name="fix_info" id="..." class="form-control" rows="6">{{$bill->fix_info}}</textarea>
                        </div>
                        <br>
                        <h4 style="margin-top: 20px">入金（入金確認後に後に入力）</h4>
                        <div class="form-group div-input">
                            <label for="...">振込日</label>
                            <input type="date" class="form-control w-auto" id="..." name="pay_day" value="{{$bill->pay_day}}">
                        </div>
                        <div class="form-group div-input">
                            <label for="...">金額</label>
                            <input type="number" class="form-control" id="..." name="pay_amount" value="{{$bill->pay_amount}}">
                        </div>
                    </div>
                </div>
                <center>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary registration_btn" > 確認画面へ </button>
                    </div>
                </center>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/js/bill_registration_validation.js')  }}"></script>
    <script>
        $("#regite_toast").show();
        $("#regite_toast button").on('click', function(){
            $("#regite_toast").hide();
        });
    </script>
@endsection


