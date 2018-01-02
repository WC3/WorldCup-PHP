<?php
/**
 * Created by shucc on 17/8/21.
 * cc@cchao.org
 */
require_once dirname(__FILE__) . "/config.php";
require_once ROOT_PATH . "util/ResponseUtil.php";
require_once ROOT_PATH . "util/DbHelperUtil.php";
require_once ROOT_PATH . "model/UserInfoModel.php";

$email = $_POST["email"];
$password = $_POST["password"];

$con = DBHelper::getInstance()->select_db();

$select_sql = "select * from user where email = '$email'";
$result = $con->query($select_sql);
if ($result->num_rows <= 0) {
    echo failure_response("该邮箱未注册！");
} else {
    $row = $result->fetch_assoc();
    if ($password == $row["password"]) {
        $user = new UserInfoModel($row["id"], $row["email"], $row["password"]);
        echo success_response("登录成功！", $user->__toString());
    } else {
        echo failure_response("密码错误！");
    }
}
mysqli_close($con);