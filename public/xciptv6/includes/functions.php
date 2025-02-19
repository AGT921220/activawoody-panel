<?php

$dbFile = dirname(__file__) . "/db.php";
include($dbFile);
function login($username, $password)
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
	$query->bind_param("s", $username);
	$query->execute();
	$result = $query->get_result();
	if ($result->num_rows > 0) {
		$array = $result->fetch_array();
		if (password_verify($password, $array['password_hash'])) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
function addUser($username, $password)
{
	global $mysqli;

	$passwordHash = password_hash($password, PASSWORD_DEFAULT);
	$query = $mysqli->prepare("INSERT INTO users (username, password_hash) VALUES (?,?);");
	$query->bind_param("ss", $username, $passwordHash);
	$query->execute();
	return true;
}
function checkRewrites()
{
	$results = array();
	if (function_exists('apache_get_modules')) {
		$modules = apache_get_modules();

		if (!in_array("mod_rewrite", $modules)) {
			$results[] = "Apache module mod_rewrite is not loaded.";
		}
	} else {
		$results[] = "OnePanel doesn't seem to be running on an Apache Server, you may need to manually manage the rewrites";
	}
	$baseUrl = $GLOBALS['panelroot'];

	$smartersTestUrl = $baseUrl . "smarters/index";
	if (file_get_contents($smartersTestUrl) != "ok") {
		$results[] = "/smarters/.htaccess is not being processed properly";
	}
	$forwardTestUrl = $baseUrl . "forward/httest/testhtaccess";
	if (file_get_contents($forwardTestUrl) != "ok") {
		$results[] = "/forward/.htaccess is not being processed properly";
	}
	$proxyTestUrl = $baseUrl . "proxy/httest/testhtaccess";
	if (file_get_contents($proxyTestUrl) != "ok") {
		$results[] = "/proxy/.htaccess is not being processed properly";
	}
	return $results;
}

function callApi($api_link, $headersOnly = false, $useragent = false)
{

	$ch = curl_init();
	if ($useragent) {
		$config['useragent'] = $useragent;
	} else {
		$config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
	}

	curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
	curl_setopt($ch, CURLOPT_URL, $api_link);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, !$headersOnly);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	$response = curl_exec($ch);

	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header = substr($response, 0, $header_size);
	$html = substr($response, $header_size);

	$headers = get_headers_from_curl_response($header);

	return ["result" => "success", "data" => $html, "headers" => $headers];
}

function get_headers_from_curl_response($headerRaw)
{
	$headers = array();

	foreach (explode("\r\n", $headerRaw) as $i => $line)
		if ($i === 0)
			$headers['http_code'] = $line;
		else {
			list($key, $value) = explode(': ', $line);

			$headers[$key] = $value;
		}

	return $headers;
}

function saveFemtoOptions($showLive, $showSeries, $showVOD, $showEPG, $showContentUpdate, $proxyTraffic)
{
	global $mysqli;
	$showLiveInt = 1;
	$showSeriesInt = 1;
	$showVODInt = 1;
	$showEPGInt = 1;
	$showContentUpdateInt = 1;

	if ($showLive == false) {
		$showLiveInt = 0;
	}
	if ($showSeries == false) {
		$showSeriesInt = 0;
	}
	if ($showVOD == false) {
		$showVODInt = 0;
	}
	if ($showEPG == false) {
		$showEPGInt = 0;
	}
	if ($showContentUpdate == false) {
		$showContentUpdateInt = 0;
	}
	$query = $mysqli->prepare("UPDATE femto_options SET show_live=?, show_series=?, show_vod=?, show_epg=?, show_content_update=?, proxy_traffic=?");
	$query->bind_param("iiiiii", $showLiveInt, $showSeriesInt, $showVODInt, $showEPGInt, $showContentUpdateInt, $proxyTraffic);
	$query->execute();
}
function loadFemtoOptions()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM femto_options");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['showLive'] = $resultArray['show_live'];
	$returnable['showSeries'] = $resultArray['show_series'];
	$returnable['showVOD'] = $resultArray['show_vod'];
	$returnable['showEPG'] = $resultArray['show_epg'];
	$returnable['showContentUpdate'] = $resultArray['show_content_update'];
	$returnable['proxyTraffic'] = $resultArray['proxy_traffic'];
	return $returnable;
}

