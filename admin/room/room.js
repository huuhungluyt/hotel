$(document).ready(function(){
            //datepicker
            $("#dateOfBirth").datepicker();

            //Add element to select year of birth
            curYear= new Date().getFullYear();
            for (i=60;i>0;i--){
                $('<option/>').val(curYear-i).html(curYear-i).appendTo('#byBirthyear');
            }


            //INFORM ERROR OR SUCCESS
            $("#inform").hide();
            


            //RESET FIND FORM
            $('#resetFindForm').click(function(){
                $('#formFindRoom')[0].reset();
            });

            //UPDATE ROOM INFO
            $("#formUpdateRoom").validate({
                rules:{
                    roomType: "required"
                },
                messages:{
                    roomType: "Please choose room type !"
                },
                submitHandler: function(form){
                    if(!confirm("Do you want to update this room ?")) return;
                    $.post(
                        "do_update.php",
                        {
                            id: $("#roomId").val(),
                            type: $("#roomType").val()
                        },
                        function(data, status){
                            loadRoomInfo();
                            temp = data.split(":");
                            inform(temp[0], temp[1]);
                            $("#updatePopup").modal("hide")
                        }
                    );
                }
            });


            //ADD ROOM
            $("#formAddRoom").validate({
                rules:{
                    addRoomId:{
                        required: true,
                        minlength: 4,
                        maxlength: 4,
                        number: true
                    },
                    addRoomType: "required"
                },
                messages:{
                    addRoomId:{
                        required: "Please enter room ID !",
                        minlength: "Room ID not in format (first 2 digits is floor number, next 2 digit is room number) !",
                        maxlength: "Room ID not in format (first 2 digits is floor number, next 2 digit is room number) !",
                        number: "Room ID is a number !"
                    },
                    addRoomType: "Please choose room type !"
                },
                submitHandler: function(form){
                    if(!confirm("Do you want add this room ?")) return 
                    $.post(
                        "do_add.php",
                        {
                            id: $("#addRoomId").val(),
                            type: $("#addRoomType").val()
                        },
                        function (data, status){
                            loadRoomInfo();
                            temp = data.split(":");
                            inform(temp[0], temp[1]);
                            $("#addPopup").modal("hide")
                        }
                    );
                }
            });

            //LOAD ROOMS INFO
            
            $("#btnFindRoom").click(function(){
                loadRoomInfo()
            });
            loadRoomInfo();

            
});

function loadRoomInfo(){
                $.post(
                    "do_find.php",
                    {
                        findBy: $("input[name='findBy']:checked", "#formFindRoom").val(),
                        byId: $("#byId").val(),
                        byFloor: $("#byFloor").val(),
                        byType: $("#byType").val(),
                        byState: $("#byState").val()
                    },
                    function(data, status){
                        $("#roomInfo> tbody").html(data);
                    }
                );
            };


function fillUpdateForm(id, type){
                $("#roomId").val(id);
                $("#roomType").val(type);
            };


function deleteRoom(_id){
    if(!confirm("Do you want to delete this room ?")) return
    $.post(
        "do_delete.php",
        {
            id: _id
        },
        function (data, status){
            loadRoomInfo();
            temp = data.split(":");
            inform(temp[0], temp[1]);
        }
    )
}

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


function loadHistory(_id){
    $.post(
        "do_loadhistory.php",
        {
            id: _id
        },
        function(data, status){
            $("#history> tbody").html(data);
            $("#historyPopup").modal("toggle");
        }
    )
}