/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 65);
/******/ })
/************************************************************************/
/******/ ({

/***/ 65:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(66);


/***/ }),

/***/ 66:
/***/ (function(module, exports) {

$("document").ready(function () {
    loadMessages();
    function calloutHeight() {
        setTimeout(function () {
            calloutHeight();
        }, 100);
    }
    calloutHeight();

    $('body').on('click', function (e) {

        if (!$(e.target).parents('.header-message').length) {

            $('.callout').css('display', 'none');
        }
    });
    $('.message-button').on('click', function (e) {

        if ($('.callout').css('display') == "none") {
            openCallout();
        } else {
            $('.callout').css('display', 'none');
        }
    });

    $("#formTaskSubmit #imageInput").change(function (e) {
        console.log(e.target);

        if (e.target.files && e.target.files[0]) {
            console.log('ffs');

            var reader = new FileReader();

            reader.onload = function (e) {
                $("#formTaskSubmit #imageResult").css("background-image", "url('" + e.target.result + "')");
                $("#formTaskSubmit #imageRowSubmit").css("display", "block");
            };

            reader.readAsDataURL(e.target.files[0]);
        } else {
            $("#formTaskSubmit #imageRowSubmit").css("display", "none");
        }
    });

    $('.chevron-up').click(function () {

        var count = $(this).attr('id');
        $('.page-container.previous-levels').css('visibility', 'visible');
        $('.page-container.previous-levels').css('height', 'auto');
        var height = $("#previous-levels").height();
        $('.page-container.previous-levels').css('height', '0');
        $('.page-container.previous-levels').css('position', 'relative  ');
        $('.page-container.previous-levels').css('height', height + count * 7);
        $('.chevron-up').css('display', 'none');
        $('.chevron-down').css('display', 'block');
    });
    $('.chevron-down').click(function () {
        $('.page-container.previous-levels').css('height', '0');
        $('.chevron-down').css('display', 'none');
        $('.chevron-up').css('display', 'block');
    });

    $("#timeline").on("load", function (e) {
        console.log('hi');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: url() + '/timeline/ajaxTimeLine',
            data: {
                offset: tel
            },
            cache: false,
            success: function success(result) {
                var elements = result;
                console.log(elements);
            },
            error: function error(xhr, status, _error) {
                console.log(xhr + "///" + status + "///" + _error);
            }
        });
    });
});

var messagesLoaded = [0];
var messagesOpened = [];

function loadMessages() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: url() + '/messages/ajaxmessagesfeed',
        data: {
            loaded: messagesLoaded
        },
        dataType: 'json',
        cache: false,
        success: function success(response) {
            showNewMessages(response);
        },
        error: function error(xhr, status, _error2) {

            console.log(xhr + "///" + status + "///" + _error2);
        }
    });
    setTimeout(function () {
        loadMessages();
    }, 5000);
}

function swapExclamation(display) {
    var callout = $('.callout');
    var exclamationContainer = $('.exclamation-container');
    if (display) {
        if (callout.css('display') == 'none') {
            exclamationContainer.css('display', 'block');
        }
    } else {
        exclamationContainer.css('display', 'none');
    }
}
function toHtml(type) {
    type = type.split('-')[1];
    var types = {
        'approved': ' <div class="toast--green">\n          <div class="toast__icon"> <svg version="1.1" class="toast__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">\n        <g><g><path d="M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7    C514.5,101.703,514.499,85.494,504.502,75.496z"></path>\n          </g></g>\n            </svg> ',
        'level': ' <div class="toast--blue">\n          <div class="toast__icon"> <svg version="1.1" class="toast__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">\n<g>\n    <g id="info">\n        <g>\n            <path  d="M10,16c1.105,0,2,0.895,2,2v8c0,1.105-0.895,2-2,2H8v4h16v-4h-1.992c-1.102,0-2-0.895-2-2L20,12H8     v4H10z"></path>\n            <circle  cx="16" cy="4" r="4"></circle>\n        </g>\n    </g>\n</g>\n\n    </svg>',
        'date': ' <div class="toast--blue">\n          <div class="toast__icon"> <svg version="1.1" class="toast__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">\n<g>\n    <g id="info">\n        <g>\n            <path  d="M10,16c1.105,0,2,0.895,2,2v8c0,1.105-0.895,2-2,2H8v4h16v-4h-1.992c-1.102,0-2-0.895-2-2L20,12H8     v4H10z"></path>\n            <circle  cx="16" cy="4" r="4"></circle>\n        </g>\n    </g>\n</g>\n\n    </svg>',
        'declined': ' <div class="toast--red">\n          <div class="toast__icon"><svg version="1.1" class="toast__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 301.691 301.691" style="enable-background:new 0 0 301.691 301.691;" xml:space="preserve">\n<g>\n    <polygon points="119.151,0 129.6,218.406 172.06,218.406 182.54,0  "></polygon>\n    <rect x="130.563" y="261.168" width="40.525" height="40.523"></rect>\n</g>\n    </svg> '

    };
    return types[type];
}
function showNewMessages(messages) {
    if (messages != []) {
        var calloutContent = $("#callout-content-field");

        $.each(messages, function (i, v) {
            var opened = "opened-toast";
            if (v.opened == 0) {
                swapExclamation(true);
                opened = "unopened-toast";
            }

            var html = ' \n<div class="toast__container">\n        <div class="' + opened + '" id="' + v.id + '" >\n            ' + toHtml(v.message.type) + ' \n          </div>\n          <div class="toast__content">\n            <p class="toast__title__' + v.message.type.split('-')[1] + '">' + v.message.title + '</p>\n            <p class="toast__message">' + v.message.message + '</p>\n          </div>\n          <div class="toast__close">\n            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.642 15.642" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 15.642 15.642">\n          <path fill-rule="evenodd" d="M8.882,7.821l6.541-6.541c0.293-0.293,0.293-0.768,0-1.061  c-0.293-0.293-0.768-0.293-1.061,0L7.821,6.76L1.28,0.22c-0.293-0.293-0.768-0.293-1.061,0c-0.293,0.293-0.293,0.768,0,1.061  l6.541,6.541L0.22,14.362c-0.293,0.293-0.293,0.768,0,1.061c0.147,0.146,0.338,0.22,0.53,0.22s0.384-0.073,0.53-0.22l6.541-6.541  l6.541,6.541c0.147,0.146,0.338,0.22,0.53,0.22c0.192,0,0.384-0.073,0.53-0.22c0.293-0.293,0.293-0.768,0-1.061L8.882,7.821z"></path>\n        </svg>\n          </div>\n          </div>\n        </div>\n</div>\n\n\n            ';
            calloutContent.prepend(html);
            messagesLoaded.push(v.id);
        });
    }
}

function openCallout() {
    var unopened = $('.unopened-toast');
    $('.callout').css('display', 'block');
    var entries = unopened.map(function () {
        return $(this).attr('id');
    }).get();

    $.each(entries, function (i, v) {

        if (messagesOpened.includes(v)) {
            $('#' + v).attr('class', 'opened-toast');
        }
    });
    messagesOpened = messagesOpened.concat(entries);
    swapExclamation(false);
    updateMessageEntries();
}

function updateMessageEntries() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "post",
        url: url() + '/messages/ajaxmessagesupdate',
        cache: false,
        success: function success() {},
        error: function error(xhr, status, _error3) {
            console.log(xhr + "///" + status + "///" + _error3);
        }
    });
}

/***/ })

/******/ });