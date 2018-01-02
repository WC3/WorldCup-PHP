<?php
/**
 * Created by shucc on 17/8/22.
 * cc@cchao.org
 */
require_once dirname(dirname(__FILE__)) . "/config.php";
require_once ROOT_PATH . "util/ResponseUtil.php";

class DBHelper
{

    private static $con;
    private static $instance;

    /**
     * DBHelper constructor.
     */
    private function __construct()
    {

    }

    public function _clone()
    {

    }

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function select_db()
    {
        self::$con = mysqli_connect("localhost:3306", "test", "123456", "worldcup");
        if (!self::$con) {
            echo failure_response("数据库连接失败！");
            exit();
        }
        return self::$con;
    }

    public function close()
    {
        mysqli_close(self::$con);
    }
}