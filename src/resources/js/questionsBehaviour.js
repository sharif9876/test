$("document").ready(function() {
    // Form select input
    $("form .form-input.select .select-field").on("click", ".select-option", function(e) {
        var form = $(e.target.closest(".form"));
        var ih = form.find(".form-input.select .select-hidden");
        var sf = form.find(".select-field");
        var tb = $(e.target).closest(".select-option");
        // Reset all buttons
        sf.find(".select-option").each(function(i, v) {
            $(v).removeClass("selected");
        });
        // Select selected button
        tb.addClass("selected");
        // Set hidden input
        var val = $(tb).attr("select-value");
        ih.val(val);
    });
    // Form multiple input
    $("form .form-input.multiple .select-field").on("click", ".select-option", function(e) {
        var form = $(e.target.closest(".form"));
        var ih = form.find(".form-input.multiple .select-hidden");
        var sf = form.find(".select-field");
        var tb = $(e.target).closest(".select-option");
        // Select selected button
        if(tb.hasClass("selected")) {
            tb.removeClass("selected");
        }
        else {
            tb.addClass("selected");
        }
        // Set hidden input
        var val = "";
        sf.find(".select-option.selected").each(function(i, v) {
            val += $(v).attr("select-value")+",";
        });
        val = val.slice(0, -1);
        ih.val(val);
    });
});
