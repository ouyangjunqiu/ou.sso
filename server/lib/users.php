<?php
/**
 * @file users.php
 * @author ouyangjunqiu
 * @version Created by 16/6/13 16:51
 */

/**
 * @param $username
 * @param $password
 * @param $user
 * @return bool
 */
function LoginValidate($username,$password,&$user){
    try{

        $client = new SoapClient("http://oa2.da-mai.com/obpm/services/UserService?wsdl");

        $res = $client->validateUser("广州大麦信息科技有限公司",$username,$password,0);
        if(!empty($res)) {

            $res = json_decode(json_encode($res), true);
            $user = array_merge($res, array("username" => $res["name"]));
            return true;
        }
    }catch(SOAPFault $e){
        return false;
    }

    return false;
}

/**
 * @param $token
 * @return array|null
 */
function GetUserByToken($token){
    $client = new SoapClient("http://oa2.da-mai.com/obpm/services/UserService?wsdl");

    $res = $client->getUser($token);
    if(!empty($res)) {
        $res = json_decode(json_encode($res), true);
        return array_merge($res, array("username" => $res["name"]));
    }
    return null;
}

/**
 * @param $username
 * @param $password
 * @return bool
 */
function login($username,$password){
    if(LoginValidate($username,$password,$loginUser)) {
        $_SESSION["user"] = $loginUser;
        @setcookie("loginToken", $loginUser["id"], 30*24*3600, "/");
        return true;
    }
    return false;
}
