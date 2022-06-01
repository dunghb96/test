/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	function webpackJsonpCallback(data) {
/******/ 		var chunkIds = data[0];
/******/ 		var moreModules = data[1];
/******/ 		var executeModules = data[2];
/******/
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(Object.prototype.hasOwnProperty.call(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(data);
/******/
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 		// add entry modules from loaded chunk to deferred list
/******/ 		deferredModules.push.apply(deferredModules, executeModules || []);
/******/
/******/ 		// run deferred modules when all chunks ready
/******/ 		return checkDeferredModules();
/******/ 	};
/******/ 	function checkDeferredModules() {
/******/ 		var result;
/******/ 		for(var i = 0; i < deferredModules.length; i++) {
/******/ 			var deferredModule = deferredModules[i];
/******/ 			var fulfilled = true;
/******/ 			for(var j = 1; j < deferredModule.length; j++) {
/******/ 				var depId = deferredModule[j];
/******/ 				if(installedChunks[depId] !== 0) fulfilled = false;
/******/ 			}
/******/ 			if(fulfilled) {
/******/ 				deferredModules.splice(i--, 1);
/******/ 				result = __webpack_require__(__webpack_require__.s = deferredModule[0]);
/******/ 			}
/******/ 		}
/******/
/******/ 		return result;
/******/ 	}
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// object to store loaded and loading chunks
/******/ 	// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 	// Promise = chunk loading, 0 = chunk loaded
/******/ 	var installedChunks = {
/******/ 		"app": 0
/******/ 	};
/******/
/******/ 	var deferredModules = [];
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	var jsonpArray = window["webpackJsonp"] = window["webpackJsonp"] || [];
/******/ 	var oldJsonpFunction = jsonpArray.push.bind(jsonpArray);
/******/ 	jsonpArray.push = webpackJsonpCallback;
/******/ 	jsonpArray = jsonpArray.slice();
/******/ 	for(var i = 0; i < jsonpArray.length; i++) webpackJsonpCallback(jsonpArray[i]);
/******/ 	var parentJsonpFunction = oldJsonpFunction;
/******/
/******/
/******/ 	// add entry module to deferred list
/******/ 	deferredModules.push(["./src/products/ess/afterservice/_assets/js/index.js","commons~app"]);
/******/ 	// run deferred modules when ready
/******/ 	return checkDeferredModules();
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/products/ess/afterservice/_assets/js/index.js":
/*!***********************************************************!*\
  !*** ./src/products/ess/afterservice/_assets/js/index.js ***!
  \***********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lity */ "./node_modules/lity/dist/lity.js");
/* harmony import */ var lity__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lity__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _utils_Burger__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./utils/Burger */ "./src/products/ess/afterservice/_assets/js/utils/Burger.js");
/* harmony import */ var _utils_validate__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./utils/validate */ "./src/products/ess/afterservice/_assets/js/utils/validate.js");
/* harmony import */ var _utils_style__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./utils/style */ "./src/products/ess/afterservice/_assets/js/utils/style.js");
/* harmony import */ var _utils_style__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_utils_style__WEBPACK_IMPORTED_MODULE_3__);
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// import 'matchHeight';
 // import 'drawsvg';
// import particles from "particles.js";
// import remodal from "remodal";
// import "slick-carousel";



 // import lit from "./utils/lit";

var Main = /*#__PURE__*/_createClass(function Main() {
  _classCallCheck(this, Main);

  new _utils_Burger__WEBPACK_IMPORTED_MODULE_1__["default"]();
});

window.addEventListener("DOMContentLoaded", function () {
  new Main();
});

/***/ }),

/***/ "./src/products/ess/afterservice/_assets/js/utils/Burger.js":
/*!******************************************************************!*\
  !*** ./src/products/ess/afterservice/_assets/js/utils/Burger.js ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function($) {/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Burger; });
/* harmony import */ var body_scroll_lock__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! body-scroll-lock */ "./node_modules/body-scroll-lock/lib/bodyScrollLock.esm.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }



var Burger = /*#__PURE__*/function () {
  function Burger() {
    _classCallCheck(this, Burger);

    this.toggle = $(".js-burger-toggle");
    this.overlay = $(".burger-overlay");
    this.popup = document.querySelector(".header-buttons");
    this.isOpen = 0;
    this.init();
  }

  _createClass(Burger, [{
    key: "init",
    value: function init() {
      var _this = this;

      this.toggle.on("click", function () {
        _this.isOpen === 0 ? _this.open() : _this.close();
      });
    }
  }, {
    key: "open",
    value: function open() {
      this.isOpen = 1;
      $(this.popup).addClass("is-active");
      this.overlay.stop().fadeIn(100);
      Object(body_scroll_lock__WEBPACK_IMPORTED_MODULE_0__["disableBodyScroll"])(this.popup);
    }
  }, {
    key: "close",
    value: function close() {
      this.isOpen = 0;
      $(this.popup).removeClass("is-active");
      this.overlay.stop().fadeOut(100);
      Object(body_scroll_lock__WEBPACK_IMPORTED_MODULE_0__["clearAllBodyScrollLocks"])();
    }
  }]);

  return Burger;
}();


