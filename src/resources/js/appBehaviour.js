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
 
    
      
$('.chevron-up').click(function(){
        var count = $(this).attr('id');
        $('.page-container.previous-levels').css('visibility','visible');
        $('.page-container.previous-levels').css('height','auto');
        var height =$("#previous-levels").height();
        $('.page-container.previous-levels').css('height','0');
         $('.page-container.previous-levels').css('position','relative  ');
        $('.page-container.previous-levels').css('height',height+count*7);
        $('.chevron-up').css('display','none');
        $('.chevron-down').css('display','block');
       
 

    });
  $('.chevron-down').click(function(){
        $('.page-container.previous-levels').css('height','0');
        $('.chevron-down').css('display','none');
        $('.chevron-up').css('display','block');
    });  
     
   

    $("#timeline").on("load", function(e) {
        console.log('hi');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: url()+'/timeline/ajaxTimeLine',
            data: {
                offset: tel
            },
            cache: false,
            success: function(result) {
                var elements = result;
                console.log(elements);
            },
            error: function(xhr,status,error) {
                console.log(xhr+"///"+status+"///"+error)
            }
        });
    });
});
