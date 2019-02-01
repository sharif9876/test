$("document").ready(function() {
    $("#sidebarToggle").click(function() {
        sidebarToggle();
    });
});

function sidebarToggle() {
    var sb = $("#sidebar");
    var pc = $("#pageContent");
    var sti = $("#sidebarToggle i");
    var smfull = $("#smfull");
    var smsmall = $("#smsmall");
    if(!sb.hasClass("toggled")) {
        sb.css({"width":"70px"});
        pc.css({"width":"calc(100% - 70px)", "margin-left":"70px"});
        sb.addClass("toggled");
        sti.addClass("fa-rotate-180");
        smfull.css({"display":"none"});
        smsmall.css({"display":"block"});
    }
    else {
        sb.css({"width":"250px"});
        pc.css({"width":"calc(100% - 250px)", "margin-left":"250px"});
        sb.removeClass("toggled");
        sti.removeClass("fa-rotate-180");
        smfull.css({"display":"block"});
        smsmall.css({"display":"none"});
    }
}
