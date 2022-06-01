
@extends('frontend.layout.index')
@section('MV')
    @include('frontend.layout.MV')
@endsection

@section('bread')
    <div class="contentInner">
        <div class="main_breadcrumb">
            <div class="l_breadcrumb">
                <ul class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="https://www.nichicon.co.jp/" itemprop="item">
                            <span itemprop="name">トップ</span>
                        </a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="https://www.nichicon.co.jp/products/ess/index.html" itemprop="item">
                            <span itemprop="name">ニチコンの家庭用蓄電システム</span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li>
                    <li class="breadcrumb__item"><a href="./">「ニチコン アフターサービス費用支払い申込み」方法について</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section class="content sec01">
        <div class="contentInner countReset">
            <p>ニチコン蓄電システム修理費用、お支払い方法お申込み方法についてのサイトです。<br>お支払いの申込みは下記の流れで行います。お手元にニチコンよりお送りした請求書をご用意ください。</p>
            <h2>お申込みの流れ</h2>
            <ol class="stepList">
                <li>
                    <h3>お客様情報の入力</h3>
                    <img src="{{ asset('_assets/img/icon_img001.svg') }}" alt="お客様情報の入力" width="40"
                        height="40">
                    お手元の請求書のNoとメールアドレスをご入力ください。
                </li>
                <li>
                    <h3>ご請求内容の確認</h3>
                    <img src="{{ asset('_assets/img/icon_img002.svg') }}" alt="ご請求内容の確認" width="40"
                        height="40">
                    ご請求内容に誤りがないか確認をお願いいたします。
                </li>
                <li>
                    <h3>ご決済手続き</h3>
                    <img src="{{ asset('_assets/img/icon_img003.svg') }}" alt="ご決済手続き" width="40"
                        height="40">
                    外部の決済代行サービスサイトにてお手続きをお願いいたします。
                </li>
                <li>
                    <h3>ご決済手続き完了</h3>
                    <img src="{{ asset('_assets/img/icon_img004.svg') }}" alt="ご決済手続き完了" width="38"
                        height="38">
                </li>
            </ol>
        </div>
    </section>

    <section class="cotent sec02">
        <div class="contentInner">
            <h2>決済手段について</h2>
            <p>
                <strong>クレジットカード、銀行振込（ネットバンキング）</strong>の決済手段をお選びいただけます。<br>各決済代行会社の信用審査が通らなかった場合は<strong>現金一括振込</strong>のお支払いとなります。
            </p>
            <div class="bgGray">
                <h3>ローン支払いについて <span class="-textSmall">準備中（2022年10月開始予定）</span></h3>
                <p>
                    アフターサービス費用が税込25万円を超える場合は、ローンによるお支払いができるよう準備中です。
                </p>
                <p class="-textSmall">
                    ※税込25万円未満の場合はローン設定は出来ません<br>
                    ※法人のお客様はローンをご利用になれません。<br>
                    ※(株)ジャックスによる、審査が通らなかった場合は、現金一括振込のみのお支払となります。
                </p>
            </div>
            <p class="-textCenter"><a href="{{ route('frontend.payment.input') }}" class="btnStyle">お申込みを開始する</a></p>
        </div>
    </section>
@endsection


