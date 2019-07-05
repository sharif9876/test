$("document").ready(function() {
    loadMessages();

    
     $('body').on('click',function(e){
      
        if(!($(e.target).parents('.header-message').length)){
           
            $('.callout').css('display','none');

        }
     });
     $('.message-button').on('click',function(e){
            
            if($('.callout').css('display')=="none"){
               updateMessageEntries();
             }else{
               $('.callout').css('display','none');
            }
        
    });

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

 var messagesLoaded = [0];


function loadMessages() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
    });
    $.ajax({
        type: "post",
        url: url()+'/messages/ajaxmessagesfeed',
         data: {
            loaded: messagesLoaded
        },
        dataType: 'json',
        cache: false,
        success: function(response) {
            showNewMessages(response);
        },
        error: function(xhr,status,error) {

            console.log(xhr+"///"+status+"///"+error)
        }
    });
    setTimeout(function(){loadMessages();}, 5000);
}



function swapExclamation(display){
    var callout = $('.callout');
    var exclamationContainer = $('.exclamation-container');
    if(display){
        if(callout.css('display')=='none'){ 
            exclamationContainer.css('display','block');
        }
    }else{
        exclamationContainer.css('display','none');
    }
}

function showNewMessages(messages){
     if(messages!=[]){
         var calloutContent = $("#callout-content-field");
         
         $.each(messages, function(i, v) {
            var blockClass = "message-block";
            if(v.opened == 0){
                swapExclamation(true);
                blockClass = "message-block-unopened";
            }

            var html = ` <div class="`+ blockClass +` ">
                            <div class="message-title">
                                 ` +v.message.title+` 
                            </div>
                            <div class="message-message">
                                ` +v.message.message+`  
                           </div>                  
                         </div>
            `;
            calloutContent.prepend(html);
            messagesLoaded.push(v.id);
        });
     }
}
function openCallout(){
    $('.callout').css('display','block');
    swapExclamation(false);
}

function updateMessageEntries(){
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: url()+'/messages/ajaxmessagesupdate',
            cache: false,
            success: function() {
                openCallout();
            },
            error: function(xhr,status,error) {
                console.log(xhr+"///"+status+"///"+error)
            }
        });
}



