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
    loadTaskEntries();

    //Check for approval or decline
    $("#task-entries-field").on("click", ".card .card-button", function (e) {
        ei = e.target.closest(".card").getAttribute("card-id");
        ea = e.target.closest(".card-button").getAttribute("card-action");
        updateTaskEntry(ei, ea);
    });
});

var taskEntriesLoaded = [0];

function updateTaskEntry(ei, ea) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: url() + '/admin/tasks/ajaxtasksconfirm',
        data: {
            entry_id: ei,
            action: ea
        },
        cache: false,
        success: function success() {
            removeFromFeed(ei);
        },
        error: function error(xhr, status, _error) {
            console.log(xhr + "///" + status + "///" + _error);
        }
    });
}

function removeFromFeed(ci) {
    var card = $(".card[card-id='" + ci + "']");
    card.addClass("disappear");
    setTimeout(function () {
        card.remove();
    }, 350);
}

function loadTaskEntries() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: url() + '/admin/tasks/ajaxtasksfeed',
        data: {
            loaded: taskEntriesLoaded
        },
        dataType: 'json',
        cache: false,
        success: function success(response) {
            showNewCards(response);
        },
        error: function error(xhr, status, _error2) {
            console.log(xhr + "///" + status + "///" + _error2);
        }
    });
    setTimeout(function () {
        loadTaskEntries();
    }, 10000);
}

function showNewCards(cards) {
    var cardsField = $("#task-entries-field");
    $.each(cards, function (i, v) {
        if (v.task.type == "image") {
            var image = "background-image: url('" + url() + "/images/taskentries/" + v.answer + "')";
        } else {
            var image = "";
        }
        var html = "\n        <div class=\"card background-cover\" card-id=\"" + v.id + "\" style=\"" + image + "\">\n            <div class=\"card-top\">\n                <div class=\"card-approve card-button\" card-action=\"approve\">\n                    <i class=\"fas fa-check\"></i>\n                </div>\n                <div class=\"card-decline card-button\" card-action=\"decline\">\n                    <i class=\"fas fa-times\"></i>\n                </div>\n            </div>\n            <div class=\"card-bottom\">\n                <div class=\"card-date\">\n                    " + v.date_submit + "\n                </div>\n            </div>\n        </div>";
        cardsField.append(html);
        taskEntriesLoaded.push(v.id);
    });
}

/***/ })

/******/ });