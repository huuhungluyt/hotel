$(function () {
            //datepicker
            $("#dateOfBirth").datepicker();
            // //Add element to select year of birth
            // curYear= new Date().getFullYear();
            // for (i=60;i>0;i--){
            //     $('<option/>').val(curYear-i).html(curYear-i).appendTo('#byBirthyear');
            // }

              //INFORM ERROR OR SUCCESS
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


            $("#formRegisAccount").validate({
                rules:{
                    username: "required",
                    password: {
                        required: true,
                        minlength: 5
                    },
                    re_password:{
                        equalTo: password
                    },
                    fullname: "required",
                    genderradio: "required",
                    dateOfBirth: "required"
                },
                messages:{
                    username: "Please enter your username",
                    password: {
                        required: "Please enter your password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    re_password:{
                        equalTo: "Please enter your password again"
                    },
                    fullname: "Please enter your fullname",
                    genderradio: "Please choose your gender",
                },
                submitHandler: function(form) {
                    $.post(
                        "do_regisaccount.php",
                        {
                            regis_username: $("#username").val(),
                            regis_password: $("#password").val(),
                            regis_fullname: $("#fullname").val(),
                            regis_gender: $("input[name='genderradio']:checked", "form[name='formRegisAccount']").val(),
                            regis_dateOfBirth: $("#dateOfBirth").val()
                        },
                        function (data, status){
                            temp= data.split(":");
                            inform(temp[0], temp[1]);
                            $("#myModal").modal("hide")
                        }
                    );
                    
                }
            });
});

