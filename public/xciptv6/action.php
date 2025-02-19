<?php
ini_set("display_errors", 0);
error_reporting(0);
session_start();
require_once("includes/functions.php");

if (isset($_POST['login'])) {
	if (login($_POST['username'], $_POST['password'])) {
		$_SESSION[$authVar] = $_POST['username'];
		header("Location: index.php");
		exit;
	} else {
		$_SESSION['error'] = "Unrecognised username and password combination";
		header("Location: index.php");
		exit;
	}
}
if (!isset($_SESSION[$authVar])) {
	exit;
}
if (isset($_GET['dns-delete']) && isset($_SESSION[$authVar])) {
	deleteDNS($_GET['id']);
	header("Location: dashboard.php?dns");
	exit;
}
if (isset($_POST['adddns']) && isset($_SESSION[$authVar])) {
	addDNS($_POST['name'], $_POST['portal']);
	header("Location: dashboard.php?dns");
	exit;
}
if (isset($_POST['updatedns']) && isset($_SESSION[$authVar])) {
	$active = false;
	if ($_POST['active'] == "on") {
		$active = true;
	}
	saveDNS($_POST['id'], $_POST['name'], $_POST['portal'], $active);
	header("Location: dashboard.php?dns");
	exit;
}
if (isset($_GET['notification-delete']) && isset($_SESSION[$authVar])) {
	deleteNotification($_GET['id']);
	header("Location: dashboard.php?notifications");
	exit;
}
if (isset($_GET['message-delete']) && isset($_SESSION[$authVar])) {
	deleteMessage($_GET['id']);
	header("Location: dashboard.php?messages");
	exit;
}
if (isset($_POST['addmessage']) && isset($_SESSION[$authVar])) {
	addMessage($_POST['text'], $_POST['user']);
	header("Location: dashboard.php?messages");
	exit;
}
if (isset($_POST['updatemessage']) && isset($_SESSION[$authVar])) {
	$active = false;
	if ($_POST['active'] == "on") {
		$active = true;
	}
	saveMessage($_POST['id'], $_POST['text'], $_POST['user'], $active);
	header("Location: dashboard.php?messages");
	exit;
}
if (isset($_GET['ad-delete']) && isset($_SESSION[$authVar])) {
	deleteAd($_GET['id']);
	header("Location: dashboard.php?ads");
	exit;
}
if (isset($_POST['addnotification']) && isset($_SESSION[$authVar])) {
	addNotification($_POST['title'], $_POST['text']);
	header("Location: dashboard.php?notifications");
	exit;
}
if (isset($_POST['updatenotification']) && isset($_SESSION[$authVar])) {
	$active = false;
	if ($_POST['active'] == "on") {
		$active = true;
	}
	saveNotification($_POST['id'], $_POST['title'], $_POST['text'], $active);
	header("Location: dashboard.php?notifications");
	exit;
}
if (isset($_POST['updateprofile']) && isset($_SESSION[$authVar])) {
	saveProfile(1, $_POST['username'], $_POST['password']);
	header("Location: dashboard.php?profile");
	exit;
}
if (isset($_POST['updatead']) && isset($_SESSION[$authVar])) {
	$path = "";
	if (isset($_FILES['adimage']['name']) && $_FILES['adimage']['name'] != "") {
		//first checkthe extension
		$allowed = array('jpeg', 'png', 'jpg');
		$filename = $_FILES['adimage']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array(strtolower($ext), $allowed)) {
			echo 'Only PNG and JPG/JPEG allowed, filename not allowed: ' . $_FILES['adimage']['name'];
			exit;
		} else {
			$path = time() . "." . $ext;
			move_uploaded_file($_FILES['adimage']['tmp_name'], "ad-images/" . $path);
		}
	}
	$active = false;
	if ($_POST['active'] == "on") {
		$active = true;
	}
	saveAd($_POST['id'], $_POST['name'], $path, $active);
	header("Location: dashboard.php?ads");
	exit;
}

