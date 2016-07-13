<?php
$base_url = "http://127.0.0.1/web/Simulate-login-4m3-master/";
$login_url = "login.php";
$cookie_file = "tmp.cookie";

// 登录
$curl = curl_init();
$post_data = array
(
    "username" => "admin",
    "password" => "admin"
);

curl_setopt_array
(
    $curl,
    array
    (
        CURLOPT_URL => $base_url . $login_url,
        CURLOPT_HEADER => false,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $post_data
    )
);
$result = curl_exec($curl);
curl_close($curl);
print_r($result);

// 获取cookie
$curl = curl_init();
$timeout = 5;
curl_setopt_array
(
    $curl,
    array
    (
        CURLOPT_URL => $login_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => $timeout,
        CURLOPT_COOKIESESSION => true,
        CURLOPT_COOKIEJAR => $cookie_file
    )
);
// $output = curl_exec($curl);
curl_close($curl);