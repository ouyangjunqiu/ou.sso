<?php
/**
 * @file users.php
 * @author ouyangjunqiu
 * @since 16/6/13 16:51
 */

/**
 * @param $username
 * @param $password
 * @param $user
 * @return bool
 */
function LoginValidate($username, $password, &$user)
{

    if ($username == "admin" && md5($password) == md5("admin")) {
        $user = array("username" => $username, "password" => md5("admin"));
        return true;
    }

    return false;
}

/**
 * @param $token
 * @return array|null
 */
function GetUserByToken($token)
{
    if ($token == "admin") {
        $user = array("username" => "admin", "password" => md5("admin"));
        return $user;
    }
    return null;
}

/**
 * @param $username
 * @param $password
 * @return bool
 */
function login($username, $password)
{
    if (LoginValidate($username, $password, $loginUser)) {
        $_SESSION["user"] = $loginUser;
        $time = time();
        setcookie('__u', $username, time() + 30 * 24 * 3600, time() + 30 * 24 * 3600, "/", $_SERVER["HTTP_HOST"]);
        setcookie('__t', $time, time() + 30 * 24 * 3600, time() + 30 * 24 * 3600, "/", $_SERVER["HTTP_HOST"]);
        setcookie('__token', md5(base64_encode($time . $username . $loginUser["password"] . $time)), time() + 30 * 24 * 3600, "/", $_SERVER["HTTP_HOST"]);
        return true;
    }
    return false;
}

/**
 *
 */
function validateCookie()
{
    $u = $_COOKIE["__u"];
    $t = $_COOKIE["__t"];
    $token = $_COOKIE["__token"];

    $user = GetUserByToken($u);
    if ($user) {
        if ($token == md5(base64_encode($t . $user["username"] . $user["password"] . $t))) {
            $_SESSION["user"] = $user;
            return true;
        }
    }
    return false;
}