if (isset($_POST['addad']) && isset($_SESSION[$authVar])) {
	$path = "";
	if (isset($_FILES['adimage']['name']) && $_FILES['adimage']['name'] != "") {
		//first checkthe extension
		$allowed = array('jpeg', 'png', 'jpg');
		$filename = $_FILES['adimage']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array(strtolower($ext), $allowed)) {
			echo 'Only PNG and JPG/JPEG allowed, filename not allowed: ' . $_FILES['adimage']['name'];
			exit;
		} else {
			$path = time() . "." . $ext;
			move_uploaded_file($_FILES['adimage']['tmp_name'], "ad-images/" . $path);
		}
	}
	addAd($_POST['name'], $path);
	header("Location: dashboard.php?ads");
	exit;
}
if (isset($_POST['updatevpn']) && isset($_SESSION[$authVar])) {
	$path = $_POST['ovpnpath'];
	if (isset($_FILES['ovpnfile']['name']) && $_FILES['ovpnfile']['name'] != "") {
		//first checkthe extension
		$allowed = array('ovpn');
		$filename = $_FILES['ovpnfile']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array(strtolower($ext), $allowed)) {
			echo 'Only OVPN files allowed, filename not allowed: ' . $_FILES['ovpnfile']['name'];
			exit;
		} else {
			$path = time() . "." . $ext;
			move_uploaded_file($_FILES['ovpnfile']['tmp_name'], "ovpn-files/" . $path);
		}
	}
	$active = false;
	if ($_POST['active'] == "on") {
		$active = true;
	}
	$authEmbedded = false;
	if ($_POST['authembedded'] == "on") {
		$authEmbedded = true;
	}
	saveVpn($_POST['id'], $_POST['location'],$_POST['country'], $path, $active, $_POST['authtype'], $_POST['username'], $_POST['password'], $authEmbedded);
	header("Location: dashboard.php?vpn");
	exit;
}
if (isset($_POST['addvpn']) && isset($_SESSION[$authVar])) {
	$path = $_POST['ovpnpath'];
	if (isset($_FILES['ovpnfile']['name']) && $_FILES['ovpnfile']['name'] != "") {
		//first checkthe extension
		$allowed = array('ovpn');
		$filename = $_FILES['ovpnfile']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array(strtolower($ext), $allowed)) {
			echo 'Only OVPN files allowed, filename not allowed: ' . $_FILES['ovpnfile']['name'];
			exit;
		} else {
			$path = time() . "." . $ext;
			move_uploaded_file($_FILES['ovpnfile']['tmp_name'], "ovpn-files/" . $path);
		}
	}
	$authEmbedded = false;
	if ($_POST['authembedded'] == "on") {
		$authEmbedded = true;
	}
	addVpn($_POST['location'],$_POST['country'], $path, $_POST['authtype'], $_POST['username'], $_POST['password'], $authEmbedded);
	header("Location: dashboard.php?vpn");
	exit;
}
if (isset($_GET['vpn-delete']) && isset($_SESSION[$authVar])) {
	deleteVpn($_GET['id']);
	header("Location: dashboard.php?vpn");
	exit;
}
if (isset($_POST['updateintro']) && isset($_SESSION[$authVar])) {
	$path = "";
	if (isset($_FILES['mp4file']['name']) && $_FILES['mp4file']['name'] != "") {
		//first checkthe extension
		$allowed = array('mp4');
		$filename = $_FILES['mp4file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array(strtolower($ext), $allowed)) {
			echo 'Only MP4 files allowed, filename not allowed: ' . $_FILES['mp4file']['name'];
			exit;
		} else {
			$path = time() . "." . $ext;
			move_uploaded_file($_FILES['mp4file']['tmp_name'], "intro-videos/" . $path);
		}
	}
	$active = false;
	if ($_POST['active'] == "on") {
		$active = true;
	}
	saveIntro($path, $active);
	header("Location: dashboard.php?intro");
	exit;
}

