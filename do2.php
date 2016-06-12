<?php

ini_set('session.gc_maxlifetime', 30*24*3600);
ini_set('session.use_cookies',1);

session_start();

if(empty($_SESSION["ref"]))
    $_SESSION["ref"] = "user.php";

$postData = $_REQUEST["LoginForm"];
if(!empty($postData)){
    try{

        $client = new SoapClient("http://oa2.da-mai.com/obpm/services/UserService?wsdl");

        $res = $client->validateUser("广州大麦信息科技有限公司",$postData["username"],$postData["password"],0);

        if(!empty($res)){
            $expire = time() + 30*24*3600;
            $res = json_decode(json_encode($res),true);
            $_SESSION["user"] = array_merge($res,array("username"=>$res["name"]));

            @setcookie("loginToken",$res["id"],$expire,"/",".login.da-mai.com");

            @header("Location:".$_SESSION["ref"]);
        }else{
            @header("Location:index.php?ref=".$_SESSION["ref"]."&retry=true");
        }
    }catch(SOAPFault $e){
        @header("Location:index.php?ref=".$_SESSION["ref"]."&retry=true");
    }

}else{
    @header("Location:index.php?ref=".$_SESSION["ref"]."&retry=true");
}

