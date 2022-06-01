
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
                <li class="currentStep"><span>ご請求内容の確認</span></li>
                <li><span>ご決済手続き</span></li>
                <li><span>ご決済手続き完了</span></li>
            </ol>
        </div>
    </section>

    <section class="form02 content">
        <div class="contentInner">
            <h2 class="stepTitle">ご請求内容の確認</h2>
            <p aria-hidden="true">ご請求内容に誤りがないかご確認をお願いいたします。</p>
            <div class="formWrapper">
                <table class="table01 -resTable">
                    <tbody>
                    <tr>
                        <th>
                            請求書No
                        </th>
                        <td>
                            <span id="numberData">IS2101968</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ご請求金額（税込）
                        </th>
                        <td>
                            <span id="priceData">¥63,756</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            請求書
                        </th>
                        <td>
                            <div class="frameWrapper">
                                <!-- file=〜&zoom=page-fitの間にpdfのURLを記述 -->
                                <iframe width="400" height="300" src="{{asset('_assets/pdf/web/viewer.html?file='). asset('_assets/pdf/dummy.pdf&zoom=page-fit')}}"></iframe>
                            </div>
                            <span id="dateData">発行日 2021年8月14日</span>
                            <a href="{{asset('_assets/pdf/dummy.pdf')}}" target="_blank" rel="noopener noreferrer" class="pdfLink -blank">正しく表示されない場合はこちら</a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="borderBox">
                    <p class="cautionText">お手持ちの請求書と内容が異なる場合には、恐れ入りますが請求書に記載されている担当者宛にご連絡ください。</p>
                    <div class="bgGray">
                        <h3><label for="checkConfirm" class="-required">ご請求内容の確認について</label></h3>
                        <div class="checkBox">
                            <input type="checkbox" name="請求内容を確認しました" value="" id="checkConfirm"><label for="checkConfirm">請求内容を確認しました</label>
                        </div>
                    </div>
                </div>
                <!-- //.-active外すとdisplay:noneします -->
                <div class="sec03 -active" id="submit1">
                    <div class="bunnerContainer">
                        <div class="bunnerBox">
                            <h2>クレジットカード、銀行振込で申込む</h2>
                            <button class="btnStyle submitBtn" type="button" name="modal" value="confirm" disabled="" id="forModal"><a href="#modalBox" data-lity="data-lity">クレジットカード、銀行振込を<br>ご希望の方はこちら</a></button>
                        </div>
                        <div class="bunnerBox">
                            <h2>ローン支払いで申込む</h2>
                            <!-- //.-disable外すと準備中を外します -->
                            <button class="btnStyle submitBtn -disable" type="button" name="modal" value="confirm" disabled="" id="forModal2"><a href="#modalBox2" data-lity="data-lity">ローン支払いを<br>ご希望の方はこちら</a></button>
                        </div>
                    </div>
                </div>

                <!-- //.-active外すとdisplay:noneします -->
                <div class="" id="submit2">
                    <div class="borderBox -gray">
                        <h3 class="-bold">決済手段について</h3>
                        <p>クレジットカード、銀行振込（ネットバンキング）の決済手段をお選びいただけます。<br>ローンでのお支払いは、ご請求金額が税込25万円以上の場合のみご利用可能です。</p>
                    </div>
                    <button class="btnStyle submitBtn" type="button" name="modal" value="confirm" disabled="" id="forModal3"><a href="#modalBox" data-lity="data-lity">クレジットカード、銀行振込での<br>決済手続きに進む</a></button>
                </div>

                <div id="modalBox" class="lity-hide modalBox">
                    <form action="" method="POST">
                        @csrf
                        <p class="pc-textCenter">ここから先はPAYJENT（株式会社ペイジェント）の運営サイトでのお手続きをお願いいたします。</p>
                        <p class="-textCenter">
                            <button class="btnStyle submitBtn" type="submit" name="外部サイトに移動する" value="" disabled="" id="forSubmit">外部サイトに移動する</button>
                        </p>
                        <p><button type="button" class="cancelBtn" id="modalClose" data-lity-close>キャンセル</button></p>
                    </form>
                </div>
                <div id="modalBox2" class="lity-hide modalBox">
                    <form action="" method="POST">
                        @csrf
                        <p class="pc-textCenter">ここから先（ローンのお申込み）は株式会社ジャックス WeBByクレジットのお申込みサイトでお手続きをお願いいたします。</p>
                        <p class="-textCenter">
                            <button class="btnStyle submitBtn" type="submit" name="外部サイトに移動する" value="" disabled="" id="forSubmit2">外部サイトに移動する</button>
                        </p>
                        <p><button type="button" class="cancelBtn" id="modalClose2" data-lity-close>キャンセル</button></p>
                    </form>
                </div>
                <p class="-textCenter"><a href="{{route('frontend.payment.input')}}" class="backLink">戻る</a></p>
            </div>
        </div>
    </section>
@endsection


