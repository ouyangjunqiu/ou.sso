<?php
require_once dirname(__FILE__)."/lib/functions.php";
require_once dirname(__FILE__)."/lib/users.php";

env_init();

$ref = ref_get();
$postData = $_REQUEST["LoginForm"];   
if(!empty($postData) && login($postData["username"],$postData["password"])){
    header("Location:".$ref);
    exit;
}

header("Location:index.php?ref=".$ref."&retry=true");



