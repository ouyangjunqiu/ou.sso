<?php

ini_set('session.gc_maxlifetime', 30*24*3600);
ini_set('session.use_cookies',1);

session_start();

$postData = $_REQUEST["LoginForm"];

$con = mysql_connect("10.132.161.32","mysql.da-mai.com","mysql@da-mai.com");
mysql_select_db("obpm",$con);
mysql_query("SET NAMES UTF8",$con);
$sql = "select * from t_user where `NAME`='{$postData["username"]}'";
$rs = mysql_query($sql,$con);

$row = mysql_fetch_assoc($rs);
if(!empty($row) && $row["EMAIL"] == ($postData["email"])){
    $expire = time() + 30*24*3600;
    $_SESSION["user"] = array_merge($row,array("username"=>$row["NAME"]));
    if(empty($_SESSION["ref"]))
        $_SESSION["ref"] = "user.php";
    setcookie("username",$row["NAME"],$expire,"/",".login.da-mai.com");
    header("Location:".$_SESSION["ref"]);
}else{
    header("Location:index.php?ref=".$_SESSION["ref"]."&retry=true");
}


