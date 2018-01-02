$(window, document, undefined).ready(function () {
    $("#login").click(function () {
        var email = $("#email").val();
        var password = $("#password").val();
        var pattern = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        var strEmail = pattern.test(email);
        if (!email) {
            Materialize.toast('邮箱不能为空!', 2000);
        } else if (!strEmail) {
            Materialize.toast('邮箱格式错误!', 2000);
        } else if (!password) {
            Materialize.toast('登录密码不能为空!', 2000);
        } else {
            $("#loading").show();
            $("#login").attr("disabled", true);
            var param = {
                email: email,
                password: password
            };
            post('../api/login.php', param, function (msg) {
                $("#loading").hide();
                $("#login").attr("disabled", false);
                var result = JSON.parse(msg);
                var data = JSON.parse(result.data);
                if (result.code == 1) {
                    window.location.href = "index.html";
                    setCookie("id", data.id, 1);
                    setCookie("email", data.email, 1);
                    setCookie("password", data.password, 1);
                } else {
                    Materialize.toast(result.message, 2000);
                }
            });
        }
    })
});