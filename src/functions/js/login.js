$("#form-login").submit((e) => {
    if ($("#username").val() === "") {
        $("#username").addClass("is-invalid");
        $("#username").removeClass("is-valid");
        $("#password").removeClass("is-valid");
    } else if ($("#password").val() === "") {
        $("#password").addClass("is-invalid");
        $("#password").removeClass("is-valid");
    } else {
        $("#username").addClass("is-valid");
        $("#username").removeClass("is-invalid");
        $("#password").addClass("is-valid");
        $("#password").removeClass("is-invalid");
        $.ajax({
                method: "POST",
                url: "src/controllers/checkLogin.php",
                data: $("#form-login").serialize()
            })
            .done((response) => {
                // console.log(response);
                //////////////////////////
                let data = JSON.parse(response);
                if (data.status_code === 200) {
                    Swal.fire({
                        "title": "แจ้งเตือน",
                        "text": data.msg,
                        "icon": data.type
                    })
                    setTimeout(() => {
                        window.location = "src/views/main.php?page=showdata-computer";
                    }, 1000)
                } else {
                    Swal.fire({
                        "title": "แจ้งเตือน",
                        "text": data.msg,
                        "icon": data.type,
                    })
                    $("#password").addClass("is-invalid");
                    $("#password").removeClass("is-valid");
                    $("#password").val("");
                }
                /////////////////////////
            })
            .fail((error) => {
                console.log(JSON.parse(error));
            });
    }
    e.preventDefault();
});