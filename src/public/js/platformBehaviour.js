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
/******/ 	return __webpack_require__(__webpack_require__.s = 69);
/******/ })
/************************************************************************/
/******/ ({

/***/ 69:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(70);


/***/ }),

/***/ 70:
/***/ (function(module, exports) {

$("document").ready(function () {
    loadTaskEntries();

    //Check for approval or decline
    $("#task-entries-field").on("click", ".card .card-button", function (e) {
        ei = e.target.closest(".card").getAttribute("card-id");
        ui = e.target.closest(".card").getAttribute("user-id");
        ea = e.target.closest(".card-button").getAttribute("card-action");
        mt = "";
        mm = "";
        if (ea == "decline") {
            parent = $(e.target.closest('.card.background-cover'));
            calloutId = parent.find('.callout').attr('id');
            callout = $('#' + calloutId);
            if (callout.css('display') == "block") {
                mt = $('#title' + ei).val();
                mm = $('#message' + ei).val();
                updateTaskEntry(ei, ea, ui, mt, mm);
            } else {
                callout.css('display', 'block');
            }
        } else {
            updateTaskEntry(ei, ea, ui, mt, mm);
        }
    });
});

var taskEntriesLoaded = [0];

function updateTaskEntry(ei, ea, ui, mt, mm) {
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
            action: ea,
            user_id: ui,
            message_title: mt,
            message_message: mm
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
        var html = "\n        <div class=\"card background-cover\" title=\"" + v.task.title + "\" user-id=\"" + v.user_id + "\"  card-id=\"" + v.id + "\" style=\"" + image + "\">\n            <div class=\"card-top\">\n                <div class=\"card-approve card-button\" card-action=\"approve\">\n                    <i class=\"fas fa-check\"></i>\n                </div>\n                <div class=\"card-decline card-button\" card-action=\"decline\">\n                    <i class=\"fas fa-times\"></i>\n                </div>\n            </div>\n            <div class=\"card-bottom\">\n                <div class=\"card-date\">\n                    " + v.date_submit + "\n                </div>\n                <div class=\"card-user\">\n                    " + v.user.name + "\n                </div>\n            </div>\n            <div class=\"callout\" id=\"" + v.id + "\" >\n                <div class=\"callout-content\" id=\"callout-content-field\">\n                    <div class=\"callout-title\">\n                        Enter why you want to declined this task\n                    </div>\n                    <div class=\"form\">\n                        <div class=\"title\">\n                            <div class=\"input-label\">\n                            <lavel>title</label>\n                            </div>\n                            <div class=\"input\">\n                               <input type=\"text\" id=\"title" + v.id + "\" >\n                            </div>\n                        \n                        </div>\n                        <div class=\"message\">\n                            <div class=\"input-label\">\n                            <lavel>message</label>\n                            </div>\n                            <div class=\"input\">\n                               <textarea type=\"text\" id=\"message" + v.id + "\" ></textarea>\n                            </div>\n                        \n                        </div>\n                    </div>\n                </div>                   \n            </div>\n        </div>\n         ";
        cardsField.append(html);
        taskEntriesLoaded.push(v.id);
    });
}

function convertToSlug(Text) {
    return Text.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
}

