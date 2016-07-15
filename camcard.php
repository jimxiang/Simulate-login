<?php

$cookie_file = "temp.cookie";
$login_url = "https://www.camcard.com/user/login";
$load_url = "https://www.camcard.com/stat/load";
$personalcard_url = "https://www.camcard.com/card/personalcard";

// 获取cookie
$ch = curl_init();
$timeout = 5;
curl_setopt_array
(
	$ch, 
	array
	(
		CURLOPT_URL => $login_url,
		CURLOPT_HEADER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_CONNECTTIMEOUT => $timeout,
        CURLOPT_COOKIEJAR => $cookie_file
	)
);
$output = curl_exec($ch);
curl_close($ch);

// 登录
$data = array
(
	"act" => "login",
	"account" => "874242816@qq.com",
	"password" => "jx19941204",
	"redirect" => "",
	"next_login" => 1,
	"YII_CSRF_TOKEN" => "c96d2686d4304fdad0fc3274a87c4e1f"
);

$ch = curl_init();
curl_setopt_array
(
	$ch, 
	array
	(
		CURLOPT_URL => $login_url,
		CURLOPT_HEADER => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_COOKIEFILE => $cookie_file,
        CURLOPT_COOKIEJAR => $cookie_file
	)
);
$output = curl_exec($ch);
curl_close($ch);

// load页面
$data = array
(
	"act" => "login",
	"account" => "874242816@qq.com",
	"password" => "jx19941204",
	"redirect" => "",
	"next_login" => 1,
	"YII_CSRF_TOKEN" => "c96d2686d4304fdad0fc3274a87c4e1f"
);

$data = array
(
	"url" => "/card/personalcard",
	"loadtime" => "0|0|726|1400",
	"loadtimejs" => "2557"
);
$ch = curl_init();
curl_setopt_array
(
	$ch, 
	array
	(
		CURLOPT_URL => $load_url,
		CURLOPT_HEADER => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_COOKIEFILE => $cookie_file,
        CURLOPT_COOKIEJAR => $cookie_file
	)
);
$output = curl_exec($ch);
curl_close($ch);

// 跳转主页
$ch = curl_init();
curl_setopt_array
(
	$ch, 
	array
	(
		CURLOPT_URL => $personalcard_url,
		CURLOPT_HEADER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_COOKIEFILE => $cookie_file
	)
);
$output = curl_exec($ch);
curl_close($ch);
echo $output;