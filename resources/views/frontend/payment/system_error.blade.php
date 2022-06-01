@extends('frontend.layout.index')

@section('bread')
    <div class="contentInner">
        <div class="main_breadcrumb">
        <div class="l_breadcrumb">
            <ul class="breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                <a href="https://www.nichicon.co.jp/" itemprop="item">
                <span itemprop="name">トップ</span>
                </a>
                <meta itemprop="position" content="1">
            </li>
            <li class="breadcrumb__item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                <a href="https://www.nichicon.co.jp/products/ess/index.html" itemprop="item">
                <span itemprop="name">ニチコンの家庭用蓄電システム</span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <li class="breadcrumb__item"><a href="{{ route('frontend.index') }}">「ニチコン アフターサービス費用支払い申込み」方法について</a></li>
            </ul>
        </div>
        </div>
    </div>
@endsection

@section('content')

    <section class="content errorBox">
        <div class="contentInner">
        <div class="borderBox -caution">
            <h2 class="errorTitle">エラーが発生しました</h2>
            <p>
            お手続き中にエラーが発生いたしました。<br>
            恐れ入りますが、再度始めからお手続きしていただくようお願いいたします。
            </p>
        </div>
        <p class="-textCenter"><a href="{{ route('frontend.index') }}" class="btnStyle">お申込みトップページに戻る</a></p>
        </div>
    </section>

@endsection
