$("document").ready(function() {
    loadTaskEntries();

    //Check for approval or decline
    $("#task-entries-field").on("click", ".card .card-button", function(e) {
        ei = e.target.closest(".card").getAttribute("card-id");
        ea = e.target.closest(".card-button").getAttribute("card-action");
        updateTaskEntry(ei, ea);
    });
});

var taskEntriesLoaded = [0];

function updateTaskEntry(ei, ea) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: url()+'/admin/tasks/ajaxtasksconfirm',
        data: {
            entry_id: ei,
            action: ea
        },
        cache: false,
        success: function() {
            removeFromFeed(ei);
        },
        error: function(xhr,status,error) {
            console.log(xhr+"///"+status+"///"+error)
        }
    });
}

function removeFromFeed(ci) {
    var card = $(".card[card-id='"+ci+"']");
    card.addClass("disappear");
    setTimeout(function(){card.remove()},350);

}

function loadTaskEntries() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: url()+'/admin/tasks/ajaxtasksfeed',
        data: {
            loaded: taskEntriesLoaded
        },
        dataType: 'json',
        cache: false,
        success: function(response) {
            showNewCards(response);
        },
        error: function(xhr,status,error) {
            console.log(xhr+"///"+status+"///"+error)
        }
    });
    setTimeout(function(){loadTaskEntries();}, 10000);
}

function showNewCards(cards) {
    var cardsField = $("#task-entries-field");
    $.each(cards, function(i, v) {
        if(v.task.type == "image") {var image = "background-image: url('"+url()+"/images/taskentries/"+v.answer+"')";} else {var image = "";}
        var html = `
        <div class="card background-cover" card-id="`+v.id+`" style="`+image+`">
            <div class="card-top">
                <div class="card-approve card-button" card-action="approve">
                    <i class="fas fa-check"></i>
                </div>
                <div class="card-decline card-button" card-action="decline">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="card-bottom">
                <div class="card-date">
                    `+v.date_submit+`
                </div>
            </div>
        </div>`;
        cardsField.append(html);
        taskEntriesLoaded.push(v.id);
    });
}







//FORM INPUTS
$("document").ready(function() {
    // IMAGE
    $(".form .image input").change(function(e) {
        if(e.target.files && e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".form .image .preview").css("background-image", "url('"+e.target.result+"')");
                $(".form .image .preview").css("display", "block");
            };
            reader.readAsDataURL(e.target.files[0]);
        }
        else {
            $(".form .image .preview").css("display", "none");
        }
    });
    // PASSWORD
    $(".form .password .password-toggle").on('click',function(e) {
        var input = $(e.target.closest(".input")).children("input");
        var button = $(e.target.closest(".password-toggle"));
        var icon = $(e.target.closest(".password-toggle")).children("i");
        if(!button.hasClass("toggled")) {
            button.addClass("toggled");
            input.attr("type","text");
            icon.removeClass("fa-eye");
            icon.addClass("fa-eye-slash");
        }
        else {
            button.removeClass("toggled");
            input.attr("type","password");
            icon.removeClass("fa-eye-slash");
            icon.addClass("fa-eye");
        }
    });
});
