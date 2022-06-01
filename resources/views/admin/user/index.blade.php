@php
    use App\Models\User;
    $message = Session::get('success') ?? '';
    $loginUser = Auth::guard('admin')->user();
@endphp
@section('title')
    ユーザー管理
@endsection
@extends('admin.layout.index')
@section('content')
    <div class="container-fluid px-0">
        @include('admin.layout.breadcrumb_title', ['breadcrumb_title' => 'ユーザー管理'])
        @include('admin.layout.flash-message')
        <div class="col-md-12 col-sm-12 ">
            <div class="row" style="margin:10px 0;display: flex; justify-content: flex-end;">
                <div class="col-md-6 col-sm-6" style="width: auto; padding: 0" >
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn_new_user" style="border-radius: 0;">新規アカウント作成</a>
                </div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                                {{-- <div id="regite_toast" class="toast align-items-center text-white bg-primary border-0 mb-1" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="d-flex">
                                        @if(session('success') && session('success') != null  )
                                        <div class="toast-body">
                                            {{ $message }}
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                        @endif
                                    </div>
                                </div> --}}
                            <table class="table table-bordered" style="width:100%">
                                <thead style="background: #ffcc99">
                                    <tr>
                                        <th style="border-right: 1px solid white ; ">ID</th>
                                        <th style="border-right: 1px solid white; ">ユーザー名</th>
                                        <th style="border-right: 1px solid white; ">権限</th>
                                        <th class="status_col"></th>
                                    </tr>
                                </thead>
                                <tbody style="border-top:1px solid #E2E2E2">
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ User::AUTH_LIST[$user->auth] }}</td>
                                            <td >
                                                @if ( $loginUser->auth == User::MANAGER_USER || $loginUser->id == $user->id )
                                                    <a style="margin-left: 5px" href="{{route('admin.user.edit' , ['id' => $user->id]) }}">編集</a>
                                                @endif
                                                @if ($loginUser->auth == User::MANAGER_USER && $loginUser->id != $user->id)
                                                &emsp;&ensp;<a href="" data-url="{{ route('admin.user.delete') }}" data-id="{{ $user->id }}" class="action_delete ">削除</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" style="box-sizing: border-box; padding: 0;">
                        <div class="row" style="box-sizing: border-box; padding-right: 0;">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            {{ $users->links('vendor.pagination.default') }}
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
        $("#regite_toast").show();
        $("#regite_toast button").on('click', function() {
            $("#regite_toast").hide();
        });

    </script>
@endsection

