<?php
/**
 * 根据token获取用户信息
 * */
function GetUserByToken($token){
    return $token;
}

ini_set('session.gc_maxlifetime', 30*24*3600);
ini_set('session.use_cookies',1);

session_start();

$callback = $_REQUEST["callbackparam"];
if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
    echo $callback."(".json_encode(array("islogin"=>true,'data'=>$_SESSION["user"])).")";
}else if(isset($_COOKIE["loginToken"])){
    $res = GetUserByToken($_COOKIE["loginToken"]);
    if(!empty($res)){
        $res = json_decode(json_encode($res),true);
        $_SESSION["user"] = array_merge($res,array("username"=>$res["name"]));
        echo $callback."(".json_encode(array("islogin"=>true,'data'=>$_SESSION["user"])).")";
    }else{
        echo $callback."(".json_encode(array("islogin"=>false)).")";
    }
}else{
    echo $callback."(".json_encode(array("islogin"=>false)).")";
}
