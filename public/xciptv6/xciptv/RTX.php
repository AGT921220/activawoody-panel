<?php
ini_set("display_errors", 0);
error_reporting(0);
$functionsFile = "../includes/functions.php";
include($functionsFile);
$xciptvInfo = loadXCIPTVOptions();
$allDns = array();
if ($xciptvInfo['proxy_traffic'] == 1  || $xciptvInfo['proxy_traffic'] == 2) {
    $subfolder = "proxy";
    $dns1 = $GLOBALS['panelroot'] . $subfolder .  "";
    $name1 = "IPTV";
    $dnsArray = array();
    $dnsArray['DNSName'] = $name1;
    $dnsArray['DNSUrl'] = $dns1;
    $allDns[] = $dnsArray;
} else {
    $dnsInfo = loadAllDNS(true);
    foreach ($dnsInfo as $dns) {
        $dnsArray = array();
        $dnsArray['DNSName'] = $dns['name'];
        $dnsArray['DNSUrl'] =  $dns['portal'];
        $allDns[] = $dnsArray;
    }
}
$response = json_encode($allDns);
echo base64_encode($response);