if (isset($_POST['updatefemto']) && isset($_SESSION[$authVar])) {
	$showLive = false;
	if ($_POST['showLive'] == "on") {
		$showLive = true;
	}
	$showSeries = false;
	if ($_POST['showSeries'] == "on") {
		$showSeries = true;
	}
	$showVOD = false;
	if ($_POST['showVOD'] == "on") {
		$showVOD = true;
	}
	$showEPG = false;
	if ($_POST['showEPG'] == "on") {
		$showEPG = true;
	}
	$showContentUpdate = false;
	if ($_POST['showContentUpdate'] == "on") {
		$showContentUpdate = true;
	}

	saveFemtoOptions($showLive, $showSeries, $showVOD, $showEPG, $showContentUpdate, $_POST['proxyTraffic']);
	header("Location: dashboard.php?femto-settings");
	exit;
}
if (isset($_POST['updatesmarters']) && isset($_SESSION[$authVar])) {
	saveSmartersOptions($_POST['proxyTraffic']);
	header("Location: dashboard.php?smarters-settings");
	exit;
}

if (isset($_POST['updatetivi']) && isset($_SESSION[$authVar])) {
	saveTiviOptions($_POST['proxyTraffic']);
	header("Location: dashboard.php?tivimate-settings");
	exit;
}
if (isset($_POST['updateimplayer']) && isset($_SESSION[$authVar])) {
	saveImPlayerOptions($_POST['proxyTraffic']);
	header("Location: dashboard.php?implayer-settings");
	exit;
}
if (isset($_POST['updateltq']) && isset($_SESSION[$authVar])) {
	saveLTQOptions($_POST['proxyTraffic']);
	header("Location: dashboard.php?ltq-settings");
	exit;
}
if (isset($_POST['encryptltq']) && isset($_SESSION[$authVar])) {
	$_SESSION['ltq_from'] = $_POST['ltq_from'];
	$_SESSION['ltq_key'] = $_POST['ltq_key'];
	$_SESSION['ltq_to'] = ascii2hex(openssl_encrypt($_POST['ltq_from'], "AES-128-ECB", $_POST['ltq_key'], OPENSSL_RAW_DATA));
	header("Location: dashboard.php?ltq-settings");
	exit;
}
if (isset($_POST['decryptltq']) && isset($_SESSION[$authVar])) {
	$_SESSION['ltq_from'] = $_POST['ltq_from'];
	$_SESSION['ltq_key'] = $_POST['ltq_key'];
	$_SESSION['ltq_to'] = openssl_decrypt(hex2bin($_POST['ltq_from']), "AES-128-ECB", $_POST['ltq_key'], OPENSSL_RAW_DATA);
	header("Location: dashboard.php?ltq-settings");
	exit;
}
if (isset($_POST['updatexciptvplayer']) && isset($_SESSION[$authVar])) {
	$exo_buffer = $_POST['exo_buffer'];
	$exo_zoom = $_POST['exo_zoom'];
	$exo_hw = $_POST['exo_hw'] == "on";
	$exo_subtitles = $_POST['exo_subtitles'] == "on";
	$exo_volume = $_POST['exo_volume'];
	$vlc_buffer = $_POST['vlc_buffer'];
	$vlc_zoom = $_POST['vlc_zoom'];
	$vlc_hw = $_POST['vlc_hw'] == "on";
	$vlc_subtitles = $_POST['vlc_subtitles'] == "on";
	$vlc_volume = $_POST['vlc_volume'];
	$player_live = $_POST['player_live'];
	$player_epg = $_POST['player_epg'];
	$player_vod = $_POST['player_vod'];
	$player_series = $_POST['player_series'];

	saveXCIPTVOptionsPlayer($exo_buffer, $exo_zoom, $exo_hw, $exo_subtitles, $exo_volume, $vlc_buffer, $vlc_zoom, $vlc_hw, $vlc_subtitles, $vlc_volume, $player_live, $player_epg, $player_vod, $player_series);

	saveSmartersOptions($proxyTraffic);
	header("Location: dashboard.php?xciptv-player-settings");
	exit;
}
if (isset($_POST['updatexciptvinterface']) && isset($_SESSION[$authVar])) {
	$show_live = $_POST['show_live'] == "on";
	$show_epg = $_POST['show_epg'] == "on";
	$show_vod = $_POST['show_vod'] == "on";
	$show_series = $_POST['show_series'] == "on";
	$show_catchup = $_POST['show_catchup'] == "on";
	$show_radio = $_POST['show_radio'] == "on";
	$show_multi = $_POST['show_multi'] == "on";
	$show_favorite = $_POST['show_favorite'] == "on";
	$show_account = $_POST['show_account'] == "on";
	$show_reminders = $_POST['show_reminders'] == "on";
	$show_record = $_POST['show_record'] == "on";
	$show_vpn = $_POST['show_vpn'] == "on";
	$show_message = $_POST['show_message'] == "on";
	$show_update = $_POST['show_update'] == "on";
	$show_expiry = $_POST['show_expiry'] == "on";
	$theme = $_POST['theme'];
	saveXCIPTVOptionsButtons($show_live, $show_epg, $show_vod, $show_series, $show_catchup, $show_radio, $show_multi, $show_favorite, $show_account, $show_reminders, $show_record, $show_vpn, $show_message, $show_update, $show_expiry, $theme);
	saveXCIPTVOptionsButtonsPortal("2", $show_live = $_POST['show_live2'] == "on", $_POST['show_epg2'] == "on", $_POST['show_vod2'] == "on", $_POST['show_series2'] == "on", $_POST['show_catchup2'] == "on", $_POST['show_radio2'] == "on", $_POST['show_multi2'] == "on", $_POST['show_favorite2'] == "on", $_POST['show_account2'] == "on");
	saveXCIPTVOptionsButtonsPortal("3", $show_live = $_POST['show_live3'] == "on", $_POST['show_epg3'] == "on", $_POST['show_vod3'] == "on", $_POST['show_series3'] == "on", $_POST['show_catchup3'] == "on", $_POST['show_radio3'] == "on", $_POST['show_multi3'] == "on", $_POST['show_favorite3'] == "on", $_POST['show_account3'] == "on");
	saveXCIPTVOptionsButtonsPortal("4", $show_live = $_POST['show_live4'] == "on", $_POST['show_epg4'] == "on", $_POST['show_vod4'] == "on", $_POST['show_series4'] == "on", $_POST['show_catchup4'] == "on", $_POST['show_radio4'] == "on", $_POST['show_multi4'] == "on", $_POST['show_favorite4'] == "on", $_POST['show_account4'] == "on");
	saveXCIPTVOptionsButtonsPortal("5", $show_live = $_POST['show_live5'] == "on", $_POST['show_epg5'] == "on", $_POST['show_vod5'] == "on", $_POST['show_series5'] == "on", $_POST['show_catchup5'] == "on", $_POST['show_radio5'] == "on", $_POST['show_multi5'] == "on", $_POST['show_favorite5'] == "on", $_POST['show_account5'] == "on");
	header("Location: dashboard.php?xciptv-interface-settings");
	exit;
}
if (isset($_POST['updatexciptvapp']) && isset($_SESSION[$authVar])) {
	$app_name = $_POST['app_name'];
	$app_build = $_POST['app_build'];
	$app_identifier = $_POST['app_identifier'];
	$login_type = $_POST['login_type'];
	$login_accounts_button = $_POST['login_accounts_button'] == "on";
	$log_settings_button = $_POST['log_settings_button'] == "on";
	$announcements = $_POST['announcements'] == "on";
	$messages = $_POST['messages'] == "on";
	$update_user_info = $_POST['update_user_info'] == "on";
	$developer_name = $_POST['developer_name'];
	$developer_contact = $_POST['developer_contact'];
	$signup_url = $_POST['signup_url'];
	$login_logo = $_POST['login_logo'] == "on";
	$app_logs = $_POST['app_logs'] == "on";
	$show_expiry = $_POST['show_expiry'] == "on";
	$category_count = $_POST['category_count'] == "on";
	$load_last_channel = $_POST['load_last_channel'] == "on";
	$proxy_traffic = $_POST['proxy_traffic'];
	$user_agent = $_POST['user_agent'];
	$licv4_method = $_POST['licv4_method'];
	$licv3_key = $_POST['licv3_key'];
	$licv3_iv = $_POST['licv3_iv'];

	saveXCIPTVOptionsApp($_POST['app_language'],$_POST['support_email'],$_POST['support_phone'], $app_name, $app_build, $app_identifier, $login_type, $login_accounts_button, $log_settings_button, $announcements, $messages, $update_user_info, $developer_name, $developer_contact, $signup_url, $login_logo, $app_logs, $category_count, $user_agent, $load_last_channel, $proxy_traffic, $licv4_method, $licv3_key, $licv3_iv);
	header("Location: dashboard.php?xciptv-app-settings");
	exit;
}

