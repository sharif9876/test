$("document").ready(function() {
    $("#formTaskSubmit #imageInput").change(function(e) {
        console.log(e.target);

        if(e.target.files && e.target.files[0]) {
            console.log('ffs');

            var reader = new FileReader();

            reader.onload = function(e) {
                $("#formTaskSubmit #imageResult").css("background-image", "url('"+e.target.result+"')");
                $("#formTaskSubmit #imageRowSubmit").css("display", "block");
            };

            reader.readAsDataURL(e.target.files[0]);
        }
        else {
            $("#formTaskSubmit #imageRowSubmit").css("display", "none");
        }
    });
});
