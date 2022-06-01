@extends('frontend.layout.index')

@section('bread')
    <div class="contentInner">
        <div class="main_breadcrumb">
            <div class="l_breadcrumb">
                <ul class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li class="breadcrumb__item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a href="https://www.nichicon.co.jp/" itemprop="item">
                            <span itemprop="name">トップ</span>
                        </a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li class="breadcrumb__item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
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
                <li class="currentStep"><span>お客様情報の入力</span></li>
                <li><span>ご請求内容の確認</span></li>
                <li><span>ご決済手続き</span></li>
                <li><span>ご決済手続き完了</span></li>
            </ol>
        </div>
    </section>

    <section class="form02 content">
        <div class="contentInner">
            <h2 class="stepTitle">お客様情報の入力</h2>
            <p>ご請求情報の照会を行うため、下記項目に入力し、次にお進みください。</p>
            @if(session('error') && session('error') != null  )
                <!-- エラーメッセージ -->
                <div class="borderBox -caution">
                    <h3 class="cautionText">請求書情報を取得することができませんでした。</h3>
                    <p>請求書情報を取得することができませんでした。<br>恐れ入りますが、下記の点にご注意いただき、再度情報を入力ください。</p>
                    <ul class="-disc">
                        <li>請求書No.の7桁の数字に誤りがないか</li>
                        <li>ご案内メールが届いたメールアドレスを入力しているか</li>
                    </ul>
                </div>
            @endif
            <div class="formWrapper">
                <form class="" action="" method="post">
                    @csrf
                    <table class="table01 -resTable">
                        <tbody>
                            <tr>
                                <th>
                                    <label for="number" class="-required">請求書No</label>
                                </th>
                                <td>
                                    「IS」から始まる請求書Noの数字7桁を入力してください。
                                    <span class="billNo inputBox">
                                        <input type="tel" name="cris_no" size="40" id="number" placeholder="1234567" class="inputText" value="{{ old('billNo') }}" >
                                        <button class="resetBtn" type="button">
                                            <img src="{{ asset('_assets/img/icon_error.svg') }}" width="16px" height="16px" alt="削除ボタン">
                                        </button>
                                        <span class="errorText">必須項目です。入力をお願いします。</span>
                                    </span>
                                    @error('cris_no')
                                        <span style="color:#b70b0b; font-size: 14px; font-size: 1.4rem;">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="mail" class="-required">メールアドレス</label>
                                </th>
                                <td>
                                    ご案内メールが届いたメールアドレスを入力してください。
                                    <span class="inputBox">
                                        <input type="email" name="mail" size="40" value="{{ old('mail') }}" id="mail" placeholder="mail@nichicon.co.jp" class="inputText" required>
                                        <button class="resetBtn" type="button">
                                            <img src="{{ asset('_assets/img/icon_error.svg') }}" width="16px" height="16px" alt="削除ボタン">
                                        </button>
                                        <span class="errorText">不正な文字列です。</span>
                                    </span>
                                    @error('mail')
                                        <span style="color:#b70b0b; font-size: 14px; font-size: 1.4rem;">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="bgGray">
                        <h3><label for="checkPolicy" class="-required">個人情報の取り扱いについて</label></h3>
                        <p>個人情報の取扱について同意が必要です。下記リンクより個人情報保護方針をご確認いただき、「同意する」にチェックを入れ入力内容の確認にお進みください。 </p>
                        <p><a href="#" target="_blank" rel="noopener noreferrer" class="-blank -bold">個人情報保護方針</a></p>
                        <p class="-bold">個人情報の取り扱いの同意</p>
                        <div class="policyScroll">
                            <div class="privacyContent">
                                <div class="c-form__privacyText u-mt16">
                                    <h4 class="c-title c-title--lv3-1">【個人情報の利用目的】</h4>
                                    <h5 class="c-title c-title--lv3-2 u-mt16 u-mb8">(1) お客様・お取引先様に関する情報</h5>
                                    <ul class="c-list">
                                        <li>① お客様へ製品・サービスの案内、販売、設置、提供、保守を行うため</li>
                                        <li>② お客様へ各種アンケートを依頼するため</li>
                                        <li>③ お客様へキャンペーン・展示会等イベントの案内を行うため</li>
                                        <li>④ お客様へ各種資料・サンプルの提供を行うため</li>
                                        <li>⑤ 各種問い合わせ等に対する回答および連絡を行うため</li>
                                        <li>⑥ お取引先への発注および諸連絡のため</li>
                                        <li>⑦ 契約の交渉、締結、義務の履行および契約上のご請求、お支払い等を行うため</li>
                                        <li>⑧ 各種製品・サービス等の企画・開発のため</li>
                                    </ul>
                                    <h5 class="c-title c-title--lv3-2 u-mt16 u-mb8">(2) 各種研究会・各種業界団体に関する情報</h5>
                                    <ul class="c-list">
                                        <li>① お客様へ製品・サービスの案内、販売、設置、提供、保守を行うため</li>
                                        <li>② お客様へ各種アンケートを依頼するため</li>
                                        <li>③ お客様へキャンペーン・展示会等イベントの案内を行うため</li>
                                        <li>④ お客様へ各種資料・サンプルの提供を行うため</li>
                                        <li>⑤ 各種問い合わせ等に対する回答および連絡を行うため</li>
                                        <li>⑥ お取引先への発注および諸連絡のため</li>
                                        <li>⑦ 契約の交渉、締結、義務の履行および契約上のご請求、お支払い等を行うため</li>
                                        <li>⑧ 各種製品・サービス等の企画・開発のため</li>
                                    </ul>
                                    <h5 class="c-title c-title--lv3-2 u-mt16 u-mb8">(3) 株主様に関する情報</h5>
                                    <ul class="c-list">
                                        <li>① 株主様への諸連絡・資料送達のため</li>
                                    </ul>
                                    <h5 class="c-title c-title--lv3-2 u-mt16 u-mb8">(4) 採用応募者に関する情報</h5>
                                    <ul class="c-list">
                                        <li>① 採用選考のため</li>
                                        <li>② 問い合わせ等に対する回答および連絡を行うため</li>
                                    </ul>
                                    <h5 class="c-title c-title--lv3-2 u-mt16 u-mb8">(5) 当社従業員並びに家族または関係者等に関する情報</h5>
                                    <ul class="c-list">
                                        <li>① 当社従業員の人事・労務管理を行うため</li>
                                        <li>② 当社従業員の経理・総務等の必要事務および連絡のため</li>
                                    </ul>
                                    <h5 class="c-title c-title--lv3-2 u-mt16 u-mb8">(6) 退職者に関する情報</h5>
                                    <ul class="c-list">
                                        <li>① 当社従業員の人事・労務管理を行うため</li>
                                        <li>② 当社従業員の経理・総務等の必要事務および連絡のため</li>
                                    </ul>
                                    <h5 class="c-title c-title--lv3-2 u-mt16 u-mb8">(7) その他上記各項目に関連する業務</h5>
                                    <ul class="c-list">
                                        <li>① 当社従業員の人事・労務管理を行うため</li>
                                        <li>② 当社従業員の経理・総務等の必要事務および連絡のため</li>
                                    </ul>
                                    <ul class="c-list c-list--asterisk u-fz14 u-mt16">
                                        <li class="c-listItem">なお、個別に利用目的を開示または通知する場合には、その利用目的によるものとします。</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="checkBox">
                            <input type="checkbox" name="checkPolicy" value="上記の個人情報の取り扱いに同意する" id="checkPolicy">
                            <label for="checkPolicy">上記の個人情報の取り扱いに同意する</label>
                        </div>
                        <div class="recaptchaBox">
                            <div class="g-recaptcha" data-sitekey="6LcIavUdAAAAAGlP4PzG81wova78PZsMs9kzT_CE" data-callback="myCallback"></div>
                            {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> <!-- API の読み込み --> --}}
                        </div>
                    </div>
                    <button class="btnStyle submitBtn" type="submit" name="confirm" value="confirm" disabled="" id="forConfirm">ご請求内容の確認へ進む</button>
                </form>
                <p class="-textCenter"><a href="{{ route('frontend.index') }}" class="backLink">戻る</a></p>
            </div>
        </div>
    </section>
@endsection
