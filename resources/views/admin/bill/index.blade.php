@php
    use App\Models\Matters;
    use App\Models\User;
    $errorTotal =   ($statusCounts[Matters::STATUS_REVIEW_IMPOSSIBLE] ?? 0)
                    + ($statusCounts[Matters::STATUS_PAYMENT_ERROR] ?? 0);
    $waitingPayment = ($statusCounts[Matters::STATUS_WAITING_PAYMENT] ?? 0);
    $paymentConfirmed = ($statusCounts[Matters::STATUS_PAYMENT_CONFIRMED] ?? 0);
    $loginUser = Auth::guard('admin')->user();
@endphp
@extends('admin.layout.index')
@section('title')
    請求書一覧
@endsection
@section('content')
    <div class="container-fluid px-0">
        @include('admin.layout.breadcrumb_title', ['breadcrumb_title' => '請求書一覧'])
        @include('admin.layout.flash-message')
        <div class="col-md-12 col-sm-12 mt-4">
            <div style="background: #ffcc99; font-weight: bolder ">
                <div class="row" style="padding: 20px">
                    <!-- 入金確認済み -->
                    <div class="col-md-2 col-sm-2">{{Matters::LIST_STATUS_HEADER[Matters::STATUS_PAYMENT_CONFIRMED]}}:
                        <br> <span class="center" style="text-align: center">{{ $paymentConfirmed ?? 0}} 件</span>
                    </div>
                    <!-- 入金待ち -->
                    <div class="col-md-2 col-sm-2">{{Matters::LIST_STATUS_HEADER[Matters::STATUS_WAITING_PAYMENT]}}:
                        <br> <span class="center" style="text-align: center">{{ $waitingPayment ?? 0}} 件</span>
                    </div>
                    <!-- 審査中 -->
                    <div class="col-md-2 col-sm-2">{{Matters::LIST_STATUS_HEADER[Matters::STATUS_UNDER_REVIEW]}}:
                        <br> <span class="center" style="text-align: center">{{$statusCounts[Matters::STATUS_UNDER_REVIEW] ?? 0}} 件</span>
                    </div>
                    <!-- 請求書送信済み -->
                    <div class="col-md-2 col-sm-2">{{Matters::LIST_STATUS_HEADER[Matters::STATUS_INVOICE_SENT]}}:
                        <br> <span class="center" style="text-align: center">{{$statusCounts[Matters::STATUS_INVOICE_SENT] ?? 0}} 件</span>
                    </div>
                </div>
                <hr style="margin: 0 20px">
                <div class="row" style=" padding: 20px">
                    <!-- 入金エラー -->
                    <div class="col-md-2 col-sm-2">{{Matters::LIST_STATUS_HEADER[Matters::STATUS_PAYMENT_ERROR]}}:
                        <br> <span class="center" style="text-align: center">{{$statusCounts[Matters::STATUS_PAYMENT_ERROR] ?? 0}} 件</span>
                    </div>
                    <!-- 審査結果_不可 -->
                    <div class="col-md-2 col-sm-2">{{Matters::LIST_STATUS_HEADER[Matters::STATUS_REVIEW_IMPOSSIBLE]}}:
                        <br> <span class="center" style="text-align: center">{{$statusCounts[Matters::STATUS_REVIEW_IMPOSSIBLE] ?? 0}} 件</span>
                    </div>
                    <!-- 登録中 -->
                    <div class="col-md-2 col-sm-2">{{Matters::LIST_STATUS_HEADER[Matters::STATUS_DRAFT]}}:
                        <br> <span class="center" style="text-align: center">{{$statusCounts[Matters::STATUS_DRAFT] ?? 0}} 件</span>
                    </div>
                    <!-- キャンセル -->
                    <div class="col-md-2 col-sm-2">{{Matters::LIST_STATUS_HEADER[Matters::STATUS_CANCEL]}}:
                        <br> <span class="center" style="text-align: center">{{$statusCounts[Matters::STATUS_CANCEL] ?? 0}} 件</span>
                    </div>
                </div>
            </div>
            <input type="hidden" name="ids" id="checked-ids" value=""/>
            <input type="hidden" name="crisnos" id="checked-crisnos" value=""/>
            <form class="d-md-inline-block form-inline" style="width: 100%;" method="get">
                <div class="row" style="margin-bottom: 10px; margin-top: 5rem">
                    <div class="col-md-4 col-sm-4">
                        <button class="btn btn-primary upload-pdf" type="button" id="btnExport" >
                            <i class="fas fa-download"></i> &nbsp;CSV出力
                        </button>
                        @if ( $loginUser->auth == User::MANAGER_USER )
                            <button class="btn btn-warning delete" type="button" id="btnDelAll" name="btnDelete" value="btnDelete" >
                                <i class="fas fa-trash"></i> &nbsp;一括削除
                            </button>
                        @endif
                    </div>
                    <div class="col-md-8 col-sm-8" style="display: flex; justify-content: flex-end">
                        <div class="input-group">
                            <select name="status" id="" class="form-select" style="max-width: 240px; margin-right: 15px;">
                                <option disabled selected value="">ステータスで絞り込む</option>
                                <option value="">すべて</option>
                                @foreach (Matters::LIST_STATUS_HEADER as $key => $value)
                                    <option {{ isset($searchData['status']) && $searchData['status'] == $key ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <input class="form-control mr-2" id="input-search" type="text" placeholder="DB番号" aria-label="Search for..." name="id" value="{{  $searchData['id'] ?? '' }}"   style="max-width: 100px" aria-describedby="btnNavbarSearch"/>
                            <label class="my-1 mr-1 pt-1"> 〜 </label>
                            <input class="form-control" id="input-search" type="text" placeholder="DB番号" aria-label="Search for..." name="id_2" value="{{  $searchData['id_2'] ?? '' }}"   style="max-width: 100px" aria-describedby="btnNavbarSearch"/>　
                            <input class="form-control" id="input-search" type="text" placeholder="氏名, 請求書番号" aria-label="Search for..." name="keyword" value="{{  $searchData['keyword'] ?? '' }}" aria-describedby="btnNavbarSearch"/>
                            <button class="btn btn-primary btn-search" id="btnNavbarSearch" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="x_content">
                <div class="row" style="box-sizing: border-box; margin: 0;">
                    <div class="col-sm-12 " style="padding: 0">
                        <div class="card-box table-responsive">
                            <table class="table table-bordered" id="billList" style="width:100%">
                                <thead style="background: #ffcc99">
                                    <tr>
                                        @if ( $loginUser->auth == User::MANAGER_USER )
                                            <td><input type="checkbox" id="check-all"></td>
                                        @endif
                                        <th style="border-right: 1px solid white">DB番号</th>
                                        <th style="border-right: 1px solid white">請求書 No.</th>
                                        <th class="customer_name" style="border-right: 1px solid white">邸名/会社名</th>
                                        <th style="border-right: 1px solid white">支払い手続き先</th>
                                        <th>ステータス</th>
                                        <th class="status_col"></th>
                                    </tr>
                                </thead>
                                <tbody style="border-top:1px solid #E2E2E2">
                                    @if ($bills->count() != 0)
                                        @foreach( $bills as $bill)
                                            <tr>
                                                @if ( $loginUser->auth == User::MANAGER_USER )
                                                    <td><input type="checkbox" name="ids" id="id-{{ $bill->id }}" class="cb-bill check-item" value="{{ $bill->id }}" data-cris_no="{{ $bill->cris_no}}"></td>
                                                @endif
                                                <td>{{$bill->id}}</td>
                                                <td>{{$bill->cris_no}}</td>
                                                <td class="customer_name">{{$bill->name}}</td>
                                                <td>{{$bill->pay_to}}</td>
                                                <td class="{{ isset(Matters::LIST_STATUS[$bill->status]) ? Matters::TEXT_STATUS_COLORS[$bill->status] : '' }}">{{ isset(Matters::LIST_STATUS[$bill->status]) ? Matters::LIST_STATUS[$bill->status] : ''}}</td>
                                                <td >
                                                    <a href="{{ route('admin.bill.edit',['id'=>$bill->id]) }}">編集 &emsp;</a>
                                                    @if (($loginUser->auth == User::NORMAL_USER && $bill->status == Matters::STATUS_DRAFT) || $loginUser->auth == User::MANAGER_USER)
                                                        <a href="" data-url="{{ route('admin.bill.delete') }}" data-id="{{ $bill->id }}" class="action_delete">削除</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <center>
                                                <td colspan="7" style="text-align: center;"> データが見つかりません。</td>
                                            </center>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row mb-4" style="box-sizing: border-box; padding: 0;">
                            <div class="row" style="box-sizing: border-box; padding-right: 0;" style="margin-bottom: 0">
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                                {{ $bills->links('vendor.pagination.default') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/js/common.js')  }}"></script>
    <script>
        @if (!$isRememberChecked)
            localStorage.removeItem('LIST_CHECKED')
        @endif
        var listChecked = localStorage.getItem('LIST_CHECKED') ? JSON.parse(localStorage.getItem('LIST_CHECKED')) : [];

        $('#checked-ids').val(JSON.stringify(listChecked))
        var isCheckAll = false
        if ($('.check-item').length > 0) {
            isCheckAll = true
            $('.check-item').each(function() {
                var thisvalue = parseInt($(this).val());
                if($.inArray(thisvalue, listChecked) > -1) {
                    $(this).prop('checked', true)
                } else {
                    isCheckAll = false
                }
            });
        }
        $("#check-all").prop('checked', isCheckAll)

        hanldeRememberChecked = (function(){
            var isCheckAll = true
            $('.check-item').each(function() {
                var thisvalue = parseInt($(this).val());
                if($(this).is(":checked")) {
                    if ($.inArray(thisvalue, listChecked) <= -1) {
                        listChecked.push(parseInt($(this).val()))
                    }
                } else {
                    listChecked = $.grep(listChecked, function(value) {
                        return value != thisvalue;
                    });
                    isCheckAll = false
                }
            });
            // console.log(listChecked);
            $("#check-all").prop('checked', isCheckAll)
            $('#checked-ids').val(JSON.stringify(listChecked))
            localStorage.setItem('LIST_CHECKED', JSON.stringify(listChecked));
        })

        $(document).ready(function (){
            $('#check-all').on('change', function () {
                if($(this).is(':checked')) {
                    $('.check-item').prop('checked', true);
                } else {
                    $('.check-item').prop('checked', false);
                }
                hanldeRememberChecked();
            });

            $('.check-item').click(function(event) {
                hanldeRememberChecked();
            });

            $('#btnExport').on('click', function(e) {
                var form = $(this).parents('form:first');
                form.append('<input type="hidden" name="btnExport" value="btnExport"/>');
                form.submit();
                form.find('[name=btnExport]').remove();
            });

            $('#btnDelAll').on('click', function(e) {
                e.preventDefault();
                var ids = $("input[name=ids]").val();
                var crisNo = [];
                $('.check-item').each(function() {
                    if($(this).is(":checked")) {
                        crisNo.push('<span class="badge text-dark">'+$(this).attr('data-cris_no')+'</span>');
                    }
                });

                console.log(crisNo);
                if (ids.trim() == '' || ids.trim() == '[]') {
                    commonAlert('請求書を選択してください。');
                    return;
                }

                commonConfirm('上記の請求書情報を削除してよろしいですか。', crisNo, (result) => {
                    if (result.isConfirmed && result.value) {
                        $('.loading-overlay').show()
                        localStorage.removeItem('LIST_CHECKED')
                        $.ajax({
                            type: 'Post',
                            url: "{{ route('admin.bill.bulk_delete') }}",
                            data: {
                              id: ids
                            },
                            success: function (data){
                                if (data.code==200){
                                    location.reload();
                                }
                            },
                            error: function (){
                                location.reload();
                            }
                        })
                    }
                });
            });
        });
    </script>
@endsection