function saveSmartersOptions($proxyTraffic)
{
	global $mysqli;

	$query = $mysqli->prepare("UPDATE smarters_options SET proxy_traffic=?");
	$query->bind_param("i", $proxyTraffic);
	$query->execute();
}
function loadSmartersOptions()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM smarters_options");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['proxyTraffic'] = $resultArray['proxy_traffic'];
	return $returnable;
}

function loadSmartersBgOptions()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM smarters_backgrounds");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	return $resultArray;
}
function saveSmartersBg($num, $filename, $caption)
{
	global $mysqli;
	if($filename != "")
	{
		$query = $mysqli->prepare("UPDATE smarters_backgrounds SET img" . $num . "caption = ?, img" . $num . "file = ?");
		$query->bind_param("ss",$caption, $filename);
	}
	else{
		$query = $mysqli->prepare("UPDATE smarters_backgrounds SET img" . $num . "caption = ?");
		$query->bind_param("s", $caption);
	}
	$query->execute();
}

function saveImPlayerOptions($proxyTraffic)
{
	global $mysqli;


	$query = $mysqli->prepare("UPDATE implayer_options SET proxy_traffic=?");
	$query->bind_param("i", $proxyTraffic);
	$query->execute();
}
function loadImPlayerOptions()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM implayer_options");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['proxyTraffic'] = $resultArray['proxy_traffic'];
	return $returnable;
}
//loadOptions
function saveLTQOptions($proxyTraffic)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE ltq_options SET proxy_traffic=?");
	$query->bind_param("i", $proxyTraffic);
	$query->execute();
}
function loadLTQOptions()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM ltq_options");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['proxyTraffic'] = $resultArray['proxy_traffic'];
	return $returnable;
}
function saveTiviOptions($proxyTraffic)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE tivimate_options SET proxy_traffic=?");
	$query->bind_param("i", $proxyTraffic);
	$query->execute();
}
function loadTiviOptions()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM tivimate_options");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['proxyTraffic'] = $resultArray['proxy_traffic'];
	return $returnable;
}
function savePanelRoot($rootPath)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE config SET panel_root=?");
	$query->bind_param("s", $rootPath);
	$query->execute();
}
function loadPanelRoot()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM config");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	return $resultArray['panel_root'];
}
function addDNS($name, $url)
{
	global $mysqli;
	$query = $mysqli->prepare("INSERT INTO dns (name, url, active) VALUES (?,?,1);");
	$query->bind_param("ss", $name, $url);
	$query->execute();
}
function deleteDNS($id)
{
	global $mysqli;
	$query = $mysqli->prepare("DELETE FROM dns WHERE id=?");
	$query->bind_param("i", $id);
	$query->execute();
}
function saveDNS($id, $name, $url, $active)
{
	global $mysqli;
	$activeInt = 1;
	if ($active == false) {
		$activeInt = 0;
	}
	$query = $mysqli->prepare("UPDATE dns SET name=?, url=?, active=? WHERE id=?");
	$query->bind_param("ssii", $name, $url, $activeInt, $id);
	$query->execute();
}
function loadDNSForUser($username, $password)
{
	$passwordHash = hash("sha256", $password);
	global $mysqli;
	$returnable = array();
	$query = $mysqli->prepare("SELECT dns.*,dns_sessions.id as checked FROM dns LEFT JOIN dns_sessions ON dns_sessions.dns_id = dns.id AND dns_sessions.username = ? and dns_sessions.password_hash = ? AND dns_sessions.last_used > NOW() - INTERVAL 1 DAY ORDER BY dns_sessions.dns_id DESC, dns.id ASC");
	$query->bind_param("ss", $username, $passwordHash);
	$query->execute();
	$result = $query->get_result();
	while ($resultArray = $result->fetch_array()) {
		$thisDNS = array();
		$thisDNS['id'] = $resultArray['id'];
		$thisDNS['name'] = $resultArray['name'];
		$thisDNS['portal'] = $resultArray['url'];
		$thisDNS['active'] = $resultArray['active'];
		$thisDNS['checked'] = $resultArray['checked'];
		$returnable[] = $thisDNS;
	}
	return $returnable;
}
function clearDNSSessions()
{
	global $mysqli;
	$query = $mysqli->prepare("DELETE FROM dns_sessions;");
	$query->execute();
}
function saveDNSForUser($dns, $username, $password)
{
	$passwordHash = hash("sha256", $password);
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM dns_sessions WHERE dns_id = ? AND username = ? AND password_hash = ?");
	$query->bind_param("iss", $dns, $username, $passwordHash);
	$query->execute();
	$result = $query->get_result();
	if ($result->num_rows > 0) {
		$resultArray = $result->fetch_array();
		$query = $mysqli->prepare("UPDATE dns_sessions SET last_used = NOW() WHERE id = ?");
		$query->bind_param("i", $resultArray['id']);
		$query->execute();
	} else {
		$query = $mysqli->prepare("INSERT INTO dns_sessions (dns_id, date_added, last_used, username, password_hash) VALUES(?, NOW(), NOW(), ?, ?);");
		$query->bind_param("iss", $dns, $username, $passwordHash);
		$query->execute();
	}
}
function loadAllDNS($activeOnly = false)
{
	global $mysqli;
	$returnable = array();
	if ($activeOnly) {
		$query = $mysqli->prepare("SELECT * FROM dns;");
	} else {
		$query = $mysqli->prepare("SELECT * FROM dns WHERE active = 1;");
	}
	$query->execute();
	$result = $query->get_result();
	while ($resultArray = $result->fetch_array()) {
		$thisDNS = array();
		$thisDNS['id'] = $resultArray['id'];
		$thisDNS['name'] = $resultArray['name'];
		$thisDNS['portal'] = $resultArray['url'];
		$thisDNS['active'] = $resultArray['active'];
		$returnable[] = $thisDNS;
	}
	return $returnable;
}
function loadDNS($id)
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM dns WHERE id = ?;");
	$query->bind_param("i", $id);
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['id'] = $resultArray['id'];
	$returnable['name'] = $resultArray['name'];
	$returnable['portal'] = $resultArray['url'];
	$returnable['active'] = $resultArray['active'];
	return $returnable;
}

