$(function () {

$('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });


    $("#inform").hide();

jQuery.validator.addMethod("rangeOfTime", function (value, element) {
    var beginTime = $('#byBeginTime').val();
    var endTime = $('#byEndTime').val();
    if(beginTime.length>0||endTime.length>0){
        return Date.parse(beginTime) < Date.parse(endTime);
    }
    return true;
}, "");

jQuery.validator.addMethod("rangeOfFee", function (value, element) {
    var lowFee = $('#byLowFee').val();
    var highFee = $('#byHighFee').val();
    if(lowFee.length>0||highFee.length>0){
        return parseInt(lowFee) < parseInt(highFee);
    }
    return true;
}, "");

    loadOrderInfo()

    $("#formFindOrder").validate({
        rules: {
            byId:{
                number: true
            },
            byBeginTime: {
                date: true
            },
            byEndTime: {
                date: true,
                rangeOfTime: true
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
            byBeginTime: {
                date: "Invalid date format !"
            },
            byEndTime: {
                date: "Invalid date format !",
                rangeOfTime: "End time must be after begin time !"
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
            byBeginTime: $("#byBeginTime").val(),
            byEndTime: $("#byEndTime").val(),
            byOrderType: $("#byOrderType").val(),
            byLowFee: $("#byLowFee").val(),
            byHighFee: $("#byHighFee").val()
        },
        function(data, status){
            $("#orderInfo> tbody").html(data);
        }
    )
}