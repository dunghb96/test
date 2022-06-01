
@php
    use App\Models\Matters;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Session;

    if (!is_null(Session::get("BILL_DATA"))) {
        $sessionData = Session::get("BILL_DATA");
    }

    $title =     isset($sessionData['id']) ? '請求情報編集' : '請求情報登録';

    $toast_str = [
        'create' => '請求情報登録が完了しました。',
        'edit'   => '請求情報編集が完了しました。',
        'draft'  => '下書き保存しました。'
    ];
    $session = Session::get('success');

@endphp

@extends('admin.layout.index')
@section('title')
    {{ $title  }}
@endsection
@section('content')
    <div class="container-fluid px-0" style="box-sizing: border-box">
        @include('admin.layout.breadcrumb_title', ['breadcrumb_title' => $title])
        <div class="container-form mt-4">
            <div id="regite_toast" class="toast align-items-center text-white bg-primary border-0 mb-1" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    @if (session('success') && session('success') != null)
                        <div class="toast-body">
                            {{ isset($session) ? $toast_str[$session] : '' }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    @endif
                </div>
            </div>
            <form action="{{ route('admin.customer_register.confirm') }}" enctype="multipart/form-data" autocomplete="off" id="regis-form" method="post">
                @csrf
                @if ( isset($sessionData['id']))
                    <input type="hidden" name="id" value="{{ $sessionData['id'] }}">
                    <input type="hidden" name="status" value="{{ $sessionData['status'] }}">
                    <input type="hidden" name="pay_to" value="{{ $sessionData['pay_to'] }}">
                @endif
                <div class="border border-secondary top-form">
                    <div class="" style="margin: 0 20px">
                        <h4 style="margin-top: 20px">案件概要</h4>
                        <div class="form-group div-input">
                            <label for="cris_no">CRIS No. <span class="text-danger">*</span></label>
                            <table>
                                <tr style="line-height: 15px;">
                                    <th style="padding-top: 20px; font-weight: normal; font-size: larger;">IS &nbsp;</th>
                                    <td style="width: 99%"><input type="number" class="form-control" id="cris_no" name="cris_no" value="{{ isset($sessionData['cris_no']) ? $sessionData['cris_no'] : (old('cris_no') ? old('cris_no') : '') }}" ></td>
                                </tr>
                            </table>
                            @error('cris_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="address">都道府県 </label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ isset($sessionData['address']) ? $sessionData['address'] : (old('address') ? old('address') : '') }}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="name">邸名/会社名 </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ isset($sessionData['name']) ? $sessionData['name'] : (old('name') ? old('name') : '') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="mail">メールアドレス </label>
                            <input type="email" class="form-control" id="mail" name="mail" value="{{ isset($sessionData['mail']) ? $sessionData['mail'] : (old('mail') ? old('mail') : '') }}">
                            @error('mail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="check_code">点検コード等 </label>
                            <input style="width: 50%;" class="form-control" id="check_code" name="check_code" value="{{ isset($sessionData['check_code']) ? $sessionData['check_code'] : (old('check_code') ? old('check_code') : '') }}">
                            @error('check_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <h4 style="margin-top: 20px">請求書情報</h4>
                        <div class="form-group div-input">
                            <label for="invoice_day">発行日 </label>
                            <input type="date" class="form-control w-auto" max="9999-12-31" id="invoice_day" name="invoice_day" value="{{ isset($sessionData['invoice_day']) ? Carbon::parse($sessionData['invoice_day'])->format('Y-m-d') : (old('invoice_day') ? old('invoice_day') : '') }}">
                            @error('invoice_day')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="invoice_no">No. </label>
                            <table>
                                <tr style="line-height: 15px;">
                                    <th style="padding-top: 20px; font-weight: normal; font-size: larger;">IS &nbsp;</th>
                                    <td style="width: 99%"><input  type="number" class="form-control" id="invoice_no" name="invoice_no" value="{{ isset($sessionData['invoice_no']) ? $sessionData['invoice_no'] : (old('invoice_no') ? old('invoice_no') : '') }}"></td>
                                </tr>
                            </table>
                            @error('invoice_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="invoice_amount">金額 </label>
                            <input  type="text" class="form-control money" id="invoice_amount" name="invoice_amount" value="{{ isset($sessionData['invoice_amount']) ? $sessionData['invoice_amount'] : old('invoice_amount') }}">
                            @error('invoice_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="invoice_mail_info">メール特記事項（請求書送付メールに付記されます）</label>
                            <textarea name="invoice_mail_info" id="" class="form-control" rows="6" >{{ isset($sessionData['invoice_mail_info']) ? $sessionData['invoice_mail_info'] : (old('invoice_mail_info') ? old('invoice_mail_info') : '') }}</textarea>
                            @error('invoice_mail_info')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group div-input pdf">
                            <p>請求書PDFを {{ isset($sessionData['id']) ? '編集' : '登録' }} </p>
                            <div class="file-upload-container">
                                <label class="btn btn-secondary" for="my-file-input" style="border: none"> ファイルを選択 </label>
                                <input type="file" id="my-file-input" name="uploadFile" style="display: none" accept=".pdf">
                                <span class="js-receive-file">
                                    @php
                                        $customFile = isset($sessionData['customFile']) ? $sessionData['customFile'] : (old('customFile') ?? old('customFile'));
                                        $pdfName = isset($sessionData['pdf_name']) ? $sessionData['pdf_name'] : (old('pdf_name') ?? old('pdf_name'));
                                    @endphp
                                    @if ($customFile && $pdfName)
                                        <a class="file-edit" style="margin-left: 20px;" target="_blank" href="{{route('admin.file', ['file_name'=>$customFile])}}">
                                            <i class="fas fa-file-pdf"></i>
                                            <span class="text-underline" >{{ '  '. $pdfName }}</span>
                                        </a>
                                    @endif
                                </span>
                                <input type="hidden" class="checkBack" name="customFile" value="{{ $customFile }}">
                                <input type="hidden" class="checkBack" name="pdf_name" value="{{ $pdfName }}">
                                @error('uploadFile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border border-secondary bot-form">
                    <div class="" style="margin: 0 20px">
                        <h4 style="margin-top: 20px">見積書</h4>
                        <div class="form-group div-input">
                            <label for="estimate_day">発行日</label>
                            <input type="date" class="form-control w-auto" max="9999-12-31" id="estimate_day" name="estimate_day" value="{{ isset($sessionData['estimate_day']) ? Carbon::parse($sessionData['estimate_day'])->format('Y-m-d') : (old('estimate_day') ? old('estimate_day') : '') }}">
                            @error('estimate_day')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="estimate_no">No.</label>
                            <input  class="form-control" id="estimate_no" name="estimate_no" value="{{ isset($sessionData['estimate_no']) ? $sessionData['estimate_no'] : (old('estimate_no') ? old('estimate_no') : '') }}">
                            @error('estimate_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="estimate_amount">金額</label>
                            <input type="text" class="form-control money" id="estimate_amount" name="estimate_amount" value="{{ isset($sessionData['estimate_amount']) ? $sessionData['estimate_amount'] : old('estimate_amount') }}">
                            @error('estimate_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <h4 style="margin-top: 20px">可否連絡</h4>
                        <div class="form-group div-input">
                            <label for="contact_day">受付日</label>
                            <input type="date" class="form-control w-auto" max="9999-12-31" id="contact_day" name="contact_day" value="{{ isset($sessionData['contact_day']) ? Carbon::parse($sessionData['contact_day'])->format('Y-m-d') : (old('contact_day') ? old('contact_day') : '') }}">
                        </div>
                        <div class="form-group div-input">
                            <label for="contact_answer">可否</label>
                            <select class="form-control w-auto " name="contact_answer" >
                                <option value="">選択してください</option>
                                @foreach (Matters::LIST_ANSWER as $value)
                                <option {{ isset($sessionData['contact_answer']) && $sessionData['contact_answer'] == $value ? 'selected' : ''}} value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('contact_answer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <h4 style="margin-top: 20px">修理（修理完了後に入力）</h4>
                        <div class="form-group div-input">
                            <label for="fix_day">対応日</label>
                            <input type="date" class="form-control w-auto" max="9999-12-31" id="fix_day" name="fix_day" value="{{ isset($sessionData['fix_day']) ? Carbon::parse($sessionData['fix_day'])->format('Y-m-d') : (old('fix_day') ? old('fix_day') : '') }}">
                            @error('fix_day')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="fix_info">備考</label>
                            <textarea name="fix_info" id="fix_info" class="form-control" rows="6">{{ isset($sessionData['fix_info']) ? $sessionData['fix_info'] : (old('fix_info') ? old('fix_info') : '') }}</textarea>
                            @error('fix_info')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <h4 style="margin-top: 20px">入金（入金確認後に後に入力）</h4>
                        <div class="form-group div-input">
                            <label for="pay_day">振込日</label>
                            <input type="date" class="form-control w-auto" max="9999-12-31" id="pay_day" name="pay_day" value="{{ isset($sessionData['pay_day']) ? Carbon::parse($sessionData['pay_day'])->format('Y-m-d') : (old('pay_day') ? old('pay_day') : '') }}">
                            @error('pay_day')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="pay_amount">金額</label>
                            <input type="text" class="form-control money" id="pay_amount" name="pay_amount" value="{{ isset($sessionData['pay_amount']) ? $sessionData['pay_amount'] : old('pay_amount') }}">
                            @error('pay_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <center>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary registration_btn" name="action" value="to_confirm"> 確認画面へ </button>
                    </div>
                </center>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/js/bill_registration_validation.js') }}"></script>
    <script src="{{ asset('admin/js/uppy.min.js') }}"></script>
    <script src="{{ asset('admin/js/ja_JP.min.js') }}"></script>
    <script>
        $("#regite_toast").show();
        $("#regite_toast button").on('click', function() {
            $("#regite_toast").hide();
        });

        function formatMoney(value){
            if (value == '') {
                return;
            }
            var value = parseInt(value.replace(/\D/g,''),10);
            var format = new Intl.NumberFormat('ja-JP', { style: 'currency', currency: 'JPY' }).format(value)
            var lastFormat = format.replace(new RegExp('\\￥', 'g'), '');
            return lastFormat;
        }

        $(".money").each(function( index ) {
            var value = $(this).val().trim();
            $(this).val(formatMoney(value));
        });

        $(".money").on('keyup', function(){
            var value = $(this).val().trim();
            $(this).val(formatMoney(value));
        });

        var uppy = new Uppy.Core({
            debug: true,
            autoProceed: true,
            restrictions: {
                maxFileSize: 5120000,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                allowedFileTypes: ['.pdf']
            },
            locale: Uppy.locales.ja_JP,
        })

        const fileInput = document.querySelector('#my-file-input')

        fileInput.addEventListener('change', (event) => {
            const files = Array.from(event.target.files)
            // console.log(files)
            $('.file-error').remove()
            files.forEach((file) => {
                try {
                    uppy.addFile({
                        source: 'file input',
                        name: file.name,
                        type: file.type,
                        data: file,
                    })
                } catch (err) {
                    var html = '<label class="file-error error text-danger">'+ (err.toString().replace('Error: ', '')) +'</label>';
                    $('.js-receive-file').html('');
                    $('.file-upload-container').append(html)
                    $('input[name="customFile"]').val('');
                }
            })
        })

        uppy.use(Uppy.XHRUpload, {
            target: '#drag-drop-area',
            endpoint: "{{route('upload_pdf')}}",
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            overridePatchMethod: false,
            fieldName: 'uploadFile',
            getResponseError: ({ response }) => {
                this.props.handleError(JSON.parse(response).message);
            }
        })
        uppy.on('complete', (result) => {
            var image_icon = result.successful[0].response.body.data;

        })
        uppy.on('thumbnail:generated', (file, preview) => {
            console.log('preview', file);
            const img = new Image();
            img.src = preview;
            img.onload = () => {
                const aspect_ratio = img.width / img.height;
                // Remove image if the aspect ratio is too weird.
                // TODO: notify user.
                if (aspect_ratio > 1.8) {
                    uppy.removeFile(file.id);
                }
            }
        });
        uppy.on('upload-success', (file, response) => {
            uppy.reset()
            if (response) {
                $('.file-edit').remove();
            }
            var customFile = response.body.customFile;
            var url        = response.body.url;
            var pdf_name   = response.body.pdf_name;
            $('input[name="customFile"]').val(customFile);
            $('input[name="pdf_name"]').val(pdf_name);
            var html = '<a style="margin-left: 20px;" target="_blank" href="'+ url +'">'
                html += '<i class="fas fa-file-pdf"></i>'
                html += '<span class="text-underline" >'+'  '+ pdf_name +'</span></a>'

            $('.js-receive-file').html(html);

        });

    </script>
@endsection
