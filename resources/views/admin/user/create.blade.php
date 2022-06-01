@php
use App\Models\User;
@endphp
@extends('admin.layout.index')
@section('title')
    ユーザー情報登録
@endsection
@section('content')
    <div class="container-fluid px-0" style="box-sizing: border-box">
        @include('admin.layout.breadcrumb_title', ['breadcrumb_title' => 'ユーザー情報登録'])
        <div class="container-form mt-4">
            <form action="{{route('admin.user.store')}}" enctype="multipart/form-data" autocomplete="off" id="regis-form" method="post">
                @csrf
                <div class="border border-secondary top-form">
                    <div class="" style="margin: 0 20px">

                        <div class="form-group div-input">
                            <label for="name">ユーザー名 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="email">メールアドレス <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" {{ old('email') }}>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="password">パスワード <span class="text-danger">*</span></label>
                            <input type="password" class="form-control " id="password" name="password" style=" max-width: 225px" {{ old('password') }}>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input">
                            <label for="password_confirm">パスワードの確認<span class="text-danger">*</span></label>
                            <input type="password" class="form-control " id="password_confirm" name="password_confirm" style=" max-width: 225px">
                            @error('password_confirm')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group div-input ">
                            <label for="text">権限  <span class="text-danger">*</span></label>
                            <select class="form-select w-auto" name="auth" {{ old('auth') }}>
                                <option value="">権限を選択してください</option>
                                @foreach(User::AUTH_LIST as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            @error('auth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <center>
                    <div class="form-group ">
                        <button class="btn btn-primary user_btn" type="submit"> 登録・更新 </button>&ensp;&ensp;
                        <a class="btn user_edit_cancel" href="{{ route('admin.user.index') }}">キャンセル</a>
                    </div>
                </center>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script >
        (function($) {
            $('#regis-form').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 256
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 256
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirm: {
                        equalTo: '[name="password"]'
                    },
                    auth: {
                        required: true
                    }

                },
                messages: {
                    name: {
                        required: 'ユーザー名を入力してください。',
                        maxlength: '256文字以内で入力してください'
                    },
                    email: {
                        required: 'メールアドレスを入力してください。',
                        email: 'メールアドレス形式で指定してください。'
                    },
                    password: {
                        required: 'パスワードを入力してください。',
                        minlength: '6文字以上入力してください。'
                    },
                    password_confirm: {
                        equalTo: 'パスワードと一致しません'
                    },
                    auth: {
                        required: '権限を選択してください'
                    }
                },
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    if (element.closest('.show-error').length > 0) {
                        element.closest('.show-error').find('#regis-form').after(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
            });
        })(jQuery)
    </script>
@endsection


