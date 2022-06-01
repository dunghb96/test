//TOPに戻るボタン
$(function () {
  var showFlag = false;
  var topBtn = $("#toTop");
  topBtn.css("bottom", "-100px");
  var showFlag = false;
  //スクロールが100に達したらボタン表示
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 100) {
      if (showFlag == false) {
        showFlag = true;
        topBtn.stop().animate({ bottom: "60px" }, 200);
      }
    } else {
      if (showFlag) {
        showFlag = false;
        topBtn.stop().animate({ bottom: "-100px" }, 200);
      }
    }
  });
  //スクロールしてトップ
  topBtn.on("click", function () {
    $("body,html").animate(
      {
        scrollTop: 0,
      },
      500
    );
    return false;
  });
});

// フェードイン
$(function () {
  $(window).on("scroll", function () {
    $(".scrollIn,.scroll").each(function () {
      var elemPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > elemPos - windowHeight) {
        $(this).addClass("active");
      }
    });
  });
  $(".loadIn").each(function () {
    $(this).addClass("active");
  });
});
