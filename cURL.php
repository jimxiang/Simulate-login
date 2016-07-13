<?php
$cookie_file = "tmp.cookie";
$login_url = "http://xuanke.tongji.edu.cn/";
$verify_code_url = "xuanke.tongji.edu.cn/CheckImage";
$post_url = "http://tjis2.tongji.edu.cn:58080/amserver/UI/Login";

// 获取cookie
$curl = curl_init();
$timeout = 5;
curl_setopt_array
(
    $curl,
    array
    (
        CURLOPT_URL => $login_url,
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => $timeout,
        CURLOPT_COOKIESESSION => true,
        CURLOPT_COOKIEJAR => $cookie_file
    )
);
$output = curl_exec($curl);
curl_close($curl);

// 获取验证码
$curl = curl_init();
curl_setopt_array
(
    $curl,
    array
    (
        CURLOPT_URL => $verify_code_url,
        CURLOPT_COOKIEFILE => $cookie_file,
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true
    )
);
$img = curl_exec($curl);
curl_close($curl);

$fp = fopen("verifyCode.jpg", "w");
fwrite($fp, $img);
fclose($fp);
sleep(20);

// 更新cookie
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
$output = curl_exec($curl);
curl_close($curl);

// 登录
$code = file_get_contents("code.txt");
$data = array(
   "goto" => "http://xuanke.tongji.edu.cn/pass.jsp?checkCode=" .$code,
   "gotoOnFail" => "http://xuanke.tongji.edu.cn/deny.jsp?checkCode=" .$code ."&account=1352825&password=464540F8E7A7A85EC4F0CF4F378CABC2",
   "Login.Token1" => "1352825",
   "Login.Token2" => "204151",
   "T3" => $code
);

$curl = curl_init();
curl_setopt_array
(
   $curl,
   array
   (
       CURLOPT_URL => $post_url,
       CURLOPT_POST => true,
       CURLOPT_HEADER => true,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_POSTFIELDS => $data,
       CURLOPT_COOKIEFILE => $cookie_file,
       CURLOPT_COOKIESESSION => true,
       CURLOPT_COOKIEJAR => "new_tmp.cookie",
   )
);
$result = curl_exec($curl);
curl_close($curl);
print_r($result);

// $curl = curl_init();
// curl_setopt_array
// (
//     $curl,
//     array
//     (
//         CURLOPT_URL => "http://xuanke.tongji.edu.cn/pass.jsp?checkCode=" .$code,
//         CURLOPT_HEADER => true,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_COOKIEFILE => $cookie_file,
//         CURLOPT_COOKIESESSION => true,
//         CURLOPT_COOKIEJAR => "new_tmp.cookie"
//     )
// );
// $result = curl_exec($curl);
// curl_close($curl);
// print_r($result);

// $curl = curl_init();
// curl_setopt_array
// (
//     $curl,
//     array
//     (
//         CURLOPT_URL => "http://xuanke.tongji.edu.cn/tj_login/frame.jsp",
//         CURLOPT_HEADER => true,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_COOKIEFILE => "new_tmp.cookie"
//     )
// );
// $result = curl_exec($curl);
// curl_close($curl);
// print_r($result);
