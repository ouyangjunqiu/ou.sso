<?php
/**
 * 登录验证程序
 * */
function LoginValidate($username,$password){
    return $username == $password;
}

ini_set('session.gc_maxlifetime', 30*24*3600);
ini_set('session.use_cookies',1);

session_start();

if(empty($_SESSION["ref"]))
    $_SESSION["ref"] = "user.php";
$postData = $_REQUEST["LoginForm"];   
if(!empty($postData) && LoginValidate($postData["username"],$postData["password"])){
    setcookie("username",$postData["username"],$expire,"/",".".$_SERVER['HTTP_HOST']);
    header("Location:".$_SESSION["ref"]);
}else{
    header("Location:index.php?ref=".$_SESSION["ref"]."&retry=true");
}


