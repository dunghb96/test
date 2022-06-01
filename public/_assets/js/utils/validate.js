import v8n from "v8n";

// -----------------------------------------
// 送信ボタンアクティブ化用フラグ
// -----------------------------------------
let check1 = false,
  check2 = false,
  check3 = false;

// -----------------------------------------
// エラーメッセージ
// -----------------------------------------
let error = "必須項目です。入力をお願いします。",
  error2 = "7桁の半角数字を入力してください。",
  error3 = "不正な文字列です。";

// -----------------------------------------
// 送信ボタンアクティブ化関数
// -----------------------------------------
function forConfirm() {
  const confirm = document.getElementById("forConfirm"); //送信ボタン
  if (check1 === true && check2 === true && check3 === true) {
    //全てのフラグが真ならボタンをアクティブに
    confirm.disabled = false;
  } else {
    confirm.disabled = true;
  }
}

// -----------------------------------------
// 必須要素のチェック関数
// -----------------------------------------
function require(elm) {
  let val = $(elm).val();
  //空かnullならtrueを返す
  const require = v8n().not.empty().not.null().test(val);
  if (require !== true) {
    //エラーメッセージの表示
    elm.parent().addClass("-error");
    elm.next().next().text(error);
  }
}

//請求書番号のフォーカスが外れたら必須要素のチェックに回す
$("#number").on("blur", function () {
  require($(this));
});
//メールのフォーカスが外れたら必須要素のチェックに回す
$("#mail").on("blur", function () {
  require($(this));
});

// -----------------------------------------
// 請求書番号のバリデーション
// -----------------------------------------
$("#number").on("keyup", function () {
  let number = $(this).val();
  //半角数字7文字ならtrueを返す
  const numberValid = v8n()
    .minLength(7) // 最小7文字
    .maxLength(7) // 最大7文字
    .pattern(/^\d+$/) //半角数字のみ
    .test(number);
  if (numberValid !== true) {
    //エラーメッセージの表示
    $(this).parent().addClass("-error");
    $(this).next().next().text(error2);
    //チェックフラグ偽
    check1 = false;
    forConfirm();
  } else {
    $(this).parent().removeClass("-error");
    //チェックフラグ真
    check1 = true;
    forConfirm();
  }
});

// -----------------------------------------
// メールのバリデーション
// -----------------------------------------
$("#mail").on("keyup", function () {
  let email = $(this).val();
  //メールアドレスのパターンに合致したらtrueを返す
  const mailValid = v8n()
    .pattern(/[^\s@]+@[^\s@]+\.[^\s@]+/) // eメール用の正規表現
    .test(email);
  if (mailValid !== true) {
    //エラーメッセージの表示
    $(this).parent().addClass("-error");
    $(this).next().next().text(error3);
    //チェックフラグ偽
    check2 = false;
    forConfirm();
  } else {
    $(this).parent().removeClass("-error");
    //チェックフラグ真
    check2 = true;
    forConfirm();
  }
});

// -----------------------------------------
// プライバシーチェック
// -----------------------------------------
$("#checkPolicy").on("change", function () {
  let number = document.getElementById("number");
  let mail = document.getElementById("mail");
  //請求書番号が空ならエラーメッセージ表示
  if (number.value === "") {
    $("#number").parent().addClass("-error");
    $("#number").next().next().text(error);
  }
  //メールが空ならエラーメッセージ表示
  if (mail.value === "") {
    $("#mail").parent().addClass("-error");
    $("#mail").next().next().text(error);
  }
  if ($(this).prop("checked")) {
    //チェックしたらフラグを真に
    check3 = true;
    forConfirm();
  } else {
    check3 = false;
    forConfirm();
  }
});

// -----------------------------------------
// テキストボックスの入力で削除ボタン表示
// -----------------------------------------
$(".inputText").on("keyup", function () {
  $(this).next().addClass("-visible");
});

// -----------------------------------------
// テキストボックスの内容クリア関数
// -----------------------------------------
function clearText(elm) {
  let textForm = document.getElementById(elm);
  textForm.value = "";
}

// -----------------------------------------
// 削除ボタンでテキストボックスの内容クリア、削除ボタン非表示
// -----------------------------------------
$(".resetBtn").on("click", function () {
  let elm = $(this).prev().attr("id");
  $(this).removeClass("-visible");
  clearText(elm);
  $(this).parent().addClass("-error");
  $(this).next().text(error);
  if (elm === "number") {
    check1 = false;
  } else {
    check2 = false;
  }
  forConfirm();
});

// -----------------------------------------
// 請求書確認ボタン（確認画面）チェックでボタンアクティブ化
// -----------------------------------------
$("#checkConfirm").on("change", function () {
  let submit = document.getElementById("forSubmit");
  let submit2 = document.getElementById("forSubmit2");
  let modal = document.getElementById("forModal");
  let modal2 = document.getElementById("forModal2");
  let modal3 = document.getElementById("forModal3");
  if ($(this).prop("checked")) {
    submit.disabled = false;
    submit2.disabled = false;
    modal.disabled = false;
    modal2.disabled = false;
    modal3.disabled = false;
  } else {
    submit.disabled = true;
    submit2.disabled = true;
    modal.disabled = true;
    modal2.disabled = true;
    modal3.disabled = true;
  }
});