if (isset($_POST['updatesports']) && isset($_SESSION[$authVar])) {
	saveSportsOptions($_POST['api_key'], $_POST['header_name'], $_POST['border_colour'], $_POST['background_colour'], $_POST['text_colour']);
	header("Location: dashboard.php?sports");
	exit;
}
if (isset($_POST['checkrewrites']) && isset($_SESSION[$authVar])) {
	$_SESSION['rewrite_results'] = checkRewrites();
	header("Location: dashboard.php?profile");
	exit;
}
if (isset($_POST['updatepanelroot']) && isset($_SESSION[$authVar])) {
	savePanelRoot($_POST['panel_root']);
	header("Location: dashboard.php?profile");
	exit;
}
if (isset($_POST['updatepurple']) && isset($_SESSION[$authVar])) {

	savePurpleOptions($_POST['proxy_traffic'], $_POST['startup_msg'], $_POST['allow_4k'] == "on", $_POST['vpn'] == "on", $_POST['vpn_login_screen'] == "on", $_POST['allow_cast'] == "on",  $_POST['remote_support'] == "on", $_POST['wifi_option'] == "on", $_POST['setting_option'] == "on", $_POST['app_list_status'] == "on", $_POST['epg_timeshift'] == "on", $_POST['catchup'] == "on", $_POST['epg_catchup'] == "on", $_POST['recording'] == "on", $_POST['multi_recording'] == "on", $_POST['intro_video'] == "on", $_POST['theme_change_allow'] == "on", $_POST['multi_profile'] == "on",  $_POST['server_selection'] == "on", $_POST['about_description'], $_POST['about_developed'], $_POST['about_name'], $_POST['about_skype'], $_POST['about_telegram'], $_POST['about_whatsapp']);
	header("Location: dashboard.php?purple-settings");
	exit;
}