/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./src/products/ess/afterservice/_assets/js/utils/style.js":
/*!*****************************************************************!*\
  !*** ./src/products/ess/afterservice/_assets/js/utils/style.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {//TOPに戻るボタン
$(function () {
  var showFlag = false;
  var topBtn = $("#toTop");
  topBtn.css("bottom", "-100px");
  var showFlag = false; //スクロールが100に達したらボタン表示

  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 100) {
      if (showFlag == false) {
        showFlag = true;
        topBtn.stop().animate({
          bottom: "60px"
        }, 200);
      }
    } else {
      if (showFlag) {
        showFlag = false;
        topBtn.stop().animate({
          bottom: "-100px"
        }, 200);
      }
    }
  }); //スクロールしてトップ

  topBtn.on("click", function () {
    $("body,html").animate({
      scrollTop: 0
    }, 500);
    return false;
  });
}); // フェードイン

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
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./src/products/ess/afterservice/_assets/js/utils/validate.js":
/*!********************************************************************!*\
  !*** ./src/products/ess/afterservice/_assets/js/utils/validate.js ***!
  \********************************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var v8n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! v8n */ "./node_modules/v8n/dist/v8n.esm.js");
 // -----------------------------------------
// 送信ボタンアクティブ化用フラグ
// -----------------------------------------

var check1 = false,
    check2 = false,
    check3 = false; // -----------------------------------------
// エラーメッセージ
// -----------------------------------------

var error = "必須項目です。入力をお願いします。",
    error2 = "7桁の半角数字を入力してください。",
    error3 = "不正な文字列です。"; // -----------------------------------------
// 送信ボタンアクティブ化関数
// -----------------------------------------

function forConfirm() {
  var confirm = document.getElementById("forConfirm"); //送信ボタン

  if (check1 === true && check2 === true && check3 === true) {
    //全てのフラグが真ならボタンをアクティブに
    confirm.disabled = false;
  } else {
    confirm.disabled = true;
  }
} // -----------------------------------------
// 必須要素のチェック関数
// -----------------------------------------


function require(elm) {
  var val = $(elm).val(); //空かnullならtrueを返す

  var require = Object(v8n__WEBPACK_IMPORTED_MODULE_0__["default"])().not.empty().not.null().test(val);

  if (require !== true) {
    //エラーメッセージの表示
    elm.parent().addClass("-error");
    elm.next().next().text(error);
  }
} //請求書番号のフォーカスが外れたら必須要素のチェックに回す


$("#number").on("blur", function () {
  require($(this));
}); //メールのフォーカスが外れたら必須要素のチェックに回す

$("#mail").on("blur", function () {
  require($(this));
}); // -----------------------------------------
// 請求書番号のバリデーション
// -----------------------------------------

$("#number").on("keyup", function () {
  var number = $(this).val(); //半角数字7文字ならtrueを返す

  var numberValid = Object(v8n__WEBPACK_IMPORTED_MODULE_0__["default"])().minLength(7) // 最小7文字
  .maxLength(7) // 最大7文字
  .pattern(/^\d+$/) //半角数字のみ
  .test(number);

  if (numberValid !== true) {
    //エラーメッセージの表示
    $(this).parent().addClass("-error");
    $(this).next().next().text(error2); //チェックフラグ偽

    check1 = false;
    forConfirm();
  } else {
    $(this).parent().removeClass("-error"); //チェックフラグ真

    check1 = true;
    forConfirm();
  }
}); // -----------------------------------------
// メールのバリデーション
// -----------------------------------------

$("#mail").on("keyup", function () {
  var email = $(this).val(); //メールアドレスのパターンに合致したらtrueを返す

  var mailValid = Object(v8n__WEBPACK_IMPORTED_MODULE_0__["default"])().pattern(/[^\s@]+@[^\s@]+\.[^\s@]+/) // eメール用の正規表現
  .test(email);

  if (mailValid !== true) {
    //エラーメッセージの表示
    $(this).parent().addClass("-error");
    $(this).next().next().text(error3); //チェックフラグ偽

    check2 = false;
    forConfirm();
  } else {
    $(this).parent().removeClass("-error"); //チェックフラグ真

    check2 = true;
    forConfirm();
  }
}); // -----------------------------------------
// プライバシーチェック
// -----------------------------------------

$("#checkPolicy").on("change", function () {
  var number = document.getElementById("number");
  var mail = document.getElementById("mail"); //請求書番号が空ならエラーメッセージ表示

  if (number.value === "") {
    $("#number").parent().addClass("-error");
    $("#number").next().next().text(error);
  } //メールが空ならエラーメッセージ表示


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
}); // -----------------------------------------
// テキストボックスの入力で削除ボタン表示
// -----------------------------------------

$(".inputText").on("keyup", function () {
  $(this).next().addClass("-visible");
}); // -----------------------------------------
// テキストボックスの内容クリア関数
// -----------------------------------------

function clearText(elm) {
  var textForm = document.getElementById(elm);
  textForm.value = "";
} // -----------------------------------------
// 削除ボタンでテキストボックスの内容クリア、削除ボタン非表示
// -----------------------------------------


$(".resetBtn").on("click", function () {
  var elm = $(this).prev().attr("id");
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
}); // -----------------------------------------
// 請求書確認ボタン（確認画面）チェックでボタンアクティブ化
// -----------------------------------------

$("#checkConfirm").on("change", function () {
  var submit = document.getElementById("forSubmit");
  var submit2 = document.getElementById("forSubmit2");
  var modal = document.getElementById("forModal");
  var modal2 = document.getElementById("forModal2");
  var modal3 = document.getElementById("forModal3");

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
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ })

/******/ });
//# sourceMappingURL=../sourcemaps/app.js.map