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
            <h2 class="errorTitle">ローンのお申込みができませんでした</h2>
            <p>
            審査の結果、ローンでのお支払いができません。<br>
            お申込み画面でクレジットカード決済または銀行振込のお手続きをお願いいたします。
            </p>
            <p>別途ご相談を希望されるお客様は、弊社下記連絡先までご連絡をお願いいたします。</p>
            <p class="contactInfo">
            【連絡先】<br>
            電話：<br>
            メール：<a href="mailto:repair-ess@nichicon.com">repair-ess@nichicon.com</a>
            </p>
        </div>
        <p class="-textCenter"><a href="{{ route('frontend.index') }}" class="btnStyle">お申込みトップページに戻る</a></p>
        </div>
    </section>

@endsection
