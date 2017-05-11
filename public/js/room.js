$(function(){
    $("#start_time").datepicker();
    $("#end_time").datepicker();

    $("#formSearch").validate({
        rules:{
            start_time: "required",
            end_time: "required",
        },
        messages:{
            start_time: "Please choose start date",
            end_time: "Please choose end date"
        },
        submitHandler: function(form){
            form.submit();
        }
    });

});

