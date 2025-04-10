<?php

//사용자 접속유형별 ip값 처리
function getUserIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//https://ipgeolocation.io/documentation/ip-geolocation-api-php-sdk.html
    $apiKey = "PUT YOUR API KEY";
    $ip = getUserIpAddr();
    $location = get_geolocation($apiKey, $ip);
    $decodedLocation = json_decode($location, true);

    /*//json data//
    echo "<pre>";
    print_r($decodedLocation);
    echo "</pre>";
    //json data//*/

    function get_geolocation($apiKey, $ip, $lang = "en", $fields = "*", $excludes = "") {
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip."&lang=".$lang."&fields=".$fields."&excludes=".$excludes;
        $cURL = curl_init();

        curl_setopt($cURL, CURLOPT_URL, $url);
        curl_setopt($cURL, CURLOPT_HTTPGET, true);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'User-Agent: '.$_SERVER['HTTP_USER_AGENT']
        ));

        return curl_exec($cURL);
    }

?>


<!--html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>


<!--테이블-->
<body>
<div class="table-title">
<h3>User-Agent Check</h3>
</div>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Attribute</th>
<th class="text-left">Value</th>
</tr>
</thead>
<tbody class="table-hover">
<tr>
<td class="text-left">Ip</td>
<td class="text-left"><?php echo $decodedLocation['ip']?></td>
</tr>
<tr>
<td class="text-left">Continent_name</td>

<!-- 한줄에 문자열을 포함하여 여러 데이터를 출력할시 변수 리스트 뒤에 .으로 구분기호 넣어주면됨-->
<td class="text-left"><?php echo $decodedLocation['continent_name'].'('. $decodedLocation['continent_code']. ")" ?></td>
</tr>
<tr>
<td class="text-left">Count_code2</td>
<td class="text-left"><?php echo $decodedLocation['country_code2']?></td>
</tr>
<tr>
<td class="text-left">Country_code3</td>
<td class="text-left"><?php echo $decodedLocation['country_code3']?></td>
</tr>
<tr>
<td class="text-left">Country_name</td>
<td class="text-left"><?php echo $decodedLocation['country_name']?></td>
</tr>
<tr>
<td class="text-left">City</td>
<td class="text-left"><?php echo $decodedLocation['city']?></td>
</tr>
<tr>
<td class="text-left">Zipcode</td>
<td class="text-left"><?php echo $decodedLocation['zipcode']?></td>
</tr>
<tr>
<td class="text-left">Latitude</td>
<td class="text-left"><?php echo $decodedLocation['latitude']?></td>
</tr>
<tr>
<td class="text-left">Longitudey</td>
<td class="text-left"><?php echo $decodedLocation['longitude']?></td>
</tr>
<tr>
<td class="text-left">Calling_code</td>
<td class="text-left"><?php echo $decodedLocation['calling_code']?></td>
</tr>
<tr>
<td class="text-left">Languagese</td>
<td class="text-left"><?php echo $decodedLocation['languages']?></td>
</tr>
<tr>
<td class="text-left">Calling_code</td>
<td class="text-left"><img src="<?php echo $decodedLocation['country_flag']?>" alt=""></td>
</tr>
<tr>
<td class="text-left">Isp</td>
<td class="text-left"><?php echo $decodedLocation['isp']?></td>
</tr>
<tr>
<td class="text-left">time_zone</td>
<td class="text-left"><?php echo $decodedLocation['time_zone']['name']?></td>
</tr>
</tbody>
</table>
  
</body>
</html>