//FORM INPUTS
$("document").ready(function () {
    // IMAGE
    $(".form .image input").change(function (e) {
        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(".form .image .preview").css("background-image", "url('" + e.target.result + "')");
                $(".form .image .preview").css("display", "block");
            };
            reader.readAsDataURL(e.target.files[0]);
        } else {
            $(".form .image .preview").css("display", "none");
        }
    });
    // PASSWORD
    $(".form .password .password-toggle").on('click', function (e) {
        var input = $(e.target.closest(".input")).children("input");
        var button = $(e.target.closest(".password-toggle"));
        var icon = $(e.target.closest(".password-toggle")).children("i");
        if (!button.hasClass("toggled")) {
            button.addClass("toggled");
            input.attr("type", "text");
            icon.removeClass("fa-eye");
            icon.addClass("fa-eye-slash");
        } else {
            button.removeClass("toggled");
            input.attr("type", "password");
            icon.removeClass("fa-eye-slash");
            icon.addClass("fa-eye");
        }
    });

    // TASK RELATIONS
    $(".form.task-add .relation .relation-add .add-button").on('click', function (e) {
        var input = $(e.target.closest(".form-input")).children(".input-requirements");
        var field = $(e.target.closest(".form-input")).children(".relations");
        var questionsList = "";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: url() + '/admin/tasks/ajaxquestionsidlist',
            dataType: 'json',
            cache: false,
            success: function success(response) {
                questionsList += "<select class=\"relation-question-id\"><option></option>";
                $(response).each(function (i, v) {
                    questionsList += "\n                    <option value=\"" + v.id + "\">" + v.question + "</option>\n                    ";
                });
                questionsList += "</select>";
                var html = "\n                <li class=\"relation\">\n                    <div class=\"relation-row\">\n                        <div class=\"relation-left\">\n                            <div class=\"relation-label\">\n                                <label>QUESTION</label><span class=\"relation-remove\"><i class=\"fas fa-times\"></i></span>\n                            </div>\n                            <div class=\"relation-input\">\n                                " + questionsList + "\n                            </div>\n                        </div>\n                    </div>\n                </li>\n                ";
                field.append(html);
            },
            error: function error(xhr, status, _error3) {
                alert("something went wrong");
                return;
            },
            fail: function fail() {
                alert("something went wrong");
                return;
            }
        });
    });
    $(".form.task-add .relations").on('change', ' .relation-input select', function (e) {
        var id = $(e.target).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: url() + '/admin/tasks/ajaxquestionanswerinput',
            data: {
                question_id: id
            },
            dataType: 'json',
            cache: false,
            success: function success(response) {
                //response = anything inside input
                var answer = response;
                var relation = $(e.target.closest(".relation")).children(".relation-row");
                var html = "\n                <div class=\"relation-right\">\n                    <div class=\"answer-label\">\n                        <label>ANSWER</label>\n                    </div>\n                    <div class=\"answer-input\">\n                        " + answer + "\n                    </div>\n                </div>\n                ";
                $(relation).find(".relation-right").remove();
                relation.append(html);
                compileRelations(e);
            },
            error: function error(xhr, status, _error4) {
                alert(xhr + status + _error4);
                return;
            },
            fail: function fail() {
                alert("something went wrong");
                return;
            }
        });
    });
    $(".form.task-add .relations").on('click', ' .relation-label .relation-remove', function (e) {
        $(e.target.closest("li")).remove();
        compileRelations(e);
    });
    $(".form.task-add .relations").on('change', '.relation-question-answer', function (e) {
        compileRelations(e);
    });
    function compileRelations(e) {
        var relations = $(e.target.closest(".relations")).children("li");
        var inputV = "";
        relations.each(function (i, v) {
            var rq = $(v).find(".relation-question-id").val();
            var ra = $(v).find(".relation-question-answer").val();
            inputV += rq + ":" + ra + ",";
        });
        inputV = inputV.slice(0, -1);
        inputH = $(e.target.closest(".form-input")).find(".input-requirements");
        inputH.val(inputV);
    }

    // TASK RELATIONS
    $(".form.question-add .relation .relation-add .add-button").on('click', function (e) {
        var input = $(e.target.closest(".form-input")).children(".input-requirements");
        var field = $(e.target.closest(".form-input")).children(".relations");
        var questionsList = "";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: url() + '/admin/questions/ajaxquestionsidlist',
            dataType: 'json',
            cache: false,
            success: function success(response) {
                questionsList += "<select class=\"relation-question-id\"><option></option>";
                $(response).each(function (i, v) {
                    questionsList += "\n                    <option value=\"" + v.id + "\">" + v.question + "</option>\n                    ";
                });
                questionsList += "</select>";
                var html = "\n                <li class=\"relation\">\n                    <div class=\"relation-row\">\n                        <div class=\"relation-left\">\n                            <div class=\"relation-label\">\n                                <label>QUESTION</label><span class=\"relation-remove\"><i class=\"fas fa-times\"></i></span>\n                            </div>\n                            <div class=\"relation-input\">\n                                " + questionsList + "\n                            </div>\n                        </div>\n                    </div>\n                </li>\n                ";
                field.append(html);
            },
            error: function error(xhr, status, _error5) {
                alert("something went wronggg");
                return;
            },
            fail: function fail() {
                alert("something went wrongg");
                return;
            }
        });
    });
    $(".form.question-add .relations").on('change', ' .relation-input select', function (e) {
        var id = $(e.target).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: url() + '/admin/questions/ajaxquestionanswerinput',
            data: {
                question_id: id
            },
            dataType: 'json',
            cache: false,
            success: function success(response) {
                //response = anything inside input
                var answer = response;
                var relation = $(e.target.closest(".relation")).children(".relation-row");
                var html = "\n                <div class=\"relation-right\">\n                    <div class=\"answer-label\">\n                        <label>ANSWER</label>\n                    </div>\n                    <div class=\"answer-input\">\n                        " + answer + "\n                    </div>\n                </div>\n                ";
                $(relation).find(".relation-right").remove();
                relation.append(html);
                compileRelations(e);
            },
            error: function error(xhr, status, _error6) {
                alert(xhr + status + _error6);
                return;
            },
            fail: function fail() {
                alert("something went wrong");
                return;
            }
        });
    });
    $(".form.question-add .relations").on('click', ' .relation-label .relation-remove', function (e) {
        $(e.target.closest("li")).remove();
        compileRelations(e);
    });
    $(".form.question-add .relations").on('change', '.relation-question-answer', function (e) {
        compileRelations(e);
    });
    function compileRelations(e) {
        var relations = $(e.target.closest(".relations")).children("li");
        var inputV = "";
        relations.each(function (i, v) {
            var rq = $(v).find(".relation-question-id").val();
            var ra = $(v).find(".relation-question-answer").val();
            inputV += rq + ":" + ra + ",";
        });
        inputV = inputV.slice(0, -1);
        inputH = $(e.target.closest(".form-input")).find(".input-requirements");
        inputH.val(inputV);
    }

    // Answer Types
    $("document").on("load", function (e) {
        compileAnswers(e);
    });
    $(".form.question-add .question-answer-type").on("change", ".answer-type", function (e) {
        setDisplayedAnswerType(e);
        compileAnswers(e);
    });
    $(".form.question-add .answers .select").on("keyup", ".answer-compile", function (e) {
        compileAnswers(e);
    });
    $(".form.question-add .answers .select").on("click", ".add-button", function (e) {
        addAnswerField(e);
        compileAnswers(e);
    });
    $(".form.question-add .answers .select").on("click", ".remove-button", function (e) {
        removeAnswerField(e);
        compileAnswers(e);
    });

    function setDisplayedAnswerType(e) {
        var types_DOM = $(".form.question-add .answers .type-answer");
        types_DOM.each(function (i, v) {
            $(v).removeClass("active");
        });
        var type_active_DOM = $(".form.question-add .answers .type-answer." + e.target.value);
        type_active_DOM.addClass("active");
    }
    function addAnswerField(e) {
        var html = "\n            <li class=\"answer-field\">\n                <input type=\"text\" class=\"answer-compile\"><span class=\"remove-button\"><i class=\"fas fa-times\"></i></span>\n            </li>\n        ";
        var al = $(".form.question-add .answers .select .answers-list");
        al.append(html);
    }
    function removeAnswerField(e) {
        e.target.closest(".answer-field").remove();
    }
    function compileAnswers(e) {
        var at = $(".form.question-add .question-answer-type .answer-type")[0].value;
        var af = $(".form.question-add .answers .type-answer." + at);
        var ac = af.find(".answer-compile");
        var ai = $(".form.question-add .answers .answers-input");
        var as = "";
        ac.each(function (i, v) {
            as += v.value + ":" + convertToSlug(v.value) + ",";
        });
        as = as.slice(0, -1);
        ai[0].value = as;
    }
    $(".form.message-add .message-type").on('change', '.input', function (e) {
        var value = $(e.target).val();
        var html = '';
        if (value == 'level') {
            var formrow = $('#form-row-level');
            html = "\n                    <div class=\"form-row\">\n                        <div class=\"form-input num message-level\" >\n                            <div class=\"input-label\">\n                                <label>Level</label>\n                            </div>\n\n                            <div class=\"input\">\n                                <input type=\"number\" name=\"message_data\" min=\"0\" max=\"{{$level_max}}\">\n                            </div>\n                        </div>\n                    </div>\n            ";

            $('#form-row-date').empty();
        } else {
            var formrow = $('#form-row-date');
            html = "\n             <div class=\"form-row\">\n                        <div class=\"form-input text message-date\">\n                            <div class=\"input-label\">\n                                <label>Date</label>\n                            </div>\n                            <div class=\"input\">\n                                <input type=\"date\" name=\"message_data\" >\n                            </div>\n                        </div>\n                    </div>\n            ";
            $('#form-row-level').empty();
        }
        formrow.html(html);
    });
});

/***/ })

/******/ });