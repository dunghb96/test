<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="apple-touch-icon" href="https://www.nichicon.co.jp/favicon/touch-icon.png">
        <title>@yield('title') | Nichicon</title>


        @include('admin.layout.style')


        @yield('head')
    </head>
    <body class="sb-nav-fixed">
        @include('admin.layout.header')
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 flo " id="sidebarToggle"  href="#!"><i class="fas fa-bars fa-2x"></i></button>

        <div id="layoutSidenav">
            @include('admin.layout.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('content')
                    </div>
                </main>
                @include('admin.layout.footer')
            </div>
        </div>
        <div class="loading-overlay" style="display: none"></div>
        @include('admin.layout.script')
        @yield('script')
    </body>
</html>