if (isset($_POST['updatepurpleinterface']) && isset($_SESSION[$authVar])) {

	savePurpleInterfaceOptions($_POST['app_img'] == "on", $_POST['app_logo'], $_POST['app_mobile_icon'], $_POST['app_tv_banner'],  $_POST['splash_image'], $_POST['back_image'], $_POST['background_auto_change'] == "on", $_POST['background_mannual_change'] == "on", $_POST['background_orverlay_enable'] == "on" ? $_POST['background_orverlay_color_code'] : '', $_POST['background_url1'], $_POST['background_url2'], $_POST['background_url3'], $_POST['background_url4']);
	header("Location: dashboard.php?purple-interface-settings");
	exit;
}

if (isset($_POST['updatesmartersbackgrounds']) && isset($_SESSION[$authVar])) {
	
	for($i=1; $i<=7; $i++)
	{
		$path = "";
		$filePost = 'img' . $i . 'file';
		$captionPost = 'img' . $i . 'caption';
		if (isset($_FILES[$filePost]['name']) && $_FILES[$filePost]['name'] != "") {
			//first checkthe extension
			$allowed = array('jpeg', 'png', 'jpg');
			$filename = $_FILES[$filePost]['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if (!in_array(strtolower($ext), $allowed)) {
				echo 'Only PNG and JPG/JPEG allowed, filename not allowed: ' . $_FILES[$filePost]['name'];
				exit;
			} else {
				$path = $i . time() . "." . $ext;
				move_uploaded_file($_FILES[$filePost]['tmp_name'], "ad-images/" . $path);
			}
		}
		saveSmartersBg($i, $path, $_POST[$captionPost]);
	}
	header("Location: dashboard.php?smarters-backgrounds");
	exit;
}