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

/***/ })

/******/ });