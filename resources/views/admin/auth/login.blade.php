<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ログイン|Nichicon</title>
        <link href="{{ asset('sb-admin/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin/css/admin_custom.css') }}" rel="stylesheet" />
        <script src="{{ asset('admin/js/font-awesome/all.min.js') }}"></script>
        <style>
            .background_login{
                background-color: #FFFFFF;
            }
            .logo_login{
                margin-top: 20px;
            }
            .text-label{
                font-weight: bold;
            }
            .btn_submit{
                width: 80%;
                background-color: #113293;
                border-radius: 0;
            }
            .input_text{
                border-radius: 0;
            }
            .text_header{
                padding: 50px 12px;
                background-color: #ffcc99;
            }
            .text_header h3{
                font-weight: bold;
            }
            .invalid-feedback{
                margin-top: 0;

            }
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content" class="background_login">
                <main>
                    <div class="container">
                        <div class="row">
                            <div class="row logo">
                                <h4 class="nav-logo logo_login" >nichicon</h4>
                            </div>
                            <div class="row text_header">
                                <h3>サービス費用請求管理システム</h3>
                            </div>
                        </div>
                        <div class="row justify-content-center content_center">
                            <div class="col-lg-4">
                                <div class=" rounded-lg mt-5">

                                    <form method="POST" id="login-form">

                                        @csrf
                                        <div class="mb-4" style="box-sizing: border-box">
                                            <label for="exampleInputEmail1" class="form-label text-label">メールアドレス</label>
                                            <input type="email" name="email" class="form-control input_text" id="exampleInputEmail1" value="{{old('email')}}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label text-label">パスワード</label>
                                            <input type="password" name="password" class="form-control input_text" id="exampleInputPassword1" value="{{old('password')}}">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            @if(session('msg')!= null)
                                                <span class="text-danger">{{session('msg')}}</span>
                                            @endif
                                        </div>
                                        <center><button type="submit" class="btn btn-primary btn_submit ">ログイン</button></center>
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div >
                <footer class="py-4  mt-auto" style="background-color: #FFFFFF">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; NICHICON CORPORATION</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('sb-admin/js/scripts.js') }}"></script>
        <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
        <script>
            (function($) {
    console.log(123);
    $('#login-form').validate({
        rules: {
            email: {
                required: true,
                email: true,
                maxlength: 256
            },
            password: {
                required: true,
                minlength: 6
            }

        },
        messages: {
            email: {
                required: 'メールアドレスを入力してください。',
                email: 'メールアドレス形式で指定してください。',
            },
            password: {
                required: 'パスワードを入力してください。',
                minlength: '6文字以上入力してください。'
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            if (element.closest('.show-error').length > 0) {
                element.closest('.show-error').find('#login-form').after(error);
            } else {
                error.insertAfter(element); // default error placement.
            }
        },
    })
})(jQuery)
        </script>
    </body>
</html>
