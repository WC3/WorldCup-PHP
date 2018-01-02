<?php
/**
 * Created by shucc on 17/8/22.
 * cc@cchao.org
 */

/**
 * @param $is_success
 *      是否请求成功
 * @param $message
 *      返回的信息
 * @param $data
 *      data中json字符串
 * @return string
 */
function package_response($is_success, $message, $data)
{
    $response = array(
        "message" => $message,
        "code" => $is_success == true ? 1 : 0,
        "data" => $data
    );
    return json_encode($response);
}

/**
 * 封装请求成功返回数据
 * @param $message
 * @param $data
 * @return string
 */
function success_response($message, $data)
{
    return package_response(true, $message, $data);
}

/**
 * 封装请求失败返回数据
 * @param $message
 * @return string
 */
function failure_response($message)
{
    return package_response(false, $message, null);
}