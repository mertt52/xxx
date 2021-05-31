<?php
$nick=$_GET['nick'];
$session="47906786420%3A8bRnA1MXS1uHkg%3A3"; //buraya cookieeditor'den aldıgınız sessionid'i yazın.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.instagram.com/'.$nick.'/?__a=1'); ////This may differ from site to site
//curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Accept-Language: en-US,en;q=0.9',
'Cookie: sessionid='.$session.'',
'Referer: https://www.instagram.com/'.$nick.'/',
'sec-fetch-dest: document',
'sec-fetch-mode: navigate',
'sec-fetch-site: same-origin',
'sec-fetch-user: ?1',
'user-agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$json = json_decode($result, true);
$mavi = $json['graphql']['user']['is_verified'];
$tt=$json['graphql']['user']['edge_followed_by']['count'];
$resim = $json['graphql']['user']['profile_pic_url_hd'];
$img_file = $resim;
$imgData = base64_encode(file_get_contents($img_file));
//data:{mime};base64,{data};
$resim = 'data:image/png;base64,'.$imgData;
$bio=$json['graphql']['user']['biography'];
$marks = array(
"bio"=>$bio, 
"pp"=>$resim,
"mavi"=>$mavi,
"followers"=>$tt,);
json_encode($marks);
?>