function saveProfile($id, $username, $password)
{
	$passwordHash = password_hash($password, PASSWORD_DEFAULT);
	global $mysqli;
	$query = $mysqli->prepare("UPDATE users SET	username=?, password_hash=? WHERE id=?");
	$query->bind_param("ssi", $username, $passwordHash, $id);
	$query->execute();
}
function loadProfile($id)
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
	$query->bind_param("i", $id);
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['username'] = $resultArray['username'];
	$returnable['password'] = '******';
	return $returnable;
}

function addMessage($text, $user)
{
	global $mysqli;
	$query = $mysqli->prepare("INSERT INTO messages (text, user, active) VALUES (?,?,1)");
	$query->bind_param("ss", $text, $user);
	$query->execute();
}

function saveMessage($id, $text, $user, $active)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE messages SET	text=?, user=?, active=? WHERE id=?");
	$query->bind_param("ssii", $text, $user, $active, $id);
	$query->execute();
}
function deleteMessage($id)
{
	global $mysqli;
	$query = $mysqli->prepare("DELETE FROM messages WHERE id=?");
	$query->bind_param("i", $id);
	$query->execute();
}
function loadMessage($id)
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM messages WHERE id = ?");
	$query->bind_param("i", $id);
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['id'] = $resultArray['id'];
	$returnable['user'] = $resultArray['user'];
	$returnable['text'] = $resultArray['text'];
	$returnable['date_added'] = $resultArray['date_added'];
	$returnable['active'] = $resultArray['active'];
	return $returnable;
}
function loadAllMessages($activeOnly = false)
{
	$returnable = array();
	global $mysqli;
	if ($activeOnly) {
		$query = $mysqli->prepare("SELECT * FROM messages where active = 1");
	} else {
		$query = $mysqli->prepare("SELECT * FROM messages");
	}
	$query->execute();
	$result = $query->get_result();
	while ($resultArray = $result->fetch_array()) {

		$thisMessage = array();
		$thisMessage['id'] = $resultArray['id'];
		$thisMessage['user'] = $resultArray['user'];
		$thisMessage['text'] = $resultArray['text'];
		$thisMessage['date_added'] = $resultArray['date_added'];
		$thisMessage['active'] = $resultArray['active'];
		$returnable[] = $thisMessage;
	}
	return $returnable;
}

