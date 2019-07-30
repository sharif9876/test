$("document").ready(function() {
    loadMessages();

     $('body').on('click',function(e){
      
        if(!($(e.target).parents('.header-message').length)){
           
            $('.callout').css('display','none');

        }
     });
    //delete message 

     $('#callout-content-field').on('click','.toast-container .toast-close',function(e){
        deleteMessage(e.target.closest('.toast-container').getAttribute('entry-id'));
        $(e.target.closest('.toast-container')).fadeOut(300,function(){
            $(this).remove();
        });
     });

     $('.message-button').on('click',function(e){
            
            if($('.callout').css('display')=="none"){
              openCallout();
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
 var messagesOpened =[];
 var newMessage = false;

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
function toHtml(type){
        type = type.split('-')[1];
        var types = {
            'approved':` <div class="toast--green">
          <div class="toast-icon"> <svg version="1.1" class="toast-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
        <g><g><path d="M504.502,75.496c-9.997-9.998-26.205-9.998-36.204,0L161.594,382.203L43.702,264.311c-9.997-9.998-26.205-9.997-36.204,0    c-9.998,9.997-9.998,26.205,0,36.203l135.994,135.992c9.994,9.997,26.214,9.99,36.204,0L504.502,111.7    C514.5,101.703,514.499,85.494,504.502,75.496z"></path>
          </g></g>
            </svg> ` ,
            'level':` <div class="toast--blue">
          <div class="toast-icon"> <svg version="1.1" class="toast-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
<g>
    <g id="info">
        <g>
            <path  d="M10,16c1.105,0,2,0.895,2,2v8c0,1.105-0.895,2-2,2H8v4h16v-4h-1.992c-1.102,0-2-0.895-2-2L20,12H8     v4H10z"></path>
            <circle  cx="16" cy="4" r="4"></circle>
        </g>
    </g>
</g>

    </svg>`,
            'date':` <div class="toast--blue">
          <div class="toast-icon"> <svg version="1.1" class="toast-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
<g>
    <g id="info">
        <g>
            <path  d="M10,16c1.105,0,2,0.895,2,2v8c0,1.105-0.895,2-2,2H8v4h16v-4h-1.992c-1.102,0-2-0.895-2-2L20,12H8     v4H10z"></path>
            <circle  cx="16" cy="4" r="4"></circle>
        </g>
    </g>
</g>

    </svg>`,
            'declined':` <div class="toast--red">
          <div class="toast-icon"><svg version="1.1" class="toast-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 301.691 301.691" style="enable-background:new 0 0 301.691 301.691;" xml:space="preserve">
<g>
    <polygon points="119.151,0 129.6,218.406 172.06,218.406 182.54,0  "></polygon>
    <rect x="130.563" y="261.168" width="40.525" height="40.523"></rect>
</g>
    </svg> `
        
       
   
    }
    return types[type];
}
function showNewMessages(messages){
     if(messages!=[]){
         var calloutContent = $("#callout-content-field");
                   
         $.each(messages, function(i, v) { 
            var opened ="opened-toast";
            if(v.opened == 0){
                swapExclamation(true);
                opened ="unopened-toast";
                newMessage = true;
            }

            var html = ` 
<div class="toast-container" entry-id="`+v.id+`">
        <div class="`+opened+`" id="`+v.id+`" >
            `+toHtml(v.message.type)+ ` 
          </div>
          <div class="toast-content">
            <p class="toast-title-`+v.message.type.split('-')[1]+`">`+v.message.title+`</p>
            <p class="toast-message">`+v.message.message+`</p>
          </div>
          <div class="toast-close" >
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.642 15.642" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 15.642 15.642">
          <path fill-rule="evenodd" d="M8.882,7.821l6.541-6.541c0.293-0.293,0.293-0.768,0-1.061  c-0.293-0.293-0.768-0.293-1.061,0L7.821,6.76L1.28,0.22c-0.293-0.293-0.768-0.293-1.061,0c-0.293,0.293-0.293,0.768,0,1.061  l6.541,6.541L0.22,14.362c-0.293,0.293-0.293,0.768,0,1.061c0.147,0.146,0.338,0.22,0.53,0.22s0.384-0.073,0.53-0.22l6.541-6.541  l6.541,6.541c0.147,0.146,0.338,0.22,0.53,0.22c0.192,0,0.384-0.073,0.53-0.22c0.293-0.293,0.293-0.768,0-1.061L8.882,7.821z"></path>
        </svg>
          </div>
          </div>
        </div>
</div>


            `;
            calloutContent.prepend(html);
            messagesLoaded.push(v.id);
        });
     }
}

function openCallout(){
    var unopened = $('.unopened-toast');
     $('.callout').css('display','block');
    swapExclamation(false);
    var entries = unopened.map(function(){
        return $(this).attr('id');
    }).get();

    $.each(entries,function(i,v){
           
        if(messagesOpened.includes(v)){
            $('#'+v).attr('class','opened-toast');
        }
    });
    messagesOpened = messagesOpened.concat(entries);
    if(newMessage){
        updateMessageEntries();
        newMessage = false;
    }
}
function deleteMessage(id){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: url()+'/messages/ajaxmessagedelete',
            cache: false,
            data : {
                messageEntry : id
            },
            success: function() {
                
                
            },
            error: function(xhr,status,error) {
                console.log(xhr+"///"+status+"///"+error)
            }
        });
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
                
                
            },
            error: function(xhr,status,error) {
                console.log(xhr+"///"+status+"///"+error)
            }
        });
}



