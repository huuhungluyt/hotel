jQuery.validator.addMethod("isValid", function (value, element) {
    var startDate = Date.parse($('#start_time').val());
    var now = new Date();
    return startDate > now;
}, "* End date must be after start date");

$(function(){

    $("#start_time").datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
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

    $("#formBook").validate({
        rules:{
            start_time: {
                required: true,
                isValid: true
            }
        },
        messages:{
            start_time: {
                required: "Please choose start date",
                isValid: "Start time must be after current time"
            }
        },
        submitHandler: function(form){
        if (!confirm("Are you sure book this room ?")) return
            $.post(
                "do_bookRoom.php",
                {
                    id_user: $("#user_id").val(),
                    id_room: $("#room_id").val(),
                    type_room: $("#room_type").val(),
                    start_time: $("#start_time").val(),
                    price_type: $("#type_price").val()
                },
                function(data, status){
                    temp= data.split(":");
                    inform(temp[0], temp[1]);
                    loadRoomSearch();
                    $("#myBook").modal("hide");
                }
            )
        }
    });

    $("#byType, #byFloor").change(function(){
        loadRoomSearch()
    });
    loadRoomSearch();
    
});
function loadRoomSearch(){
    $.post(
        "do_findRoom.php",
        {
            byType: $("#byType").val(),
            byFloor: $("#byFloor").val()
        },
        function(data, status){
            $("#roomResult> tbody").html(data);
        }
    );
};
function fillIdUser(id_user, id_room, hourPrice, dayPrice){
    $("#user_id").val(id_user);
    $("#room_id").val(id_room);

    $("#type_price").html("<option value='hour'> Hour price: "+hourPrice+"</option><br>"+
                            "<option value='day'> Day price: "+dayPrice+"</option>");
};

