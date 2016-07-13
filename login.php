<?php
$username = $_POST["username"];
$password = $_POST["password"];
$url = "main.html";
$res = array();
if(empty($username) || empty($password))
{
    $res = array("msg" => "用户名或密码不能为空");
}
else
{
    if($username === "admin" && $password === "admin")
    {
    	setcookie("user", "admin", time()+3600);
        $res = array("errCode" => 200, "msg" => "login success");
        echo json_encode($res);
    }
    else
    {
        $res = array("msg" => "login failure");
    }
}