$(function(){

         $("#inform").hide();
            function inform(type, content){
                if(type=="ERROR"){
                    $("#inform").removeClass("alert-success").addClass("alert-warning");
                    $("#inform strong span:eq(0)").removeClass("glyphicon-ok-circle").addClass("glyphicon-remove-circle");
                }else{
                    $("#inform").removeClass("alert-warning").addClass("alert-success");
                    $("#inform strong span:eq(0)").removeClass("glyphicon-remove-circle").addClass("glyphicon-ok-circle");
                }
                
                $("#inform strong span:eq(1)").html(" "+type);
                $("#inform span:eq(2)").html(" "+content+" !");
                $("#inform").fadeIn(2000);
                $("#inform").fadeOut(2000);
            }

        $("#formContact").validate({
            rules:{
                email: "required",
                subject: "required",
                message: "required"
            },
            messages:{
                email: "Please enter your email",
                subject: "Please enter your subject",
                message: "Please enter your message"
            },
            submitHandler: function(form){
                 if (!confirm("Are you sure send your idea ?")) return
                $.post(
                    "do_contact.php",
                    {
                        email: $("#email").val(),
                        subject: $("#subject").val(),
                        message: $("#message").val()
                    },
                    function (data, status){
                        temp = data.split(":");
                        inform(temp[0], temp[1]);
                    }
                );
                
            }
        });
    });