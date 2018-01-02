<?php
/**
 * Created by shucc on 17/8/22.
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
if ($result->num_rows > 0) {
    echo failure_response("该邮箱已经注册！");
    mysqli_close($con);
    exit();
}
$add_sql = "insert into user (email, password) values ('" . $email . "', '" . $password . "')";
if (mysqli_query($con, $add_sql)) {
    $result = $con->query($select_sql);
    $row = $result->fetch_assoc();
    $user = new UserInfoModel($row["id"], $row["email"], $row["password"]);
    echo success_response("注册成功！", $user->__toString());
} else {
    echo failure_response("注册失败！");
}
mysqli_close($con);