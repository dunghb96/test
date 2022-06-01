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

    <section class="form01 content countReset">
        <div class="contentInner">
        <ol class="formSteps">
            <li class="-stepEnd"><span>お客様情報の入力</span></li>
            <li class="-stepEnd"><span>ご請求内容の確認</span></li>
            <li class="-stepEnd"><span>ご決済手続き</span></li>
            <li class="currentStep"><span>ご決済手続き完了</span></li>
        </ol>
        </div>
    </section>

    <section class="content compBox">
        <div class="contentInner">
        <div class="bgGray">
            <h2>お支払方法のお申込みが<br class="spOnly">完了しました。<br>ありがとうございました。</h2>
            <p class="pc-textCenter">今後ともニチコン蓄電システムをご愛顧くださいますようお願い申し上げます。</p>
        </div>
        <p class="-textCenter"><a href="https://www.nichicon.co.jp/products/ess/" class="btnStyle">ニチコンの家庭用蓄電システム</a></p>
        </div>
    </section>

@endsection
