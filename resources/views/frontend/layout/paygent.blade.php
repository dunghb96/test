
<div id="modalBox" class="lity-hide modalBox">
    <form action="{{ $param['url'] }}" method="POST">
        <input type="hidden" name="trading_id" value="{{ $param['trading_id'] }}" />
        <input type="hidden" name="payment_type" value="02,05" />
        <input type="hidden" name="id" value="{{ $param['id'] }}" />
        <input type="hidden" name="seq_merchant_id" value="{{ $param['seq_merchant_id'] }}" />
        <input type="hidden" name="sales_flg" value="1" />
        <input type="hidden" name="payment_class" value="1" />
        <input type="hidden" name="return_url" value="{{ route('frontend.payment.completed') }}" />
        <input type="hidden" name="hc" value="{{ $param['hash'] }}" /> <!-- 改ざん防止用のハッシュ値 -->  
        <p class="pc-textCenter">ここから先はPAYJENT（株式会社ペイジェント）の運営サイトでのお手続きをお願いいたします。</p>
        <p class="-textCenter">
            <button class="btnStyle submitBtn" type="submit" name="外部サイトに移動する" value="" disabled="" id="forSubmit">外部サイトに移動する</button>
        </p>
        <p><button type="button" class="cancelBtn" id="modalClose" data-lity-close>キャンセル</button></p>
    </form>
</div>