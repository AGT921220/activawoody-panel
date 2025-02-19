<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

error_reporting(0);
$db = new SQLite3("./data/.boxbr_info.db");
if (isset($_GET["username"])) {
    $username = $_GET["username"];
    $password = $_GET["password"];
} else {
    if (isset($_POST["username"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
    }
}
$res = $db->query("SELECT * FROM dns");
$rowss = [];
while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
    $rowss[] = $row["url"];
}
foreach ($rowss as $dns) {
    $api_link = $dns . "/player_api.php?username=" . $username . "&password=" . $password;
    $api_req = _obfuscated_0D053E11053C0B3E1324222E2C280F03030A210C150532_($api_link);
    $result = $api_req;
    if ($result["result"] == "success") {
        if (isset($result["data"]->user_info->auth) && $result["data"]->user_info->auth != 0 && $result["data"]->user_info->status == "Active") {
            $dns = $value;
            header("Location: " . $api_link);
        }
    } else {
        echo "Go Funk you....";
    }
}
function _obfuscated_0D053E11053C0B3E1324222E2C280F03030A210C150532_($api_link)
{
    $_obfuscated_0D2837151E06183D35160236032D12061B3F35352E2B22_ = "0";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_link);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $result = json_decode(curl_exec($ch));
    if (!empty($result)) {
        $_obfuscated_0D17220F182911262A14152933105C0F2223033F251E32_ = $result;
        return ["result" => "success", "data" => $_obfuscated_0D17220F182911262A14152933105C0F2223033F251E32_];
    }
}

?>