function addNotification($title, $text)
{
	global $mysqli;
	$query = $mysqli->prepare("INSERT INTO notifications (notification_title, notification_text, active) VALUES (?,?,1)");
	$query->bind_param("ss", $title, $text);
	$query->execute();
}

function saveNotification($id, $title, $text, $active)
{
	$activeInt = 1;
	if ($active == false) {
		$activeInt = 0;
	}
	global $mysqli;
	$query = $mysqli->prepare("UPDATE notifications SET	notification_title=?, notification_text=?, active=? WHERE id=?");
	$query->bind_param("ssii", $title, $text, $activeInt, $id);
	$query->execute();
}
function deleteNotification($id)
{
	global $mysqli;
	$query = $mysqli->prepare("DELETE FROM notifications WHERE id=?");
	$query->bind_param("i", $id);
	$query->execute();
}
function loadNotification($id)
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM notifications WHERE id = ?");
	$query->bind_param("i", $id);
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['id'] = $resultArray['id'];
	$returnable['title'] = $resultArray['notification_title'];
	$returnable['text'] = $resultArray['notification_text'];
	$returnable['date_added'] = $resultArray['date_added'];
	$returnable['active'] = $resultArray['active'];
	return $returnable;
}
function loadAllNotifications($activeOnly = false)
{
	$returnable = array();
	global $mysqli;
	if ($activeOnly) {
		$query = $mysqli->prepare("SELECT * FROM notifications where active = 1");
	} else {
		$query = $mysqli->prepare("SELECT * FROM notifications");
	}
	$query->execute();
	$result = $query->get_result();
	while ($resultArray = $result->fetch_array()) {

		$thisNotification = array();
		$thisNotification['id'] = $resultArray['id'];
		$thisNotification['title'] = $resultArray['notification_title'];
		$thisNotification['text'] = $resultArray['notification_text'];
		$thisNotification['date_added'] = $resultArray['date_added'];
		$thisNotification['active'] = $resultArray['active'];
		$returnable[] = $thisNotification;
	}
	return $returnable;
}

//Ads
function addAd($name, $path)
{
	global $mysqli;
	$query = $mysqli->prepare("INSERT INTO ads (name, path, active) VALUES (?,?,1)");
	$query->bind_param("ss", $name, $path);
	$query->execute();
}

function saveAd($id, $name, $path, $active)
{
	$activeInt = 1;
	if ($active == false) {
		$activeInt = 0;
	}
	global $mysqli;
	if ($path == "") {
		$query = $mysqli->prepare("UPDATE ads SET	name=?, active=? WHERE id=?");
		$query->bind_param("sii", $name, $activeInt, $id);
	} else {
		$query = $mysqli->prepare("UPDATE ads SET	name=?, path=?, active=? WHERE id=?");
		$query->bind_param("ssii", $name, $path, $activeInt, $id);
	}
	$query->execute();
}

function deleteAd($id)
{
	global $mysqli;
	$query = $mysqli->prepare("DELETE FROM ads WHERE id=?");
	$query->bind_param("i", $id);
	$query->execute();
}
function loadAd($id)
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM ads WHERE id = ?");
	$query->bind_param("i", $id);
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['id'] = $resultArray['id'];
	$returnable['name'] = $resultArray['name'];
	$returnable['path'] = $resultArray['path'];
	$returnable['active'] = $resultArray['active'];
	return $returnable;
}
function loadAllAds($onlyActive = false)
{
	$returnable = array();
	global $mysqli;
	if ($onlyActive) {
		$query = $mysqli->prepare("SELECT * FROM ads WHERE active = 1");
	} else {
		$query = $mysqli->prepare("SELECT * FROM ads");
	}
	$query->execute();
	$result = $query->get_result();
	while ($resultArray = $result->fetch_array()) {
		$thisNotification = array();
		$thisNotification['id'] = $resultArray['id'];
		$thisNotification['name'] = $resultArray['name'];
		$thisNotification['path'] = $resultArray['path'];
		$thisNotification['active'] = $resultArray['active'];
		$returnable[] = $thisNotification;
	}
	return $returnable;
}
//VPN
function addVpn($location, $country, $path, $authType, $username, $password, $auth_embedded)
{
	global $mysqli;
	$query = $mysqli->prepare("INSERT INTO vpn (location, country, path, active, auth_type, username, password, date_added, auth_embedded) VALUES (?,?,?,1,?,?,?,NOW(),?)");
	$query->bind_param("ssssssi", $location, $country, $path, $authType, $username, $password, $auth_embedded);
	$query->execute();
}

