<?php
ini_set("display_errors", 0);
error_reporting(0);

$functionsFile = "../includes/functions.php";
include($functionsFile);
$xciptvInfo = loadXCIPTVOptions();
$Tag = $_GET['tag'];
$Nai = $_GET['naI'];
$UserID = $_GET['userid'];
$cid = $_GET['cid'];
$aid = $_GET['aid'];
$l = $_GET['l'];
$an = $_GET['an'];
$el = $_GET['el'];
$ea = $_GET['ea'];
$eb = $_GET['eb'];
$key = str_replace(" ", "", $an . $xciptvInfo['app_identifier']);
if (isset($_GET['tag'])) {
  if ($Tag == "licV3") {
    echo bin2hex(openssl_encrypt(buildV3String(), "AES-128-CBC", $xciptvInfo['licv3_key'], OPENSSL_RAW_DATA, $xciptvInfo['licv3_iv']));
  }
  if ($Tag == "licV4") {
    echo json_encode(json_decode(buildV4String()));
  }
  if ($Tag == "ann") {

    echo buildAnnouncementString();
  }
  if ($Tag == "man") {
    echo file_get_contents("./" . $Tag . ".json");
  }
  if ($Tag == "conn" || $Tag == "msg_conf") {
    echo '{"tag":"' . $Tag . '","success":"1","api_ver":"1.0v"}';
  }
  if ($Tag == "whatsup") {
    echo '{"tag":"whatsup","success":"0","api_ver":"1.0v","whatsup":"No"}';
  }
  if ($Tag == "gfilter") {
    echo '{"tag":"gfilter_n","success":"1","api_ver":"1.0v","status":"No","filter":[]}';
  }

  if ($Tag == "msg_cat_view" || $Tag == "msg") {
    echo '{"tag":"' . $Tag . '","success":"0","api_ver":"1.0v","message":"No Messages"}';
  }
  if ($Tag == "connv2") {
    echo buildConnV2String();
  }
  if ($Tag == "vpnconfigV2") {
    $allVpn = loadAllVpn(true);
    foreach ($allVpn as $thisVpn) {
      $vpnPath = $thisVpn['path'];
      if (strpos($thisVpn['path'], "http") === false) {
        $vpnPath =  $GLOBALS['panelroot'] . "ovpn-files/" . $thisVpn['path'];
      }
      $dataA[] = array(
        "id" => $thisVpn['id'],
        "userid" => $xciptvInfo['app_identifier'],
        "vpn_appid" => $xciptvInfo['app_identifier'],
        "vpn_country" => $thisVpn['country'],
        "vpn_state" => $thisVpn['location'],
        "vpn_config" => $vpnPath,
        "vpn_status" => "ACTIVE",
        "auth_type" => $thisVpn['auth_type'],
        "auth_embedded" => $thisVpn['auth_embedded'] ? "YES" : "NO",
        "username" => $thisVpn['username'],
        "password" => $thisVpn['password'],
        "date" => "2025-11-03 03:43:59"
      );
    }
    $jdata = json_encode($dataA);
    $output = "{\"tag\": \"vpnconfigV2\",\"success\": \"1\",\"api_ver\": \"1.0v\",\"vpnconfigs\": {$jdata}}";
    echo bin2hex(openssl_encrypt($output, "AES-128-CBC", $xciptvInfo['licv3_key'], OPENSSL_RAW_DATA, $xciptvInfo['licv3_iv']));
  }
} else {
}
function buildV3String()
{
  global $xciptvInfo;

  $returnable = '{
    "tag": "licV3",
    "success": "1",
    "api_ver": "2.0v",
    "which": "licV3",
    "app": {
        "id": "10",
        "appname": "' . $xciptvInfo['app_name'] . '",
        "customerid": "' . $xciptvInfo['app_identifier'] . '",
        "expire": "LIFETIME",
        "version_code": "' . $xciptvInfo['app_build'] . '",
        "login_type": "' . $xciptvInfo['login_type'] . '",
        ' . buildPortalLinks() . '
        "apkurl": "",
        "backupurl": "",
        "logurl": "",
        "apkautoupdate": "no",
        "support_email": "' . $xciptvInfo['support_email'] . '",
        "support_phone": "' . $xciptvInfo['support_phone'] . '",
        "status": "ACTIVE",
        "filter_status": "No",
        "epg_mode": "yes",
        "btn_live": "' . ($xciptvInfo['show_live'] ? "Yes" : "No") . '",
        "btn_live2": "' . ($xciptvInfo['show_live2'] ? "Yes" : "No") . '",
        "btn_live3": "' . ($xciptvInfo['show_live3'] ? "Yes" : "No") . '",
        "btn_live4": "' . ($xciptvInfo['show_live4'] ? "Yes" : "No") . '",
        "btn_live5": "' . ($xciptvInfo['show_live5'] ? "Yes" : "No") . '",
        "btn_vod": "' . ($xciptvInfo['show_vod'] ? "Yes" : "No") . '",
        "btn_vod2": "' . ($xciptvInfo['show_vod2'] ? "Yes" : "No") . '",
        "btn_vod3": "' . ($xciptvInfo['show_vod3'] ? "Yes" : "No") . '",
        "btn_vod4": "' . ($xciptvInfo['show_vod4'] ? "Yes" : "No") . '",
        "btn_vod5": "' . ($xciptvInfo['show_vod5'] ? "Yes" : "No") . '",
        "btn_epg": "' . ($xciptvInfo['show_epg'] ? "Yes" : "No") . '",
        "btn_epg2": "' . ($xciptvInfo['show_epg2'] ? "Yes" : "No") . '",
        "btn_epg3": "' . ($xciptvInfo['show_epg3'] ? "Yes" : "No") . '",
        "btn_epg4": "' . ($xciptvInfo['show_epg4'] ? "Yes" : "No") . '",
        "btn_epg5": "' . ($xciptvInfo['show_epg5'] ? "Yes" : "No") . '",
        "btn_series": "' . ($xciptvInfo['show_series'] ? "Yes" : "No") . '",
        "btn_series2": "' . ($xciptvInfo['show_series2'] ? "Yes" : "No") . '",
        "btn_series3": "' . ($xciptvInfo['show_series3'] ? "Yes" : "No") . '",
        "btn_series4": "' . ($xciptvInfo['show_series4'] ? "Yes" : "No") . '",
        "btn_series5": "' . ($xciptvInfo['show_series5'] ? "Yes" : "No") . '",
        "btn_radio": "' . ($xciptvInfo['show_radio'] ? "Yes" : "No") . '",
        "btn_radio2": "' . ($xciptvInfo['show_radio2'] ? "Yes" : "No") . '",
        "btn_radio3": "' . ($xciptvInfo['show_radio3'] ? "Yes" : "No") . '",
        "btn_radio4": "' . ($xciptvInfo['show_radio4'] ? "Yes" : "No") . '",
        "btn_radio5": "' . ($xciptvInfo['show_radio5'] ? "Yes" : "No") . '",
        "btn_catchup": "' . ($xciptvInfo['show_catchup'] ? "Yes" : "No") . '",
        "btn_catchup2": "' . ($xciptvInfo['show_catchup2'] ? "Yes" : "No") . '",
        "btn_catchup3": "' . ($xciptvInfo['show_catchup3'] ? "Yes" : "No") . '",
        "btn_catchup4": "' . ($xciptvInfo['show_catchup4'] ? "Yes" : "No") . '",
        "btn_catchup5": "' . ($xciptvInfo['show_catchup5'] ? "Yes" : "No") . '",
        "btn_account": "' . ($xciptvInfo['show_account'] ? "yes" : "no") . '",
        "btn_account2": "' . ($xciptvInfo['show_account2'] ? "yes" : "no") . '",
        "btn_account3": "' . ($xciptvInfo['show_account3'] ? "yes" : "no") . '",
        "btn_account4": "' . ($xciptvInfo['show_account4'] ? "yes" : "no") . '",
        "btn_account5": "' . ($xciptvInfo['show_account5'] ? "yes" : "no") . '",
        "btn_pr": "' . ($xciptvInfo['show_reminders'] ? "yes" : "no") . '",
        "btn_rec": "' . ($xciptvInfo['show_record'] ? "yes" : "no") . '",
        "btn_vpn": "' . ($xciptvInfo['show_vpn'] ? "yes" : "no") . '",
        "btn_noti": "' . ($xciptvInfo['show_message'] ? "yes" : "no") . '",
        "btn_update": "' . ($xciptvInfo['show_update'] ? "yes" : "no") . '",
        "btn_login_settings": "' . ($xciptvInfo['log_settings_button'] ? "yes" : "no") . '",
        "btn_login_account": "' . ($xciptvInfo['login_accounts_button'] ? "yes" : "no") . '",
        "show_expire": "' . ($xciptvInfo['show_expiry'] ? "yes" : "no") . '",
        "agent": "' . ($xciptvInfo['user_agent'] ? $xciptvInfo['user_agent'] : "no") . '",
        "all_cat": "yes",
        "theme": "' . $xciptvInfo['theme'] . '",
        "stream_type": "ts",
        "player": "' . ($xciptvInfo['player_live']) . '",
        "player_tv": "' . ($xciptvInfo['player_epg'])  . '",
        "player_vod": "' . ($xciptvInfo['player_vod']) . '",
        "player_series": "' . ($xciptvInfo['player_series']) . '",
        "player_catchup": "' . ($xciptvInfo['player_live']) . '",
        "whichplayer": "' . ($xciptvInfo['player_live']) . '",
        "whichplayer_tv": "' . ($xciptvInfo['player_epg'])  . '",
        "whichplayer_vod": "' . ($xciptvInfo['player_vod']) . '",
        "whichplayer_series": "' . ($xciptvInfo['player_series']) . '",
        "whichplayer_catchup": "' . ($xciptvInfo['player_live']) . '",
        "message_enabled": "' . ($xciptvInfo['messages'] ? "yes" : "no") . '",
        "announcement_enabled": "' . ($xciptvInfo['announcements'] ? "yes" : "no") . '",
        "updateuserinfo_enabled": "' . ($xciptvInfo['update_user_info'] ? "yes" : "no") . '",
        "whatsupcheck_enabled": "no",
        "login_logo": "' . ($xciptvInfo['login_logo'] ? "yes" : "no") . '",
        "ms": "' . ($xciptvInfo['show_multi'] ? "yes" : "no") . '",
        "ms2": "' . ($xciptvInfo['show_multi2'] ? "yes" : "no") . '",
        "ms3": "' . ($xciptvInfo['show_multi3'] ? "yes" : "no") . '",
        "ms4": "' . ($xciptvInfo['show_multi4'] ? "yes" : "no") . '",
        "ms5": "' . ($xciptvInfo['show_multi5'] ? "yes" : "no") . '",
        "btn_fav": "' . ($xciptvInfo['show_favorite'] ? "yes" : "no") . '",
        "btn_fav2": "' . ($xciptvInfo['show_favorite2'] ? "yes" : "no") . '",
        "btn_fav3": "' . ($xciptvInfo['show_favorite3'] ? "yes" : "no") . '",
        "btn_fav4": "' . ($xciptvInfo['show_favorite4'] ? "yes" : "no") . '",
        "btn_fav5": "' . ($xciptvInfo['show_favorite5'] ? "yes" : "no") . '",
        "btn_signup": "' . ($xciptvInfo['signup_url'] ? $xciptvInfo['signup_url'] : "no") . '",
        "bjob": "no",
        "settings_app": "yes",
        "settings_account": "yes",
        "logs": "' . ($xciptvInfo['app_logs'] ? "yes" : "no") . '",
        "panel": "xtreamcodes",
        "epg_url": "no",
        "ovpn_url": "no",
        "app_language": "' . ($xciptvInfo['app_language']) . '",
        "load_last_channel": "' . ($xciptvInfo['load_last_channel'] ? "yes" : "no") . '",
        "admob_banner_id": "no",
        "admob_interstitial_id": "no",
        "show_cat_count": "' . ($xciptvInfo['category_count'] ? "yes" : "no") . '",
        "activation_url": "no",
        "mnt_message": "Maintenance Message1",
        "mnt_status": "INACTIVE",
        "mnt_expire": "2019-05-31 23:59:00",
        "signup_url": "",
        "language": "' . ($xciptvInfo['app_language']) . '",
        "EXO": "EXO",
        "VLC": "VLC",
        "send_udid": "no",
        "ort_settings": 
        {
          "exo_hw": "' . ($xciptvInfo['exo_hw'] ? "yes" : "no") . '",
          "vlc_hw": "' . ($xciptvInfo['vlc_hw'] ? "yes" : "no") . '",
          "last_volume_exo": "' . ($xciptvInfo['exo_volume']) . '",
          "last_volume_vlc": "' . ($xciptvInfo['vlc_volume']) . '",
          "plyer_exo_buffer": "' . ($xciptvInfo['exo_buffer']) . '",
          "plyer_vlc_buffer": "' . ($xciptvInfo['vlc_buffer']) . '",
          "video_resize_exo": "' . ($xciptvInfo['exo_zoom']) . '",
          "video_resize_vlc": "' . ($xciptvInfo['vlc_zoom']) . '",
          "video_subtiltes_exo": "' . ($xciptvInfo['exo_subtitles'] ? "yes" : "no") . '",
          "video_subtiltes_vlc": "' . ($xciptvInfo['vlc_subtitles'] ? "yes" : "no") . '"
          },
        "vastconfig": null,
        "admobconfig": null
    }
}';
  return $returnable;
}
function buildV4App()
{
  global $xciptvInfo;
  $returnable = '{
    "id": "2178",
	"appname": "' . $xciptvInfo['app_name'] . '",
	"customerid": "' . $xciptvInfo['app_identifier'] . '",
	"expire": "LIFETIME",
	"version_code": "805",
	"login_type": "' . $xciptvInfo['login_type'] . '",
    "filter_status": "No",
    "epg_mode": "yes",
    "apkautoupdate": "no",
    "show_expire": "' . ($xciptvInfo['show_expiry'] ? "yes" : "no") . '"
  }';
  return $returnable;
}
function buildV4Portal()
{
  $returnable = '{
    ' . buildPortalLinks() . '
    "panel": "xtreamcodes"
  }';
  return $returnable;
}

