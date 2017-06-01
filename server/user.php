<?php
require_once dirname(__FILE__)."/lib/functions.php";
require_once dirname(__FILE__)."/lib/users.php";
env_init();

$callback = $_REQUEST["callbackparam"];
if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
    echo $callback."(".json_encode(array("islogin"=>true,'data'=>$_SESSION["user"])).")";
}else if(validateCookie()){
    echo $callback."(".json_encode(array("islogin"=>true,'data'=>$_SESSION["user"])).")";
}else{
    echo $callback."(".json_encode(array("islogin"=>false)).")";
}