function saveVpn($id, $location,  $country, $path, $active, $authType, $username, $password, $auth_embedded)
{
	$activeInt = 1;
	if ($active == false) {
		$activeInt = 0;
	}
	$authInt = 1;
	if ($auth_embedded == false) {
		$authInt = 0;
	}
	global $mysqli;
	$query = $mysqli->prepare("UPDATE vpn SET location=?, country=?,path=?, active=?, auth_type=?, username=?, password=?, auth_embedded=? WHERE id=?");
	$query->bind_param("sssisssii", $location, $country, $path, $activeInt, $authType, $username, $password, $authInt, $id);
	$query->execute();
}
function deleteVpn($id)
{
	global $mysqli;
	$query = $mysqli->prepare("DELETE FROM vpn WHERE id=?");
	$query->bind_param("i", $id);
	$query->execute();
}
function loadVpn($id)
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM vpn WHERE id = ?");
	$query->bind_param("i", $id);
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['id'] = $resultArray['id'];
	$returnable['location'] = $resultArray['location'];
	$returnable['country'] = $resultArray['country'];
	$returnable['path'] = $resultArray['path'];
	$returnable['active'] = $resultArray['active'];
	$returnable['auth_type'] = $resultArray['auth_type'];
	$returnable['username'] = $resultArray['username'];
	$returnable['password'] = $resultArray['password'];
	$returnable['auth_embedded'] = $resultArray['auth_embedded'];
	return $returnable;
}
function loadAllVpn($activeOnly = false)
{
	$returnable = array();
	global $mysqli;
	if ($activeOnly) {
		$query = $mysqli->prepare("SELECT * FROM vpn where active = 1");
	} else {
		$query = $mysqli->prepare("SELECT * FROM vpn");
	}

	$query->execute();
	$result = $query->get_result();
	while ($resultArray = $result->fetch_array()) {
		$thisVpn = array();
		$thisVpn['id'] = $resultArray['id'];
		$thisVpn['location'] = $resultArray['location'];
		$thisVpn['country'] = $resultArray['country'];
		$thisVpn['path'] = $resultArray['path'];
		$thisVpn['active'] = $resultArray['active'];
		$thisVpn['auth_type'] = $resultArray['auth_type'];
		$thisVpn['username'] = $resultArray['username'];
		$thisVpn['password'] = $resultArray['password'];
		$thisVpn['auth_embedded'] = $resultArray['auth_embedded'];
		$returnable[] = $thisVpn;
	}
	return $returnable;
}
//Intro
function loadIntro()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM intro");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	$returnable = array();
	$returnable['path'] = $resultArray['path'];
	$returnable['active'] = $resultArray['active'];
	return $returnable;
}

function saveIntro($path, $active)
{
	$activeInt = 1;
	if ($active == false) {
		$activeInt = 0;
	}
	global $mysqli;
	if ($path == "") {
		$query = $mysqli->prepare("UPDATE intro SET active=?");
		$query->bind_param("i", $activeInt);
	} else {
		$query = $mysqli->prepare("UPDATE intro SET path=?, active=?");
		$query->bind_param("si", $path, $activeInt);
	}

	$query->execute();
}
//XCIPTV
function saveXCIPTVOptionsApp($app_language, $support_email, $support_phone, $app_name, $app_build, $app_identifier, $login_type, $login_accounts_button, $log_settings_button, $announcements, $messages, $update_user_info, $developer_name, $developer_contact, $signup_url, $login_logo, $app_logs, $category_count, $user_agent, $load_last_channel, $proxy_traffic, $licv4_method, $licv3_key, $licv3_iv)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE xciptv_options SET app_language = ?, support_email =?, support_phone=?, app_name=?, app_build=?, app_identifier=?, login_type=?, login_accounts_button=?, log_settings_button=?, announcements=?, messages=?, update_user_info=?, developer_name=?, developer_contact=?, signup_url=?, login_logo=?, app_logs=?, category_count=?, user_agent=?, load_last_channel=?, proxy_traffic=?, licv4_method=?, licv3_key=?, licv3_iv=?;");
	$query->bind_param("sssssssiiiiisssiiisiiiss",$app_language,$support_email,$support_phone, $app_name, $app_build, $app_identifier, $login_type, $login_accounts_button, $log_settings_button, $announcements, $messages, $update_user_info, $developer_name, $developer_contact, $signup_url, $login_logo, $app_logs, $category_count, $user_agent, $load_last_channel, $proxy_traffic, $licv4_method, $licv3_key, $licv3_iv);
	$query->execute();
}

