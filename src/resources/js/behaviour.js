//needs fixing
$("document").on("load", function() {
    $("body").on("click", ".form-submit", function(e) {
        $(e.target).attr("disabled", "disabled");

    });
});
