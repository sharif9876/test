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
function display(link) {


    $(document.body).append('<div id="img" style="position:absolute;" ><img width="300" heigth="300" src="' + link + '" ></div>');
}

function move(e) {
    var x = e.clientX;
    var y = e.clientY;
    $('#img').css('top', y + 10).css("left", x - 300);
}
function del() {
    $('#img').remove();
}
            
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
        <div class="card background-cover" title="`+v.task.title+`" card-id="`+v.id+`" style="`+image+`">
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
                <div class="card-user">
                    `+v.user.name+`
                </div>
            </div>
        </div>`;
        cardsField.append(html);
        taskEntriesLoaded.push(v.id);
    });
}



function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-')
        ;
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



    // TASK RELATIONS
    $(".form.task-add .relation .relation-add .add-button").on('click',function(e) {
        var input = $(e.target.closest(".form-input")).children(".input-requirements");
        var field = $(e.target.closest(".form-input")).children(".relations");
        var questionsList = "";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: url()+'/admin/tasks/ajaxquestionsidlist',
            dataType: 'json',
            cache: false,
            success: function(response) {
                questionsList += `<select class="relation-question-id"><option></option>`;
                $(response).each(function(i, v) {
                    questionsList += `
                    <option value="`+v.id+`">`+v.question+`</option>
                    `;
                });
                questionsList += `</select>`;
                var html = `
                <li class="relation">
                    <div class="relation-row">
                        <div class="relation-left">
                            <div class="relation-label">
                                <label>QUESTION</label><span class="relation-remove"><i class="fas fa-times"></i></span>
                            </div>
                            <div class="relation-input">
                                `+questionsList+`
                            </div>
                        </div>
                    </div>
                </li>
                `;
                field.append(html);
            },
            error: function(xhr,status,error) {
                alert("something went wrong");
                return;
            },
            fail: function() {
                alert("something went wrong");
                return;
            }
        });
    });
    $(".form.task-add .relations").on('change', ' .relation-input select',function(e) {
        var id = $(e.target).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: url()+'/admin/tasks/ajaxquestionanswerinput',
            data: {
                question_id: id
            },
            dataType: 'json',
            cache: false,
            success: function(response) {
                //response = anything inside input
                var answer = response;
                var relation = $(e.target.closest(".relation")).children(".relation-row");
                var html = `
                <div class="relation-right">
                    <div class="answer-label">
                        <label>ANSWER</label>
                    </div>
                    <div class="answer-input">
                        `+answer+`
                    </div>
                </div>
                `;
                $(relation).find(".relation-right").remove();
                relation.append(html);
                compileRelations(e);
            },
            error: function(xhr,status,error) {
                alert(xhr+status+error);
                return;
            },
            fail: function() {
                alert("something went wrong");
                return;
            }
        });
    });
    $(".form.task-add .relations").on('click', ' .relation-label .relation-remove',function(e) {
        $(e.target.closest("li")).remove();
        compileRelations(e);
    });
    $(".form.task-add .relations").on('change', '.relation-question-answer',function(e) {
        compileRelations(e);
    });
    function compileRelations(e) {
        var relations = $(e.target.closest(".relations")).children("li");
        var inputV = "";
        relations.each(function(i,v) {
            var rq = $(v).find(".relation-question-id").val();
            var ra = $(v).find(".relation-question-answer").val();
            inputV += rq+":"+ra+",";
        });
        inputV = inputV.slice(0, -1);
        inputH = $(e.target.closest(".form-input")).find(".input-requirements");
        inputH.val(inputV);
    }







    // TASK RELATIONS
    $(".form.question-add .relation .relation-add .add-button").on('click',function(e) {
        var input = $(e.target.closest(".form-input")).children(".input-requirements");
        var field = $(e.target.closest(".form-input")).children(".relations");
        var questionsList = "";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: url()+'/admin/questions/ajaxquestionsidlist',
            dataType: 'json',
            cache: false,
            success: function(response) {
                questionsList += `<select class="relation-question-id"><option></option>`;
                $(response).each(function(i, v) {
                    questionsList += `
                    <option value="`+v.id+`">`+v.question+`</option>
                    `;
                });
                questionsList += `</select>`;
                var html = `
                <li class="relation">
                    <div class="relation-row">
                        <div class="relation-left">
                            <div class="relation-label">
                                <label>QUESTION</label><span class="relation-remove"><i class="fas fa-times"></i></span>
                            </div>
                            <div class="relation-input">
                                `+questionsList+`
                            </div>
                        </div>
                    </div>
                </li>
                `;
                field.append(html);
            },
            error: function(xhr,status,error) {
                alert("something went wronggg");
                return;
            },
            fail: function() {
                alert("something went wrongg");
                return;
            }
        });
    });
    $(".form.question-add .relations").on('change', ' .relation-input select',function(e) {
        var id = $(e.target).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: url()+'/admin/questions/ajaxquestionanswerinput',
            data: {
                question_id: id
            },
            dataType: 'json',
            cache: false,
            success: function(response) {
                //response = anything inside input
                var answer = response;
                var relation = $(e.target.closest(".relation")).children(".relation-row");
                var html = `
                <div class="relation-right">
                    <div class="answer-label">
                        <label>ANSWER</label>
                    </div>
                    <div class="answer-input">
                        `+answer+`
                    </div>
                </div>
                `;
                $(relation).find(".relation-right").remove();
                relation.append(html);
                compileRelations(e);
            },
            error: function(xhr,status,error) {
                alert(xhr+status+error);
                return;
            },
            fail: function() {
                alert("something went wrong");
                return;
            }
        });
    });
    $(".form.question-add .relations").on('click', ' .relation-label .relation-remove',function(e) {
        $(e.target.closest("li")).remove();
        compileRelations(e);
    });
    $(".form.question-add .relations").on('change', '.relation-question-answer',function(e) {
        compileRelations(e);
    });
    function compileRelations(e) {
        var relations = $(e.target.closest(".relations")).children("li");
        var inputV = "";
        relations.each(function(i,v) {
            var rq = $(v).find(".relation-question-id").val();
            var ra = $(v).find(".relation-question-answer").val();
            inputV += rq+":"+ra+",";
        });
        inputV = inputV.slice(0, -1);
        inputH = $(e.target.closest(".form-input")).find(".input-requirements");
        inputH.val(inputV);
    }






    // Answer Types
    $("document").on("load",function(e) {
        compileAnswers(e);
    });
    $(".form.question-add .question-answer-type").on("change", ".answer-type", function(e) {
        setDisplayedAnswerType(e);
        compileAnswers(e);
    });
    $(".form.question-add .answers .select").on("keyup", ".answer-compile", function(e){
        compileAnswers(e);
    });
    $(".form.question-add .answers .select").on("click", ".add-button", function(e){
        addAnswerField(e);
        compileAnswers(e);
    });
    $(".form.question-add .answers .select").on("click", ".remove-button", function(e){
        removeAnswerField(e)
        compileAnswers(e);
    });

    function setDisplayedAnswerType(e) {
        var types_DOM = $(".form.question-add .answers .type-answer");
        types_DOM.each(function(i, v) {
            $(v).removeClass("active");
        });
        var type_active_DOM = $(".form.question-add .answers .type-answer."+e.target.value);
        type_active_DOM.addClass("active");
    }
    function addAnswerField(e) {
        var html = `
            <li class="answer-field">
                <input type="text" class="answer-compile"><span class="remove-button"><i class="fas fa-times"></i></span>
            </li>
        `;
        var al = $(".form.question-add .answers .select .answers-list");
        al.append(html);
    }
    function removeAnswerField(e) {
        e.target.closest(".answer-field").remove();
    }
    function compileAnswers(e) {
        var at = $(".form.question-add .question-answer-type .answer-type")[0].value;
        var af = $(".form.question-add .answers .type-answer."+at);
        var ac = af.find(".answer-compile");
        var ai = $(".form.question-add .answers .answers-input");
        var as = "";
        ac.each(function(i, v) {
            as += v.value+":"+convertToSlug(v.value)+",";
        });
        as = as.slice(0, -1);
        ai[0].value = as;
    }
});
