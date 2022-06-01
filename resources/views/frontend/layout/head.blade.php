<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">

    @php
    use App\Helpers\MetaHelpers;
    $meta = (new MetaHelpers)->setMetaTag();
    @endphp
    {!! $meta !!}

    <link rel="preconnect" href="//fonts.googleapis.com">
    <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&amp;family=Roboto:wght@700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cardo:ital@1&amp;family=Open+Sans:wght@400;500;700&amp;display=swap">
    <link rel="shortcut icon" href="https://www.nichicon.co.jp/favicon/favicon.ico">
    <link rel="apple-touch-icon" href="https://www.nichicon.co.jp/favicon/touch-icon.png">
    <link rel="stylesheet" href="{{ asset('_assets/css/style.css') }}">
    @yield('head')
  </head>
