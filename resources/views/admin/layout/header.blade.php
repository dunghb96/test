
<nav class="sb-topnav navbar navbar-expand bg-white navbar_header">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-5 nav-logo" href="{{ route('admin.home') }}" >nichicon</a>

    <!-- Navbar Search-->
    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></div>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 " >

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle admin-tab" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" ><i class="fas fa-user"></i> {{ Auth::guard('admin')->user()->name ?? ''}}さん</a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('admin.user.edit', ['id'=>Auth::guard('admin')->id()]) }}">アカウント編集</a></li>
                <li><a class="dropdown-item" href="{{route('admin.logout')}}">ログアウト</a></li>
            </ul>
        </li>
    </ul>
</nav>
