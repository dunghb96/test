<div class="x_content bs-example-popovers">
    @if ($message = Session::get('success'))
        <div class="js-auto-close alert alert-success alert-dismissible text-center" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('info'))
        <div class="js-auto-close alert alert-info alert-dismissible text-center" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('warning'))
        <div class="js-auto-close alert alert-warning alert-dismissible text-center" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="js-auto-close alert alert-danger alert-dismissible text-center" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <div class="js-auto-close alert alert-danger alert-dismissible text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>