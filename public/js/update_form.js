$(function () {
            //datepicker
            $("#update_dateOfBỉrth").datepicker();

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


             $("form[name='formUpdateAccount']").validate({
                rules:{
                    up_username: "required",
                    up_password: {
                        required: true,
                        minlength: 5
                    },
                    up_re_password:{
                        equalTo: up_password
                    },
                    up_fullname: "required",
                    up_genderradio: "required",
                    update_dateOfBỉrth: "required"
                },
                messages:{
                    up_username: "Please enter your username",
                    up_password: {
                        required: "Please enter your password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    up_re_password: "Please enter your password again",
                    up_fullname: "Please enter your fullname",
                    up_genderradio: "Please choose your gender",
                },
                submitHandler: function(form) {
                    if (!confirm("Do you want to update this customer ?")) return
                    $.post(
                        "do_updateCustomer.php",
                        {
                            idUp: $("#up_id").val(),
                            usernameUp: $("#up_username").val(),
                            passwordUp: $("#up_password").val(),
                            fullnameUp: $("#up_fullname").val(),
                            genderUp:$("input[name='up_genderradio']:checked", "form[name='formUpdateAccount']").val(),
                            dateOfBirthUp: $("#update_dateOfBỉrth").val()
                        },
                        function(data, status){
                            temp= data.split(":");
                            inform(temp[0], temp[1]);
                            $("#loginUsername").html(temp[2]);
                            $("#myEditaccount").modal("hide")
                        }
                    );
                }

            });
});
function fillUpdateAccForm(id, username, password, re_password, userFullName, gender, dateOfBirth){
    $("#up_id").val(id);
    $("#up_username").val(username);
    $("#up_password").val(password);
    $("#up_re_password").val(re_password);
    $("#up_fullname").val(userFullName);
    $('input:radio[name=up_genderradio]').filter('[value='+gender+']').prop('checked', true);
    // $("input[name='up_genderradio']", "form[name='formUpdateAccount']").val(gender);
    $("#update_dateOfBỉrth").val(dateOfBirth);
};