$(function () {
    //datepicker
    $("#dateOfBirth").datepicker();

    //Add element to select year of birth
    curYear = new Date().getFullYear();
    for (i = 60; i > 0; i--) {
        $('<option/>').val(curYear - i).html(curYear - i).appendTo('#byBirthyear');
    }


    //INFORM ERROR OR SUCCESS
    $("#inform").hide();


    //RESET FIND FORM
    $('#resetFindForm').click(function () {
        $('#formFindCustomer')[0].reset();
    });

    //UPDATE CUSTOMER INFO
    $("#formUpdateCustomer").validate({
        rules: {
            username: "required",
            fullName: "required",
            gender: "required",
            dateOfBirth: "required"
        },
        messages: {
            username: "Please enter your username !",
            fullName: "Please enter your full name !",
            gender: "Please choose your gender !",
        },
        submitHandler: function (form) {
            if (!confirm("Do you want to update this customer ?")) return
            $.post(
                "do_update.php",
                {
                    id: $("#customerId").val(),
                    username: $("#username").val(),
                    fullName: $("#fullName").val(),
                    gender: $("#gender").val(),
                    dateOfBirth: $("#dateOfBirth").val()
                },
                function (data, status) {
                    loadCustomerInfo();
                    temp = data.split(":");
                    inform(temp[0], temp[1]);
                    $("#updatePopup").modal("hide")
                }
            );
        }
    });



    $("#btnFindCustomer").click(function () { loadCustomerInfo() });
    loadCustomerInfo();
});


//LOAD CUSTOMERS INFO
function loadCustomerInfo() {
    $.post(
        "do_find.php",
        {
            findBy: $("input[name='findBy']:checked", "form[name='formFindCustomer']").val(),
            byId: $("#byId").val(),
            byUsername: $("#byUsername").val(),
            byFullName: $("#byFullName").val(),
            byGender: $("#byGender").val(),
            byBirthyear: $("#byBirthyear").val()
        },
        function (data, status) {
            $("#customerInfo> tbody").html(data);
        }
    );
};


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



function fillUpdateForm(id, username, fullName, gender, dateOfBirth) {
    $("#customerId").val(id);
    $("#username").val(username);
    $("#fullName").val(fullName);
    $("#gender").val(gender);
    $("#dateOfBirth").val(dateOfBirth);
};

function deleteCustomer(_id) {
    if (!confirm("Do you want to delete this customer ?")) return;
    $.post(
        "do_delete.php",
        {
            id: _id
        },
        function (data, status) {
            loadCustomerInfo();
            temp = data.split(":");
            inform(temp[0], temp[1]);
        }
    )
}

function loadHistory(_id) {
    $.post(
        "do_loadhistory.php",
        {
            id: _id
        },
        function (data, status) {
            $("#history> tbody").html(data);
            $("#historyPopup").modal("toggle");
        }
    )
}