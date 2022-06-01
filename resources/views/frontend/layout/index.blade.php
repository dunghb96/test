<!DOCTYPE html>
<html dir="ltr" lang="ja">
    <!-- head -->
    @include('frontend.layout.head')
<body>
    <!-- header -->
    @include('frontend.layout.header')
    <main id="main">
        <!-- MV -->
        @yield('MV')

        <!-- breadcrumb -->
        @yield('bread')

        <!-- content -->
        @yield('content')

    </main>

    <!-- footer -->
    @include('frontend.layout.footer')

    <!-- script -->
    @include('frontend.layout.script')
</body>

</html>
