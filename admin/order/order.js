$(function () {
    //datepicker
    $("#byBeginTime, #byEndTime").datepicker();

    //     $(".form_datetime").datetimepicker({
    //     format: "dd MM yyyy - hh:ii",
    //     autoclose: true,
    //     todayBtn: true,
    //     pickerPosition: "bottom-left"
    // });

    // //Add element to select year of birth
    // curYear = new Date().getFullYear();
    // for (i = 60; i > 0; i--) {
    //     $('<option/>').val(curYear - i).html(curYear - i).appendTo('#byBirthyear');
    // }


    //INFORM ERROR OR SUCCESS
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

loadOrderInfo("", "", "", "", "", "", "", "", "", "")

    $("#formFindOrder").validate({
        rules: {
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
            findBy: $("input[name='findBy']:checked", "form[name='formFindOrder']").val(),
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