function saveXCIPTVOptionsButtons($show_live, $show_epg, $show_vod, $show_series, $show_catchup, $show_radio, $show_multi, $show_favorite, $show_account, $show_reminders, $show_record, $show_vpn, $show_message, $show_update, $show_expiry, $theme)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE xciptv_options SET show_live=?, show_epg=?, show_vod=?, show_series=?, show_catchup=?, show_radio=?, show_multi=?, show_favorite=?, show_account=?, show_reminders=?, show_record=?, show_vpn=?, show_message=?, show_update=?, show_expiry=?, theme=?");
	$query->bind_param("iiiiiiiiiiiiiiis", $show_live, $show_epg, $show_vod, $show_series, $show_catchup, $show_radio, $show_multi, $show_favorite, $show_account, $show_reminders, $show_record, $show_vpn, $show_message, $show_update, $show_expiry, $theme);
	$query->execute();
}
function saveXCIPTVOptionsButtonsPortal($number, $show_live, $show_epg, $show_vod, $show_series, $show_catchup, $show_radio, $show_multi, $show_favorite, $show_account)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE xciptv_options SET show_live" . $number . "=?, show_epg" . $number . "=?, show_vod" . $number . "=?, show_series" . $number . "=?, show_catchup" . $number . "=?, show_radio" . $number . "=?, show_multi" . $number . "=?, show_favorite" . $number . "=?, show_account" . $number . "=?");
	$query->bind_param("iiiiiiiii", $show_live, $show_epg, $show_vod, $show_series, $show_catchup, $show_radio, $show_multi, $show_favorite, $show_account);
	$query->execute();
}
function saveXCIPTVOptionsPlayer($exo_buffer, $exo_zoom, $exo_hw, $exo_subtitles, $exo_volume, $vlc_buffer, $vlc_zoom, $vlc_hw, $vlc_subtitles, $vlc_volume, $player_live, $player_epg, $player_vod, $player_series)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE xciptv_options SET exo_buffer=?, exo_zoom=?, exo_hw=?, exo_subtitles=?, exo_volume=?, vlc_buffer=?, vlc_zoom=?, vlc_hw=?, vlc_subtitles=?, vlc_volume=?, player_live=?, player_epg=?, player_vod=?, player_series=?;");
	$query->bind_param("ssiisssiisssss", $exo_buffer, $exo_zoom, $exo_hw, $exo_subtitles, $exo_volume, $vlc_buffer, $vlc_zoom, $vlc_hw, $vlc_subtitles, $vlc_volume, $player_live, $player_epg, $player_vod, $player_series);
	$query->execute();
}
function loadXCIPTVOptions()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM xciptv_options");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	return $resultArray;
}
function loadPurpleOptions()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM purple_options");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	return $resultArray;
}
function savePurpleOptions($proxy_traffic, $startup_msg, $allow_4k, $vpn, $vpn_login_screen, $allow_cast, $remote_support, $wifi_option, $setting_option, $app_list_status, $epg_timeshift, $catchup, $epg_catchup, $recording, $multi_recording, $intro_video, $theme_change_allow, $multi_profile, $server_selection, $about_description, $about_developed, $about_name, $about_skype, $about_telegram, $about_whatsapp)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE purple_options SET proxy_traffic=?, startup_msg=?, allow_4k=?, vpn=?, vpn_login_screen=?, allow_cast=?, remote_support=?, wifi_option=?, setting_option=?, app_list_status=?, epg_timeshift=?, catchup=?, epg_catchup=?, recording=?, multi_recording=?, intro_video=?, theme_change_allow=?, multi_profile=?, server_selection=?, about_description=?, about_developed=?, about_name=?, about_skype=?, about_telegram=?, about_whatsapp=?;");
	$query->bind_param("isiiiiiiiiiiiiiiiiissssss", $proxy_traffic, $startup_msg, $allow_4k, $vpn, $vpn_login_screen, $allow_cast, $remote_support, $wifi_option, $setting_option, $app_list_status, $epg_timeshift, $catchup, $epg_catchup, $recording, $multi_recording, $intro_video, $theme_change_allow, $multi_profile, $server_selection, $about_description, $about_developed, $about_name, $about_skype, $about_telegram, $about_whatsapp);
	$query->execute();
}
function savePurpleInterfaceOptions($app_img, $app_logo, $app_mobile_icon, $app_tv_banner, $splash_image, $back_image, $background_auto_change, $background_mannual_change, $background_orverlay_color_code, $background_url1, $background_url2, $background_url3, $background_url4)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE purple_options SET app_img=?, app_logo=?, app_mobile_icon=?, app_tv_banner=?, splash_image=?, back_image=?, background_auto_change=?, background_mannual_change=?, background_orverlay_color_code=?, background_url1=?, background_url2=?, background_url3=?, background_url4=?;");
	$query->bind_param("isssssiisssss", $app_img, $app_logo, $app_mobile_icon, $app_tv_banner, $splash_image, $back_image, $background_auto_change, $background_mannual_change, $background_orverlay_color_code, $background_url1, $background_url2, $background_url3, $background_url4);
	$query->execute();
}
function loadSportsOptions()
{
	global $mysqli;
	$query = $mysqli->prepare("SELECT * FROM sports_options");
	$query->execute();
	$result = $query->get_result();
	$resultArray = $result->fetch_array();
	return $resultArray;
}
function saveSportsOptions($api_key, $header_name, $border_colour, $background_colour, $text_colour)
{
	global $mysqli;
	$query = $mysqli->prepare("UPDATE sports_options SET api_key=?, header_name=?, border_colour=?, background_colour=?, text_colour=?;");
	$query->bind_param("sssss", $api_key, $header_name, $border_colour, $background_colour, $text_colour);
	$query->execute();
}

