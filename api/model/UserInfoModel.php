<?php
/**
 * Created by shucc on 17/8/23.
 * cc@cchao.org
 */
require_once dirname(dirname(__FILE__)) . "/config.php";

class UserInfoModel
{
    var $id;
    var $email;
    var $password;

    /**
     * UserInfoModel constructor.
     * @param $id
     * @param $email
     * @param $password
     */
    public function __construct($id, $email, $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public function __toString()
    {
        $user_info = array(
            "id" => $this->id,
            "email" => $this->email,
            "password" => $this->password,
            "token" => md5($this->id . ENCRYPTION_CODE)
        );
        return json_encode($user_info);
    }
}