function buildPortalLinks()
{
  global $xciptvInfo;
  $dns1 = '0';
  $dns2 = '0';
  $dns3 = '0';
  $dns4 = '0';
  $dns5 = '0';
  $name1 = '0';
  $name2 = '0';
  $name3 = '0';
  $name4 = '0';
  $name5 = '0';
  if ($xciptvInfo['proxy_traffic'] == 1  || $xciptvInfo['proxy_traffic'] == 2) {
    $subfolder = "proxy";
    $dns1 = $GLOBALS['panelroot'] . $subfolder .  "";
    $name1 = "IPTV";
  } else {
    $dnsInfo = loadAllDNS(true);
    foreach ($dnsInfo as $dns) {
      if ($dns1 == "0") {
        $dns1 = $dns['portal'];
        $name1 = $dns['name'];
      } else if ($dns2 == "0") {
        $dns2 = $dns['portal'];
        $name2 = $dns['name'];
      } else if ($dns3 == "0") {
        $dns3 = $dns['portal'];
        $name3 = $dns['name'];
      } else if ($dns4 == "0") {
        $dns4 = $dns['portal'];
        $name4 = $dns['name'];
      } else if ($dns5 == "0") {
        $dns5 = $dns['portal'];
        $name5 = $dns['name'];
      } else {
        //already filled all 5 spaces.
      }
    }
  }

  $returnable = '"portal": "' .  $dns1 . '",
    "portal2": "' .  $dns2 . '",
    "portal3": "' .  $dns3 . '",
    "portal4": "' .  $dns4 . '",
    "portal5": "' .  $dns5 . '",
    "portal_name": "' . $name1 . '",
    "portal2_name": "' . $name2 . '",
    "portal3_name": "' . $name3 . '",
    "portal4_name": "' . $name4 . '",
    "portal5_name": "' . $name5 . '",
    "portal_vod": "no",
    "portal_series": "no",';
  return  $returnable;
}
function buildV4URL()
{
  global $xciptvInfo;
  $returnable = '{
		"apkurl": "no",
		"backupurl": "' . $GLOBALS['panelroot'] . 'xciptv/",
		"logurl": "' . $GLOBALS['panelroot'] . 'xciptv/",
		"activation_url": "' . $GLOBALS['panelroot'] . 'xciptv/",
		"socket_url": "no",
		"epg_url": "no",
		"ovpn_url": "yes"
	}';
  return $returnable;
}
function buildV4Buttons()
{
  global $xciptvInfo;
  $returnable = '{
    "btn_live": "' . ($xciptvInfo["show_live"] ? "Yes" : "No") . '",
    "btn_live2": "' . ($xciptvInfo["show_live2"] ? "Yes" : "No") . '",
    "btn_live3": "' . ($xciptvInfo["show_live3"] ? "Yes" : "No") . '",
    "btn_live4": "' . ($xciptvInfo["show_live4"] ? "Yes" : "No") . '",
    "btn_live5": "' . ($xciptvInfo["show_live5"] ? "Yes" : "No") . '",
    "btn_vod": "' . ($xciptvInfo["show_vod"] ? "Yes" : "No") . '",
    "btn_vod2": "' . ($xciptvInfo["show_vod2"] ? "Yes" : "No") . '",
    "btn_vod3": "' . ($xciptvInfo["show_vod3"] ? "Yes" : "No") . '",
    "btn_vod4": "' . ($xciptvInfo["show_vod4"] ? "Yes" : "No") . '",
    "btn_vod5": "' . ($xciptvInfo["show_vod5"] ? "Yes" : "No") . '",
    "btn_epg": "' . ($xciptvInfo["show_epg"] ? "Yes" : "No") . '",
    "btn_epg2": "' . ($xciptvInfo["show_epg2"] ? "Yes" : "No") . '",
    "btn_epg3": "' . ($xciptvInfo["show_epg3"] ? "Yes" : "No") . '",
    "btn_epg4": "' . ($xciptvInfo["show_epg4"] ? "Yes" : "No") . '",
    "btn_epg5": "' . ($xciptvInfo["show_epg5"] ? "Yes" : "No") . '",
    "btn_series": "' . ($xciptvInfo["show_series"] ? "Yes" : "No") . '",
    "btn_series2": "' . ($xciptvInfo["show_series2"] ? "Yes" : "No") . '",
    "btn_series3": "' . ($xciptvInfo["show_series3"] ? "Yes" : "No") . '",
    "btn_series4": "' . ($xciptvInfo["show_series4"] ? "Yes" : "No") . '",
    "btn_series5": "' . ($xciptvInfo["show_series5"] ? "Yes" : "No") . '",
    "btn_radio": "' . ($xciptvInfo["show_radio"] ? "Yes" : "No") . '",
    "btn_radio2": "' . ($xciptvInfo["show_radio2"] ? "Yes" : "No") . '",
    "btn_radio3": "' . ($xciptvInfo["show_radio3"] ? "Yes" : "No") . '",
    "btn_radio4": "' . ($xciptvInfo["show_radio4"] ? "Yes" : "No") . '",
    "btn_radio5": "' . ($xciptvInfo["show_radio5"] ? "Yes" : "No") . '",
    "btn_catchup": "' . ($xciptvInfo["show_catchup"] ? "Yes" : "No") . '",
    "btn_catchup2": "' . ($xciptvInfo["show_catchup2"] ? "Yes" : "No") . '",
    "btn_catchup3": "' . ($xciptvInfo["show_catchup3"] ? "Yes" : "No") . '",
    "btn_catchup4": "' . ($xciptvInfo["show_catchup4"] ? "Yes" : "No") . '",
    "btn_catchup5": "' . ($xciptvInfo["show_catchup5"] ? "Yes" : "No") . '",
    "btn_account": "' . ($xciptvInfo['show_account'] ? "yes" : "no") . '",
    "btn_account2": "' . ($xciptvInfo['show_account2'] ? "yes" : "no") . '",
    "btn_account3": "' . ($xciptvInfo['show_account3'] ? "yes" : "no") . '",
    "btn_account4": "' . ($xciptvInfo['show_account4'] ? "yes" : "no") . '",
    "btn_account5": "' . ($xciptvInfo['show_account5'] ? "yes" : "no") . '",
    "btn_pr": "' . ($xciptvInfo['show_reminders'] ? "yes" : "no") . '",
    "btn_rec": "' . ($xciptvInfo['show_record'] ? "yes" : "no") . '",
    "btn_vpn": "' . ($xciptvInfo['show_vpn'] ? "yes" : "no") . '",
	  "btn_noti": "' . ($xciptvInfo['show_message'] ? "yes" : "no") . '",
    "btn_update": "' . ($xciptvInfo['show_update'] ? "yes" : "no") . '",
	  "btn_login_settings": "' . ($xciptvInfo['log_settings_button'] ? "yes" : "no") . '",
	  "btn_login_account": "' . ($xciptvInfo['login_accounts_button'] ? "yes" : "no") . '",
    "btn_fav": "' . ($xciptvInfo['show_favorite'] ? "yes" : "no") . '",
    "btn_fav2": "' . ($xciptvInfo['show_favorite'] ? "yes" : "no") . '",
    "btn_fav3": "' . ($xciptvInfo['show_favorite'] ? "yes" : "no") . '",
    "btn_signup": "no",
    "ms": "' . ($xciptvInfo['show_multi'] ? "yes" : "no") . '",
    "ms2": "' . ($xciptvInfo['show_multi2'] ? "yes" : "no") . '",
    "ms3": "' . ($xciptvInfo['show_multi3'] ? "yes" : "no") . '",
    "ms4": "' . ($xciptvInfo['show_multi4'] ? "yes" : "no") . '",
    "ms5": "' . ($xciptvInfo['show_multi5'] ? "yes" : "no") . '"
  }';
  return $returnable;
}
function buildV4Settings()
{
  global $xciptvInfo;
  $returnable = '{
    "agent": "' . ($xciptvInfo['user_agent'] ? $xciptvInfo['user_agent'] : "no") . '",
    "all_cat": "yes",
    "message_enabled": "' . ($xciptvInfo['messages'] ? "yes" : "no") . '",
    "announcement_enabled": "' . ($xciptvInfo['announcements'] ? "yes" : "no") . '",
    "updateuserinfo_enabled": "' . ($xciptvInfo['update_user_info'] ? "yes" : "no") . '",
    "whatsupcheck_enabled": "no",
    "login_logo": "' . ($xciptvInfo['login_logo'] ? "yes" : "no") . '",
    "bjob": "no",
    "settings_app": "yes",
    "settings_account": "no",
    "logs": "' . ($xciptvInfo['app_logs'] ? "yes" : "no") . '",
    "app_language": "' . ($xciptvInfo['app_language']) . '",
    "load_last_channel": "' . ($xciptvInfo['load_last_channel'] ? "yes" : "no") . '",
    "admob_banner_id": "no",
    "admob_interstitial_id": "no",
    "show_cat_count": "' . ($xciptvInfo['category_count'] ? "yes" : "no") . '",
    "send_udid": "no",
    "theme": "' . $xciptvInfo['theme'] . '",
    "vpn_login_view": "' . ($xciptvInfo['show_vpn'] ? "yes" : "no") . '"
  }';
  return $returnable;
}
function buildV4String()
{
  global $xciptvInfo;
  global $key;
  $returnable = '{
	  "success": "1",
	  "status": "ACTIVE",
	  "cid": "' . $xciptvInfo['app_identifier'] . '",
	  "which": "licV4",
	  "app": "' . base64_encode(endecode(buildV4App(), $key . "app")) . '",
	  "portal": "' . base64_encode(endecode(buildV4Portal(), $key . "portal")) . '",
	  "urls": "' . base64_encode(endecode(buildV4URL(), $key . "urls")) . '",
	  "support": {
		"support_email": "' . $xciptvInfo['support_email'] . '",
		"support_phone": "' . $xciptvInfo['support_phone'] . '"
	  },
	  "button": "' . base64_encode(endecode(buildV4Buttons(), $key . "buttons")) . '",
	  "settings": "' . base64_encode(endecode(buildV4Settings(), $key . "sett")) . '",
	     "admobconfig": {
        "admob_enabled": "no"
    },
    "prebid": {
        "prebid_enabled": "no",
        "Host": "",
        "AdUnitId": "",
        "AccountId": "",
        "Banner": ""
    },
    "vastconfig": {
        "vast_enabled": "no",
        "mid_roll_interval": "",
        "post_roll_start_at": "",
        "vod_mid_roll_interval": "",
        "vod_pre_roll_url": "",
        "vod_mid_roll_url": "",
        "vod_post_roll_url": "",
        "series_mid_roll_interval": "",
        "series_pre_roll_url": "",
        "series_mid_roll_url": "",
        "series_post_roll_url": ""
    },
	  "freestar": "no",
	  "players": {
		"player": "' . $xciptvInfo['player_live'] . '",
		"player_tv": "' . $xciptvInfo['player_epg'] . '",
		"player_vod": "' . $xciptvInfo['player_vod'] . '",
		"player_series": "' . $xciptvInfo['player_series'] . '",
		"player_catchup": "' . $xciptvInfo['player_catchup'] . '",
		"stream_type": "ts"
	  },
  "ort_settings": ' . buildV4ORT() . ',
	"maintenance": {
		"mnt_message": "Our panel is under maintenance!",
		"mnt_status": "INACTIVE",
		"mnt_expire": "2023-02-01 02:10:23"
	  }
	}';
  return $returnable;
}
function buildV4ORT()
{
  global $xciptvInfo;
  global $key;
  $returnable = "";
  if ($xciptvInfo['licv4_method'] == 1) {
    $returnable = '{
		"exo_hw": "' . ($xciptvInfo['exo_hw'] ? "yes" : "no") . '",
		"vlc_hw": "' . ($xciptvInfo['vlc_hw'] ? "yes" : "no") . '",
		"last_volume_exo": "' . ($xciptvInfo['exo_volume']) . '",
		"last_volume_vlc": "' . ($xciptvInfo['vlc_volume']) . '",
		"plyer_exo_buffer": "' . ($xciptvInfo['exo_buffer']) . '",
		"plyer_vlc_buffer": "' . ($xciptvInfo['vlc_buffer']) . '",
		"video_resize_exo": "' . ($xciptvInfo['exo_zoom']) . '",
		"video_resize_vlc": "' . ($xciptvInfo['vlc_zoom']) . '",
		"video_subtiltes_exo": "' . ($xciptvInfo['exo_subtitles'] ? "yes" : "no") . '",
		"video_subtiltes_vlc": "' . ($xciptvInfo['vlc_subtitles'] ? "yes" : "no") . '"
	  }';
  } else  if ($xciptvInfo['licv4_method'] == 2) {
    $returnable = '"{\"exo_hw\": \"' . ($xciptvInfo['exo_hw'] ? "yes" : "no") . '\", \"vlc_hw\": \"' . ($xciptvInfo['vlc_hw'] ? "yes" : "no") . '\", \"last_volume_exo\": \"' . ($xciptvInfo['exo_volume']) . '\", \"last_volume_vlc\": \"' . ($xciptvInfo['vlc_volume']) . '\", \"plyer_exo_buffer\": \"' . ($xciptvInfo['exo_buffer']) . '\", \"plyer_vlc_buffer\": \"' . ($xciptvInfo['vlc_buffer']) . '\", \"video_resize_exo\": \"' . ($xciptvInfo['exo_zoom']) . '\", \"video_resize_vlc\": \"' . ($xciptvInfo['vlc_zoom']) . '\", \"video_subtiltes_exo\": \"' . ($xciptvInfo['exo_subtitles'] ? "yes" : "no") . '\", \"video_subtiltes_vlc\": \"' . ($xciptvInfo['vlc_subtitles'] ? "yes" : "no") . '\"}"';
  } else  if ($xciptvInfo['licv4_method'] == 3) {
    $returnable = '{
		"exo_hw": "' . ($xciptvInfo['exo_hw'] ? "yes" : "no") . '",
		"vlc_hw": "' . ($xciptvInfo['vlc_hw'] ? "yes" : "no") . '",
		"last_volume_exo": "' . ($xciptvInfo['exo_volume']) . '",
		"last_volume_vlc": "' . ($xciptvInfo['vlc_volume']) . '",
		"plyer_exo_buffer": "' . ($xciptvInfo['exo_buffer']) . '",
		"plyer_vlc_buffer": "' . ($xciptvInfo['vlc_buffer']) . '",
		"video_resize_exo": "' . ($xciptvInfo['exo_zoom']) . '",
		"video_resize_vlc": "' . ($xciptvInfo['vlc_zoom']) . '",
		"video_subtiltes_exo": "' . ($xciptvInfo['exo_subtitles'] ? "yes" : "no") . '",
		"video_subtiltes_vlc": "' . ($xciptvInfo['vlc_subtitles'] ? "yes" : "no") . '"
	  }';
    $returnable = '"' . base64_encode(endecode($returnable, $key . "otrsettings")) . '"';
  }
  return $returnable;
}
function buildV4StringDebug()
{
  global $xciptvInfo;
  $returnable = '{
	  "success": "1",
	  "status": "ACTIVE",
	  "cid": "' . $xciptvInfo['app_identifier'] . '",
	  "which": "licV4",
	  "app": "' . buildV4App() . '",
	  "portal": "' . buildV4Portal() . '",
	  "urls": "' . buildV4URL() . '",
	  "support": {
		"support_email": "AHX",
		"support_phone": "AHX"
	  },
	  "button": "' . buildV4Buttons() . '",
	  "settings": "' . buildV4Settings() . '",
	  "admobconfig": null,
	  "prebid": null,
	  "vastconfig": null,
	  "freestar": "no",
	  "players": {
		"player": "' . $xciptvInfo['player_live'] . '",
		"player_tv": "' . $xciptvInfo['player_epg'] . '",
		"player_vod": "' . $xciptvInfo['player_vod'] . '",
		"player_series": "' . $xciptvInfo['player_series'] . '",
		"player_catchup": "' . $xciptvInfo['player_catchup'] . '",
		"stream_type": "ts"
	  },
	  "ort_settings": {
		"exo_hw": "' . ($xciptvInfo['exo_hw'] ? "Yes" : "No") . '",
		"vlc_hw": "' . ($xciptvInfo['vlc_hw'] ? "Yes" : "No") . '",
		"last_volume_exo": "' . ($xciptvInfo['exo_volume']) . '",
		"last_volume_vlc": "' . ($xciptvInfo['vlc_volume']) . '",
		"plyer_exo_buffer": "' . ($xciptvInfo['exo_buffer']) . '",
		"plyer_vlc_buffer": "' . ($xciptvInfo['vlc_buffer']) . '",
		"video_resize_exo": "' . ($xciptvInfo['exo_zoom']) . '",
		"video_resize_vlc": "' . ($xciptvInfo['vlc_zoom']) . '",
		"video_subtiltes_exo": "' . ($xciptvInfo['exo_subtitles'] ? "Yes" : "No") . '",
		"video_subtiltes_vlc": "' . ($xciptvInfo['vlc_subtitles'] ? "Yes" : "No") . '"
	  },
	  "maintenance": {
		"mnt_message": "Our panel is under maintenance!",
		"mnt_status": "INACTIVE",
		"mnt_expire": "2023-02-01 02:10:23"
	  }
	}';
  return $returnable;
}
function buildConnV2String()
{
  $notificationInfo = loadAllNotifications(true);
  $messageInfo = loadAllMessages(true);
  if (count($notificationInfo) > 0) {
    $annText = $notificationInfo[0]['text'];
    $ann_status = "ACTIVE";
    $ann_expire = "2025-12-31 00:00:0";
    $ann_interval = "1";
    $ann_disappear = "5";
  } else {
    $annText = '';
    $ann_status = "INACTIVE";
    $ann_expire = "2025-12-31 00:00:0";
    $ann_interval = "1";
    $ann_disappear = "5";
  }
  $messageText = "";
  $mess_status = "INACTIVE";
  $messageId = 123;
  $mess_expire = "2025-12-31 00:00:0";
  foreach ($messageInfo as $message) {
    if ($message['user'] == $_GET['userid'] || !$message['user']) {
      $mess_status = "ACTIVE";
      $messageText = $message['text'];
      $messageId = $message['id'];
      break;
    }
  }

  return json_encode(['tag' => 'connv2', 'success' => '1', 'api_ver' => '1.0v', 'message' => $messageText, 'msgid' => $messageId, 'msg_status' => $mess_status, 'msg_expire' => $mess_expire, 'announcement' => $annText, 'ann_status' => $ann_status, 'ann_expire' => $ann_expire, 'ann_interval' => $ann_interval, 'ann_disappear' => $ann_disappear]);
}
function buildAnnouncementString()
{
  $announcement = NULL;
  $status = NULL;
  $channel = NULL;
  $expire = NULL;
  $interval = NULL;
  $disappear = NULL;
  $notificationInfo = loadAllNotifications(true);
  foreach ($notificationInfo as $note) {
    return json_encode(['tag' => 'ann', 'success' => '1', 'api_ver' => '1.0v', 'announcement' => $note['text'], 'status' => "ACTIVE", 'channel' => "ALL", 'expire' => "2025-12-31 00:00:0", 'interval' => 1, 'disappear' => 5]);
  }
  return json_encode(['tag' => 'ann', 'success' => '1', 'api_ver' => '1.0v', 'announcement' => $announcement, 'status' => $status, 'channel' => $channel, 'expire' => $expire, 'interval' => $interval, 'disappear' => $disappear]);
}
function endecode($string1, $string2)
{
  $returnable = "";
  for ($i = 0; $i < strlen($string1); $i++) {
    $returnable .= ($string1[$i] ^ $string2[$i % strlen($string2)]);
  }
  return $returnable;
}
