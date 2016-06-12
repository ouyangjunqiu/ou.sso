<?php
ini_set('session.gc_maxlifetime', 30*24*3600);
ini_set('session.use_cookies',1);

session_start();

$callback = $_REQUEST["callbackparam"];
if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
    echo $callback."(".json_encode(array("islogin"=>true,'data'=>$_SESSION["user"])).")";
}else if(isset($_COOKIE["loginToken"])){

    $client = new SoapClient("http://oa2.da-mai.com/obpm/services/UserService?wsdl");

    $res = $client->getUser($_COOKIE["loginToken"]);
    if(!empty($res)){
        $res = json_decode(json_encode($res),true);
        $_SESSION["user"] = array_merge($res,array("username"=>$res["name"]));
        echo $callback."(".json_encode(array("islogin"=>true,'data'=>$_SESSION["user"])).")";
    }else{
        echo $callback."(".json_encode(array("islogin"=>false)).")";
    }


}else if(isset($_COOKIE["username"])){
    $con = mysql_connect("10.132.161.32","mysql.da-mai.com","mysql@da-mai.com");
    mysql_select_db("obpm",$con);
    mysql_query("SET NAMES UTF8",$con);
    $sql = "select * from t_user where `NAME`='{$_COOKIE["username"]}'";
    $rs = mysql_query($sql,$con);
    $row = mysql_fetch_assoc($rs);
    if(isset($row) && !empty($row)){
        $_SESSION["user"] = array_merge($row,array("username"=>$row["NAME"]));
        echo $callback."(".json_encode(array("islogin"=>true,'data'=>$_SESSION["user"])).")";
    }else{
        echo $callback."(".json_encode(array("islogin"=>false)).")";
    }

}else{
    echo $callback."(".json_encode(array("islogin"=>false)).")";
}