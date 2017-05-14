$(document).ready(function(){
            //INFORM ERROR OR SUCCESS
            $("#inform").hide();
            


            //RESET FIND FORM
            $('#resetFindForm').click(function(){
                $('#formFindRoom')[0].reset();
            });

            //UPDATE ROOM INFO
            $("#formUpdateRoomType").validate({
                rules:{
                    roomType:{
                        required: true,
                        maxlength: 16
                    },
                    updateMaxPeople:{
                        required: true,
                        number: true
                    },
                    updateNumOfBeds:{
                        required: true,
                        number: true
                    },
                    updateHourPrice:{
                        required: true,
                        number: true
                    },
                    updateDayPrice:{
                        required: true,
                        number: true
                    },
                    updateUnitPrice:{
                        required: true,
                        number: true
                    }
                },
                messages:{
                    roomType:{
                        required: "Please enter name of room type !",
                        maxlength: "Max length 16 !"
                    },
                    updateMaxPeople:{
                        required: "Please enter max number of people !",
                        number: "Must be a number !"
                    },
                    updateNumOfBeds:{
                        required: "Please enter number of beds !",
                        number: "Must be a number !"
                    },
                    updateHourPrice:{
                        required: "Please enter hour price !",
                        number: "Must be a number !"
                    },
                    updateDayPrice:{
                        required: "Please enter day price !",
                        number: "Must be a number !"
                    },
                    updateUnitPrice:{
                        required: "Please enter unit price !",
                        number: "Must be a number !"
                    }
                },
                submitHandler: function(form){
                    if(!confirm("Do you want to update this room type?")) return;
                    $.post(
                        "do_update.php",
                        {
                            roomType: $("#roomType").val(),
                            updateMaxPeople: $("#updateMaxPeople").val(),
                            updateNumOfBeds: $("#updateNumOfBeds").val(),
                            updateFood: $("#updateFood").val(),
                            updateHourPrice: $("#updateHourPrice").val(),
                            updateDayPrice: $("#updateDayPrice").val(),
                            updateUnitPrice: $("#updateUnitPrice").val(),
                            updateImage: $("#updateImage").val()
                        },
                        function(data, status){
                            loadRoomTypeInfo();
                            temp = data.split(":");
                            inform(temp[0], temp[1]);
                            $("#updatePopup").modal("hide")
                        }
                    );
                }
            });


            //ADD ROOM
            $("#formAddRoomType").validate({
                rules:{
                    addType:{
                        required: true,
                        maxlength: 16
                    },
                    addMaxPeople:{
                        required: true,
                        number: true
                    },
                    addNumOfBeds:{
                        required: true,
                        number: true
                    },
                    addHourPrice:{
                        required: true,
                        number: true
                    },
                    addDayPrice:{
                        required: true,
                        number: true
                    },
                    addUnitPrice:{
                        required: true,
                        number: true
                    }
                },
                messages:{
                    addType:{
                        required: "Please enter name of room type !",
                        maxlength: "Max length 16 !"
                    },
                    addMaxPeople:{
                        required: "Please enter max number of people !",
                        number: "Must be a number !"
                    },
                    addNumOfBeds:{
                        required: "Please enter number of beds !",
                        number: "Must be a number !"
                    },
                    addHourPrice:{
                        required: "Please enter hour price !",
                        number: "Must be a number !"
                    },
                    addDayPrice:{
                        required: "Please enter day price !",
                        number: "Must be a number !"
                    },
                    addUnitPrice:{
                        required: "Please enter unit price !",
                        number: "Must be a number !"
                    }
                },
                submitHandler: function(form){
                    if(!confirm("Do you want add this room ?")) return 
                    $.post(
                        "do_add.php",
                        {
                            addType: $("#addType").val(),
                            addMaxPeople: $("#addMaxPeople").val(),
                            addNumOfBeds: $("#addNumOfBeds").val(),
                            addFood: $("#addFood").val(),
                            addHourPrice: $("#addHourPrice").val(),
                            addDayPrice: $("#addDayPrice").val(),
                            addUnitPrice: $("#addUnitPrice").val(),
                            addImage: $("#addImage").val()
                        },
                        function (data, status){
                            loadRoomTypeInfo();
                            temp = data.split(":");
                            inform(temp[0], temp[1]);
                            $("#addPopup").modal("hide")
                        }
                    );
                }
            })

            //LOAD ROOMS INFO
            
            $("#btnFindRoomType").click(function(){
                loadRoomTypeInfo()
            });
            loadRoomTypeInfo();

            
});

function loadRoomTypeInfo(){
                $.post(
                    "do_find.php",
                    {
                        findBy: $("input[name='findBy']:checked", "#formFindRoomType").val(),
                        byType: $("#byType").val(),
                        byMaxPeople: $("#byMaxPeople").val(),
                        byNumOfBeds: $("#byNumOfBeds").val(),
                        byFood: $("#byFood").val()
                    },
                    function(data, status){
                        $("#roomTypeInfo> tbody").html(data);
                    }
                );
            };


function fillUpdateForm(type, maxPeople, numOfBeds, food, hourPrice, dayPrice, price, image){
                $("#roomType").val(type);
                $("#updateMaxPeople").val(maxPeople);
                $("#updateNumOfBeds").val(numOfBeds);
                $("#updateFood").val(food);
                $("#updateHourPrice").val(hourPrice);
                $("#updateDayPrice").val(dayPrice);
                $("#updateUnitPrice").val(price);
                $("#updateImage").val(image);
                
                $("#updatePopup").modal("toggle");
            };


function deleteRoomType(_type){
    if(!confirm("Do you want to delete this room type?")) return
    $.post(
        "do_delete.php",
        {
            type: _type
        },
        function (data, status){
            loadRoomTypeInfo();
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