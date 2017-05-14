$(function () {

    $('.datepicker').datepicker();

    $("#inform").hide();

    jQuery.validator.addMethod("rangeOfFee", function (value, element) {
        var lowFee = $('#byLowFee').val();
        var highFee = $('#byHighFee').val();
        if(lowFee.length>0||highFee.length>0){
            return parseInt(lowFee) < parseInt(highFee);
        }
        return true;
    }, "");

    $("#byOrderState").change(function(){
        loadOrderInfo();
    })

    loadOrderInfo()

    $("#formFindOrder").validate({
        rules: {
            byId:{
                number: true
            },
            byBookDate:{
                date: true
            },
            byBeginDate: {
                date: true
            },
            byEndDate: {
                date: true
            },
            byLowFee:{
                number: true
            },
            byHighFee:{
                number: true,
                rangeOfFee: true
            }
        },
        messages: {
            byId:{
                number: "Order ID must be a number !"
            },
            byBookDate:{
                date: "Invalid date format !"
            },
            byBeginTime: {
                date: "Invalid date format !"
            },
            byEndTime: {
                date: "Invalid date format !",
            },
            byLowFee: {
                number: "Invalid number format !"
            },
            byHighFee:{
                number: "Invalid number format ",
                rangeOfFee: "Range of fee not in format !"
            }
        },
        submitHandler: function (form) {
            loadOrderInfo()
        }
    })
});


function loadOrderInfo(){
    $.post(
        "do_find.php",
        {
            findBy: $("input[name='findBy']:checked", "#formFindOrder").val(),
            byId: $("#byId").val(),
            byRoomId: $("#byRoomId").val(),
            byUserId: $("#byUserId").val(),
            byRoomType: $("#byRoomType").val(),
            byBookDate: $("#byBookDate").val(),
            byBeginDate: $("#byBeginDate").val(),
            byEndDate: $("#byEndDate").val(),
            byOrderType: $("#byOrderType").val(),
            byLowFee: $("#byLowFee").val(),
            byHighFee: $("#byHighFee").val(),
            byOrderState: $("#byOrderState").val()
        },
        function(data, status){
            $("#orderInfo> tbody").html(data);
        }
    )
}

//DETELE ORDER
function orderHandler(_action, _id) {
    if (!confirm("Do you want to "+_action+" this order ?")) return;
    $.post(
        "do_handle.php",
        {
            action: _action,
            id: _id
        },
        function (data, status) {
            loadOrderInfo();
            if(_action=="check out"){
                temp = data.split(",");
                informBill(temp[0], temp[1], temp[2], temp[3], temp[4],temp[5], temp[6],temp[7], temp[8], temp[9], temp[10])
            }else{
                temp = data.split(":");
                inform(temp[0], temp[1]);
            }
        }
    )
}

function informBill(roomId, roomType, beginTime, endTime, orderType, hourPrice, dayPrice, unitPrice, money, hours, days){
    $("#roomId").html(roomId)
    $("#roomType").html(roomType)
    $("#beginTime").html(beginTime)
    $("#endTime").html(endTime)
    $("#orderType").html(orderType)
    $("#hourPrice").html(hourPrice)
    $("#dayPrice").html(dayPrice)
    $("#unitPrice").html(unitPrice)
    $("#fee").html(money)
    $("#hours").html(hours)
    $("#days").html(days)
    $("#billPopup").modal("toggle")
}


//INFORM ERROR OR SUCCESS
function inform(type, content) {
    if (type == "ERROR") {
        $("#inform").removeClass("alert-success").addClass("alert-warning");
        $("#inform strong span:eq(0)").removeClass("glyphicon-ok-circle").addClass("glyphicon-remove-circle");
    } else {
        $("#inform").removeClass("alert-warning").addClass("alert-success");
        $("#inform strong span:eq(0)").removeClass("glyphicon-remove-circle").addClass("glyphicon-ok-circle");
    }
    $("#inform strong span:eq(1)").html(" " + type);
    $("#inform span:eq(2)").html(" " + content + " !");
    $("#inform").fadeIn(2000);
    $("#inform").fadeOut(2000);
}