function ascii2hex($ascii)
{
	$hex = '';
	for ($i = 0; $i < strlen($ascii); $i++) {
		$byte = strtoupper(dechex(ord($ascii[$i])));
		$byte = str_repeat('0', 2 - strlen($byte)) . $byte;
		$hex .= $byte . "";
	}
	return $hex;
}

function hex2str($hex)
{
	$str = '';
	for ($i = 0; $i < strlen($hex); $i += 2) $str .= chr(hexdec(substr($hex, $i, 2)));
	return $str;
}
function qdEncrypt($input)
{
	global $key;
	global $iv;
	$encrypted = openssl_encrypt($input, 'aes-256-cbc', $key, 0, $iv);
	return $encrypted;
}

function qdDecrypt($input)
{
	global $key;
	global $iv;
	$decrypted = openssl_decrypt($input, 'aes-256-cbc', $key, 0, $iv);
	return $decrypted;
}

function getAuthorizationHeader()
{
	$headers = null;
	if (isset($_SERVER['Authorization'])) {
		$headers = trim($_SERVER["Authorization"]);
	} else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
		$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
	} elseif (function_exists('apache_request_headers')) {
		$requestHeaders = apache_request_headers();
		$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
		if (isset($requestHeaders['Authorization'])) {
			$headers = trim($requestHeaders['Authorization']);
		}
	}
	return $headers;
}

/**
 * get access token from header
 * */
function getBearerToken()
{
	$headers = getAuthorizationHeader();
	// HEADER: Get the access token from the header
	if (!empty($headers)) {
		if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
			return $matches[1];
		}
	}
	return null;
}
function getProApps()
{
	$appRaw = file_get_contents("https://a.ahax.uk/pro/");
	return json_decode($appRaw,true);
}