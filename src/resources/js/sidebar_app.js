$("document").ready(function() {
    $("#sidebarToggle").click(function() {
        sidebarToggle();
    });
});

function sidebarToggle() {
    var sb = $("#sidebar");
    if(!sb.hasClass("toggled")) {
        sb.css({"left":"0%"});
        sb.addClass("toggled");
    }
    else {
        sb.css({"left":"-100vw"});
        sb.removeClass("toggled");
    }
}
