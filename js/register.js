$(window, document, undefined).ready(function () {
    $("#register").click(function () {
        var email = $("#email").val();
        var password = $("#password").val();
        var password_confirm = $("#password_confirm").val();
        var pattern = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        var strEmail = pattern.test(email);
        if (!email) {
            Materialize.toast('邮箱不能为空!', 2000);
        } else if (!password) {
            Materialize.toast('密码不能为空!', 2000);
        } else if (password != password_confirm) {
            Materialize.toast('两次输入密码不一致!', 2000);
        } else if (!strEmail) {
            Materialize.toast('邮箱格式错误!', 2000);
        } else {
            $("#loading").show();
            $("#register").attr("disabled", true);
            var param = {
                email: email,
                password: password
            };
            post('../api/register.php', param, function (msg) {
                $("#loading").hide();
                $("#register").attr("disabled", false);
                var result = JSON.parse(msg);
                var data = JSON.parse(result.data);
                if (result.code == 1) {
                    window.location.href = "index.html";
                    setCookie("id", data.id, 1);
                    setCookie("email", data.email, 1);
                    setCookie("password", data.password, 1);
                    setCookie("token", data.token);
                } else {
                    Materialize.toast(result.message, 2000);
                }
            });
        }
    })
});