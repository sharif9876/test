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
/******/ 	return __webpack_require__(__webpack_require__.s = 61);
/******/ })
/************************************************************************/
/******/ ({

/***/ 61:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(62);


/***/ }),

/***/ 62:
/***/ (function(module, exports) {

// var tables = [];
// var tablesTotalRows = [];
// var tablesCurrentRows = [];
//
// $("document").ready(function() {
//     tablesSetup();
//
//     //Check for amount change
//     $(".table .table-amount select").on("change", function(e) {
//         var table = getTable(e.target.closest(".table").id);
//         tableLoad(table);
//     });
//
//     //Check for search input
//     $(".table .table-search input").on("keyup", function(e) {
//         var table = getTable(e.target.closest(".table").id);
//         tableLoad(table);
//     });
//
//     //Check for sort input
//     $(".table .table-header th").on("click", function(e) {
//         var table = getTable(e.target.closest(".table").id);
//         var asc = true;
//         if($(e.target).hasClass("descending")) {
//             asc = false;
//             $(e.target).removeClass("descending");
//         }
//         else {
//             $(e.target).addClass("descending");
//         }
//         tableSort(table, asc);
//     });
// });
//
//
// function tablesSetup() {
//     tablesPrepare();
//     $(tables).each(function(i,v) {
//         tablesTotalRows.push({
//             name : v.name,
//             rows : $("#"+v.name+" .table-row")
//         });
//         tableLoad(getTable(v.name));
//     });
// }
//
// function tablesPrepare() {
//     $(".table").each(function(i,v) {
//         tables.push({
//             name : v.id,
//             page : 1,
//             ajax : $(v).attr("data-ajax") == "true" ? true : false,
//             ajaxPath: $(v).attr("data-ajaxPath") ? $(v).attr("data-ajaxPath") : ""
//         });
//         tablesCurrentRows.push({
//             name : v.id,
//             rows : $("#"+v.id+" .table-row")
//         });
//     });
// }
//
// function getTable(name) {
//     var table = tables.find(item => item.name == name);
//     return table;
// }
// function getCurrentRows(name) {
//     var currentRows = tablesCurrentRows.find(item => item.name == name);
//     return currentRows;
// }
// function getTotalRows(name) {
//     var totalRows = tablesTotalRows.find(item => item.name == name);
//     return totalRows;
// }
// function getSearch(name) {
//     var table = tables.find(item => item.name == name);
//     return $("#"+name+" .table-search input").val();
// }
//
//
// function tableLoad(table) {
//     if(table.ajax) {
//
//     }
//     else {
//         var tableRows = tableLoadRows(table);
//     }
//     // var currentRows = getCurrentRows(table.name);
//     // console.log(currentRows);
//     // currentRows.rows = tableRows;
//     // tablePaginate(table);
// }
//
// function tableLoadRows(table) {
//     //get all rows
//     var tableRows = getTotalRows(table.name).rows;
//     //filter through search
//     var tableSearch = getSearch();
//     var tr = {};
//     tableRows.each(function(i, v) {
//         for(var j = 0; j < v.children.length; j++) {
//             if(v.children[j].textContent.toLowerCase().indexOf(tableSearch) >= 0) {
//                 tr[Object.keys(tr).length] = v;
//                 return true;
//             }
//         }
//     });
//     tableRows = tr;
//     //paginate function
// }
//
// function tableSort() {
//     //get current rows
// }
//
// function tablePaginate(table) {
//
// }
//
// function tableRender(table) {
//
// }


var trl = [];
var trls = [];
var tcp = [];
$("document").ready(function () {
    $(".table").each(function (i, v) {
        trl[v.id] = $("#" + v.id + " .table-row");
        trls[v.id] = $("#" + v.id + " .table-row");
        tcp[v.id] = 1;

        var tn = v.id;
        var t = $("#" + tn + " table");
        var tr = trl[tn];
        fillTable(tr, t);
    });

    $(".table .table-header th").click(function (e) {
        var tn = e.target.closest(".table").id;
        var ci = $(e.target).index();
        var asc = true;
        if ($(e.target).hasClass("descending")) {
            asc = false;
            $(e.target).removeClass("descending");
        } else {
            $(e.target).addClass("descending");
        }
        sortTable(tn, ci, asc);
    });

    $(".table .table-search input").keyup(function (e) {
        var tn = e.target.closest(".table").id;
        var ts = e.target.value;
        tcp[tn] = 1;
        searchTable(tn, ts);
    });

    $(".table .table-amount select").change(function (e) {
        var tn = e.target.closest(".table").id;
        var ts = $("#" + tn + " .table-search input")[0].value;
        tcp[tn] = 1;
        searchTable(tn, ts);
    });

    $(".table .table-pagination .tablep-buttons").on("click", ".tablep-button", function (e) {
        var tn = e.target.closest(".table").id;
        var ts = $("#" + tn + " .table-search input")[0].value;
        var ac = e.target.getAttribute("tablep-action");
        paginateTable(tn, ts, ac);
    });
});

function searchTable(tn, ts) {
    var t = $("#" + tn + " table");
    var trb = trl[tn];
    var tr = {};

    trb.each(function (i, v) {
        for (var j = 0; j < v.children.length; j++) {
            if (v.children[j].textContent.toLowerCase().indexOf(ts) >= 0) {
                tr[Object.keys(tr).length] = v;
                return true;
            }
        }
    });
    tr = Object.values(tr);
    tr = $(tr);
    trls[tn] = tr;
    fillTable(tr, t);
}

function paginateTable(tn, ts, ac) {
    tcp[tn] = ac;
    searchTable(tn, ts);
}

function sortTable(tn, ci, asc) {
    var t = $("#" + tn + " table");
    var trb = trls[tn];
    var tr = trb;

    tr.sort(function (a, b) {
        if (isNaN(a.children[ci].innerHTML) && isNaN(b.children[ci].innerHTML)) {
            if (asc) {
                return a.children[ci].innerHTML > b.children[ci].innerHTML;
            }
            return a.children[ci].innerHTML < b.children[ci].innerHTML;
        }
        if (asc) {
            return a.children[ci].innerHTML - b.children[ci].innerHTML;
        }
        return a.children[ci].innerHTML + b.children[ci].innerHTML;
    });
    fillTable(tr, t);
}

function fillTable(trr, t) {
    t.find(".table-row").remove();
    t.find(".table-empty").remove();
    var tn = t.closest(".table")[0].id;
    var size = $("#" + tn + " .table-amount select").val();
    var tr = [];
    for (var i = (tcp[tn] - 1) * size; i < tcp[tn] * size; i++) {
        if (typeof trr[i] == "undefined") {
            break;
        }
        tr[i] = trr[i];
    }
    tr = Object.values(tr);
    tr = $(tr);
    if (tr.length > 0) {
        tr.each(function (i) {
            t.append(tr[i].outerHTML);
        });
    } else {
        var html = "<tr class='table-empty'><td></td><td></td><td class='table-empty-msg'>No items found.</td></tr>";
        t.append(html);
    }
    var spread = 3;
    var pag = $("#" + tn + " .table-pagination .tablep-buttons");
    pag.find(".tablep-button").remove();
    var tmp = Math.ceil(trls[tn].length / size); //max pages
    if (tcp[tn] < spread + 1) {
        tpMin = 1;
    } else {
        tpMin = Number(tcp[tn]) - Number(spread);
    }
    if (Number(spread) + Number(tcp[tn]) > tmp) {
        tpMax = tmp;
    } else {
        tpMax = Number(tcp[tn]) + Number(spread);
    }
    if (tcp[tn] > 1 && tr.length > 0) {
        var html = "<div class='tablep-button' tablep-action='1'><<</div><div class='tablep-button' tablep-action='" + (parseInt(tcp[tn]) - 1) + "'><</div>";
        pag.append(html);
    }
    for (var i = tpMin; i <= tpMax; i++) {
        if (i == tcp[tn]) {
            var html = "<div class='tablep-button current' tablep-action='" + i + "'>" + i + "</div>";
        } else {
            var html = "<div class='tablep-button' tablep-action='" + i + "'>" + i + "</div>";
        }
        pag.append(html);
    }
    if (tcp[tn] < tmp) {
        var html = "<div class='tablep-button' tablep-action='" + (parseInt(tcp[tn]) + 1) + "'>></div><div class='tablep-button' tablep-action='" + tmp + "'>>></div>";
        pag.append(html);
    }
    var tc = $("#" + tn + " .table-pagination .tablep-counter");
    var tca = tcp[tn] >= tmp ? trls[tn].length - (tcp[tn] - 1) * size : size;
    tc.text("showing " + tca + " / " + trl[tn].length + " entries");
}

//Remake script

//Actions:
//-> load items
//->Order items
//-> paginate

/***/ })

/******/ });