
@extends('frontend.layout.index')

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
                <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('frontend.index') }}" itemprop="item">
                        <span itemprop="name">「ニチコン アフターサービス費用支払い申込み」方法について</span>
                    </a>
                    <meta itemprop="position" content="4" />
                </li>
                <li class="breadcrumb__item">特定商取引法に基づく表記</li>
            </ul>
        </div>
        </div>
    </div>
@endsection

@section('content')

    <section class="content tokusyo">
        <div class="contentInner">
        <h2>特定商取引法に基づく表記</h2>
        <dl class="tokusyoList">
            <dt>販売業者</dt>
            <dd>ニチコン株式会社</dd>
            <dt>運営責任者</dt>
            <dd>藤本 英樹</dd>
            <dt>所在地</dt>
            <dd>&lt;本店&gt;<br>〒604-0845 京都府京都市中京区烏丸通御池上る二条殿町551番地<br><br>&lt;事業所 電源センター&gt;<br>〒103-0026 東京都中央区日本橋兜町14番9号</dd>
            <dt>お客様問合せ窓口電話番号</dt>
            <dd><a href="tel:0352129211">03-5212-9211</a>（9:00～18:00 年末年始、GWを除く）</dd>
            <dt>お客様問合せ窓口メールアドレス</dt>
            <dd><a href="mailto:repair-ess@nichicon.com">repair-ess@nichicon.com</a></dd>
            <dt>ECサイトURL</dt>
            <dd><a href="https://www.nichicon.co.jp/products/ess/afterservice/public/">https://www.nichicon.co.jp/products/ess/afterservice/public/</a></dd>
            <dt>申込み方法</dt>
            <dd>サイトより申込み</dd>
            <dt>サービスの引き渡し時期</dt>
            <dd>役務実行済み</dd>
            <dt>代金の支払時期および支払方法</dt>
            <dd>支払期日：請求書記載 支払い期日<br>支払方法：<br>・クレジットカード、ネットバンク（各金融機関のインターネットバンキング）<br>※(株)ペイジェントが提供する決済代行サービスPAYGENT経由<br>・ローン（ジャックスローンのみ）<br>※(株)ジャックスが提供する決済代行サービスWeBBy経由</dd>
            <dt>サービス料金以外に必要な費用</dt>
            <dd>商品価格に消費税も含む</dd>
            <dt>キャンセルの取扱条件</dt>
            <dd>商品の特性上（役務提供後の為）キャンセル不可</dd>
            <dt>サービス不良の取扱条件</dt>
            <dd>商品の特性上、返金の概念なし</dd>
        </dl>
        </div>
    </section>
@endsection


