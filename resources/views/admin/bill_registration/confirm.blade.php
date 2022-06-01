
@php
    use App\Helpers\Helper;
    use App\Models\Matters;
    use Illuminate\Support\Facades\Session;
    if (!is_null(Session::get("BILL_DATA"))) {
        $sessionData = Session::get("BILL_DATA");
    }

    $title = isset($sessionData['type']) && $sessionData['type'] == 'edit' ? '請求情報編集の確認' : '請求書登録の確認'
@endphp

@extends('admin.layout.index')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="container-fluid px-0" style="box-sizing: border-box">
        @include('admin.layout.breadcrumb_title', ['breadcrumb_title' => $title])
        <div class="container-form" style="position: relative; right: 20px">
            <div class="confirm" style="margin: 0 20px">
                <ul class="list-update">
                    <li class="list-update__item list_task">
                        案件概要
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            CRIS No.
                        </div>
                        <div class="list-update__ct">
                            {{ isset($sessionData['cris_no']) ? 'IS '.$sessionData['cris_no'] : '' }}
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            都道府県
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['address'] ?? '' }}
                            @error('address')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            邸名/会社名
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['name'] ?? '' }}
                            @error('name')
                                <div><div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            メールアドレス
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['mail'] ?? '' }}
                            @error('mail')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            点検コード等
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['check_code'] ?? '' }}
                            @error('check_code')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>

                    <li class="list-update__item list_task">
                        請求書情報
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            発行日
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['invoice_day'] ?? '' }}
                            @error('invoice_day')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            No.
                        </div>
                        <div class="list-update__ct">
                            {{  $sessionData['invoice_no'] ? 'IS '.$sessionData['invoice_no'] : '' }}
                            @error('invoice_no')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            金額
                        </div>
                        <div class="list-update__ct">
                            @if ($sessionData['invoice_amount'] && is_numeric($sessionData['invoice_amount']))
                                {{ number_format($sessionData['invoice_amount']) .' 円' }}
                            @elseif($sessionData['invoice_amount'] && !is_numeric($sessionData['invoice_amount']))
                                {{ $sessionData['invoice_amount'] .' 円' }}
                            @else
                                {{ '' }}
                            @endif
                            @error('invoice_amount')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            メール特筆記載項目
                        </div>
                        <div class="list-update__ct">
                            @php echo nl2br(e($sessionData['invoice_mail_info'])) @endphp
                            @error('invoice_mail_info')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>

                    <li class="list-update__item">
                        <div class="list-update__head">
                            請求書PDFを{{ isset($sessionData['id']) ? '編集' : '登録' }}
                        </div>
                        <div class="list-update__ct">
                            @if ((isset($sessionData['customFile']) && $sessionData['customFile'] != null )  && (isset($sessionData['pdf_name']) && $sessionData['pdf_name'] != null ))
                                <a href="{{ isset($sessionData['customFile']) ? route('admin.file', ['file_name'=>$sessionData['customFile']]) : '' }}" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                    <span class="text-underline" >{{ isset($sessionData['pdf_name']) ? '  '.str_replace('/storage/uploads/pdf/', '', $sessionData['pdf_name']) : '' }}</span>
                                </a>
                            @endif
                            @error('customFile')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>

                    <li class="list-update__item list_task">
                        見積書
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            発行日
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['estimate_day'] ?? '' }}
                            @error('estimate_day')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            No.
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['estimate_no'] ? $sessionData['estimate_no'] : '' }}
                            @error('estimate_no')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            金額
                        </div>
                        <div class="list-update__ct">
                            @if ($sessionData['estimate_amount'] && is_numeric($sessionData['estimate_amount']))
                                {{ number_format($sessionData['estimate_amount']) .' 円' }}
                            @elseif($sessionData['estimate_amount'] && !is_numeric($sessionData['estimate_amount']))
                                {{ $sessionData['estimate_amount'] .' 円' }}
                            @else
                                {{ '' }}
                            @endif
                            @error('estimate_amount')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>

                    <li class="list-update__item list_task">
                        可否連絡
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            受付日
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['contact_day'] ?? '' }}
                            @error('contact_day')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            可否
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['contact_answer'] ?? '' }}
                            @error('contact_answer')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>

                    <li class="list-update__item list_task">
                        修理
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            対応日
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['fix_day'] ?? '' }}
                            @error('fix_day')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            備考
                        </div>
                        <div class="list-update__ct">
                            @php echo nl2br(e($sessionData['fix_info'])) @endphp
                            @error('fix_info')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>

                    <li class="list-update__item list_task">
                        入金
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            振込日
                        </div>
                        <div class="list-update__ct">
                            {{ $sessionData['pay_day'] ?? '' }}
                            @error('pay_day')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item">
                        <div class="list-update__head">
                            金額
                        </div>
                        <div class="list-update__ct">
                            @if ($sessionData['pay_amount'] && is_numeric($sessionData['pay_amount']))
                                {{ number_format($sessionData['pay_amount']) .' 円' }}
                            @elseif($sessionData['pay_amount'] && !is_numeric($sessionData['pay_amount']))
                                {{ $sessionData['pay_amount'] .' 円' }}
                            @else
                                {{ '' }}
                            @endif
                            @error('pay_amount')
                                <div><span class="text-danger">{{ $message }}</span></div>
                            @enderror
                        </div>
                    </li>
                    <li class="list-update__item list_task">
                        メールプレビュー
                    </li>
                    <div style='margin:1em'>
                        <?php
                            $url = url('/');
                            $img_path       = 'https://chart.googleapis.com/chart?cht=qr&chs=100x100&chl='.$url.'?authuser=0&choe=UTF-8';
                        ?>
                        @include('mails.invoice',[
                            'type'          => 'confirm',
                            'pref'          => $sessionData['address'],
                            'customer_name' => $sessionData['name'],
                            'url'           => $url,
                            'info'          => $sessionData['invoice_mail_info'],
                            'cris_no'       => $sessionData['cris_no'],
                            'img_path'      => $img_path,
                        ])
                    </div>
                </ul>
                <form action="{{ route('admin.customer_register.store') }}" method="post">
                    @csrf
                    @if (isset($sessionData['id']))
                        <input type="hidden" name="id" value="{{ $sessionData['id'] }}">
                    @endif
                    <div class="form-group confirm_btns" style="padding: 0; margin-bottom: 20px">
                        <center>
                            <button type="submit"  class="btn btn-primary confirm_btn" name="action" value="save">完了</button>
                            @if ( !isset($sessionData['status']) || $sessionData['status'] == Matters::STATUS_DRAFT)
                                <button type="submit"  class="btn btn-primary confirm_btn draft" name="action" value="draft">下書き</button>
                            @endif
                            <a href="{{ !empty($sessionData['id']) ? route('admin.bill.edit', ['id' => $sessionData['id'], 'back' => 1]) : route('admin.customer_register') }}" class="btn btn-primary confirm_btn back">前のページに戻る</a>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('head')
    <style>
        .list-update{
            box-sizing: border-box;

        }
        .list-update__ct{
            box-sizing: border-box;

        }
        .list-update__ct a{
            text-overflow: ellipsis;
            overflow:hidden;
        }
</style>
@endsection
{{-- @dd(1234) --}}

