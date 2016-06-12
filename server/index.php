<?php

ini_set('session.gc_maxlifetime', 30*24*3600);
ini_set('session.use_cookies',1);

session_start();

/**
 * Suppose, you are browsing in your localhost
 * http://localhost/myproject/index.php?id=8
 */
function baseUrl()
{
    $currentPath = $_SERVER['PHP_SELF'];
    $pathInfo = pathinfo($currentPath);

    $hostName = $_SERVER['HTTP_HOST'];

    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://' ? 'https://' : 'http://';
    return $protocol.$hostName.$pathInfo['dirname']."/";
}
define("BASE_URL",baseUrl());

define("THEME_URL",baseUrl()."theme/");

$ref = $_REQUEST["ref"];
if(isset($ref) && !empty($ref))
    $_SESSION["ref"] = $ref;

include dirname(__FILE__)."/theme/login.php";

