<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
<meta http-equiv="Content-Language" content="ja">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>sample</title>
<style>
.title_px {
  font-size: 16px
}
.main_px {
  font-size: 12px
}
div.left {
    text-align: left; 
}
td.left {
    text-align: left; 
}
div.center {
    text-align: center;
}
div.right {
    text-align: right; 
}
div.red{
    color: red
}
</style>
<meta http-equiv="Content-Style-Type" content="text/css">
</head>
@if($type == 'mail')
    <style>
        body{
            width:1200px;
        }
    </style>
@endif
<body>
<div class="title center title_px">＝＝＝ニチコン蓄電システム　修理費用お支払方法お申込方法について＝＝＝</div>
<div class="left main_px">【再送信】</div>
<div class="left main_px">{{$pref}}  {{$customer_name}} 様</div>
<div class="right main_px">ご請求書No. {{$cris_no}}</div>
<br>
<div class="main_px">
　この度は、ニチコン蓄電システムのアフターサービスをご依頼いただきありがとうございました。<br>
貼付「請求書」のとおりのご請求申し上げましたが、決済代行会社のサイトで手続きが完了しませんでした。<br>
<br>
大変お手数おかけいたしますが、今一度下記ニチコンポータルサイトから<br>
一週間以内にお手続きをいただきますようにお願い申し上げます。<br>
</div>
<br>
<div class="main_px">{!! nl2br(e($info)) !!}</div>
<br>
<div class="main_px">
修理費用のお手続きは<a href="{{$url}}">こちら</a>から<br>
または下のQRコードからアクセスください
<br>
<img src='https://chart.googleapis.com/chart?cht=qr&chs=100x100&chl={{$url}}&choe=UTF-8'>
</div>
<div class="main_px">
お支払いの申込は下記①〜⑤のステップで行います。<br>
お手元に「請求書」をご用意ください。<br>
①請求書Noとメールアドレスを入力<br>
②ご請求内容の確認<br>
③決済手段の選択<br>
④決済手続き（決済代行会社の運営サイトにジャンプします）<br>
⑤決済手続き完了<br>
</div>
<br>
<u><div class="main_px">◆お支払い方法について</div></u>
<div class="main_px">
　・下記「ニチコンアフターサービス費用支払い申込」サイトより一週間以内にお支払い手続きをお願いします。<br>
　・お支払いはクレジットカード、ネットバンキングによる振込、ローン（25万以上、個人に限る）の中から選択をお願いします<br>
　・お支払い（決済）にあたり、弊社は決済代行会社（（株）ペイジェントおよび（株）ジャックス）に業務委託しています<br>
　・個人のお客様で25万を超える場合はローンによるお支払いが可能ですが、審査が通らなかった場合はご利用になれません。<br>
　　また、ローンのお申し込みは、必ず一週間以内にお願いします。一週間を超えた場合申請ができなくなる場合がございます。<br>
　・クレジットカードおよびネットバンキングによるお支払いは、お客様のご利用限度額の範囲でご利用になれます。<br>
　・「ニチコンアフターサービス費用支払い申込」サイトを経由せず、直接振り込む場合は、<br>
　　通信欄または備考欄に請求書No.とお客様名を必ずご記入ください。この場合、振り込み手数料はお客様ご負担にてお願いいたします。<br>
　　　記入例：「2201968　キシダ」<br>
</div>
<div class="right main_px">
ニチコン（株）電源センター<br>
蓄電システムサービス部
</div>
<br>
<div class="left main_px">
&lt;&lt;本件のお問い合わせ先&gt;&gt;<br>
電話：03-3666-7887<br>
受付：9:00~17:00<br>
（除く　土日祝、年末年始、GW等弊社休業日）<br>
メール：repair-ess@nichicon.com<br>
随時受付ですが、回答は弊社営業日になります。
</body>
</html>