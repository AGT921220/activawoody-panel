<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for ionCube Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/

function real_ip()
{
	$ip = 'undefined';

	if (isset($_SERVER)) {
		$ip = $_SERVER['REMOTE_ADDR'];

		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	}
	else {
		$ip = getenv('REMOTE_ADDR');

		if (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		else if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
	}

	$ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
	return $ip;
}

function get_os()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$os_platform = 'Unknown OS Platform';
	$os_array = ['/windows nt 10/i' => 'Windows 10', '/windows nt 6.3/i' => 'Windows 8.1', '/windows nt 6.2/i' => 'Windows 8', '/windows nt 6.1/i' => 'Windows 7', '/windows nt 6.0/i' => 'Windows Vista', '/windows nt 5.2/i' => 'Windows Server 2003/XP x64', '/windows nt 5.1/i' => 'Windows XP', '/windows xp/i' => 'Windows XP', '/windows nt 5.0/i' => 'Windows 2000', '/windows me/i' => 'Windows ME', '/win98/i' => 'Windows 98', '/win95/i' => 'Windows 95', '/win16/i' => 'Windows 3.11', '/macintosh|mac os x/i' => 'Mac OS X', '/mac_powerpc/i' => 'Mac OS 9', '/linux/i' => 'Linux', '/ubuntu/i' => 'Ubuntu', '/iphone/i' => 'iPhone', '/ipod/i' => 'iPod', '/ipad/i' => 'iPad', '/android/i' => 'Android', '/blackberry/i' => 'BlackBerry', '/webos/i' => 'Mobile'];

	foreach ($os_array as $regex => $value) {
		if (preg_match($regex, $user_agent)) {
			$os_platform = $value;
		}
	}

	return $os_platform;
}

function Browser_type()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$browser = 'Unknown Browser';
	$browser_array = ['/msie/i' => 'Internet Explorer', '/Trident/i' => 'Internet Explorer', '/firefox/i' => 'Firefox', '/safari/i' => 'Safari', '/chrome/i' => 'Chrome', '/edge/i' => 'Edge', '/opera/i' => 'Opera', '/netscape/i' => 'Netscape', '/maxthon/i' => 'Maxthon', '/konqueror/i' => 'Konqueror', '/ubrowser/i' => 'UC Browser', '/mobile/i' => 'Handheld Browser'];

	foreach ($browser_array as $regex => $value) {
		if (preg_match($regex, $user_agent)) {
			$browser = $value;
		}
	}

	return $browser;
}

function get_device()
{
	$tablet_browser = 0;
	$mobile_browser = 0;

	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$tablet_browser++;
	}

	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
	}
	if ((0 < strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml')) || (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE']))) {
		$mobile_browser++;
	}

	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = ['w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno', 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar', 'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-', 'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp', 'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'];

	if (in_array($mobile_ua, $mobile_agents)) {
		$mobile_browser++;
	}

	if (0 < strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini')) {
		$mobile_browser++;
		$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));

		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
			$tablet_browser++;
		}
	}

	if (0 < $tablet_browser) {
		return 'Tablet';
	}
	else if (0 < $mobile_browser) {
		return 'Mobile';
	}
	else {
		return 'Computer';
	}
}

function IsTorExitPoint()
{
	if (gethostbyname(ReverseIPOctets($_SERVER['REMOTE_ADDR']) . '.' . $_SERVER['SERVER_PORT'] . '.' . ReverseIPOctets($_SERVER['SERVER_ADDR']) . '.ip-port.exitlist.torproject.org') == '127.0.0.2') {
		return 'True';
	}
	else {
		return 'False';
	}
}

function ReverseIPOctets($inputip)
{
	$ipoc = explode('.', $inputip);
	return $ipoc[3] . '.' . $ipoc[2] . '.' . $ipoc[1] . '.' . $ipoc[0];
}

$ipl = real_ip();
$details = json_decode(file_get_contents('https://ipinfo.io/' . $ipl . '/json'));
$country = $details->country;
$state = $details->region;
$city = $details->city;
$isp = $details->org;
$isp = preg_replace('/AS\\d{1,}\\s/', '', $isp);
$loc = $details->loc;
echo '<style>' . "\r\n" . '@import url("https://fonts.googleapis.com/css?family=Share+Tech+Mono|Montserrat:700");' . "\r\n\r\n" . '* {' . "\r\n" . '    margin: 0;' . "\r\n" . '    padding: 0;' . "\r\n" . '    border: 0;' . "\r\n" . '    font-size: 100%;' . "\r\n" . '    font: inherit;' . "\r\n" . '    vertical-align: baseline;' . "\r\n" . '    box-sizing: border-box;' . "\r\n" . '    color: inherit;' . "\r\n" . '}' . "\r\n\r\n" . 'body {' . "\r\n" . '    background-image: radial-gradient( black 40%, #000954 99%);' . "\r\n" . '    height: 100vh;' . "\r\n" . '}' . "\r\n\r\n" . 'div {' . "\r\n" . '    background: rgba(0, 0, 0, 0);' . "\r\n" . '    width: 70vw;' . "\r\n" . '    position: relative;' . "\r\n" . '    top: 50%;' . "\r\n" . '    transform: translateY(-50%);' . "\r\n" . '    margin: 0 auto;' . "\r\n" . '    padding: 30px 30px 10px;' . "\r\n" . '    box-shadow: 0 0 150px -20px rgba(0, 0, 0, 0.5);' . "\r\n" . '    z-index: 3;' . "\r\n" . '}' . "\r\n\r\n" . 'P {' . "\r\n" . '    font-family: "Share Tech Mono", monospace;' . "\r\n" . '    color: #f5f5f5;' . "\r\n" . '    margin: 0 0 20px;' . "\r\n" . '    font-size: 17px;' . "\r\n" . '    line-height: 1.2;' . "\r\n" . '}' . "\r\n\r\n" . 'span {' . "\r\n" . '    color: #F0DA00;' . "\r\n" . '}' . "\r\n\r\n" . 'i {' . "\r\n" . '    color: #36FE00;' . "\r\n" . '}' . "\r\n\r\n" . 'div a {' . "\r\n" . '    text-decoration: none;' . "\r\n" . '}' . "\r\n\r\n" . 'b {' . "\r\n" . '    color: #81a2be;' . "\r\n" . '}' . "\r\n\r\n" . 'a {' . "\r\n" . '    color: #FF2D00;' . "\r\n" . '}' . "\r\n\r\n" . '@keyframes slide {' . "\r\n" . '    from {' . "\r\n" . '        right: -100px;' . "\r\n" . '        transform: rotate(360deg);' . "\r\n" . '        opacity: 0;' . "\r\n" . '    }' . "\r\n" . '    to {' . "\r\n" . '        right: 15px;' . "\r\n" . '        transform: rotate(0deg);' . "\r\n" . '        opacity: 1;' . "\r\n" . '    }' . "\r\n" . '}' . "\r\n\r\n" . '</style>' . "\r\n\r\n" . '<div>' . "\r\n" . '<p><span></span><a>Access Denied. You Do Not Have The Permission To Access This Page On This Server</a></p>' . "\r\n" . '<p>$ <span>Time Of Arrival</span>: "<i>';
echo date('Y-m-d H:i:s');
echo '</i>"</p>' . "\r\n" . '<p>$ <span>IP Address</span>: "<i>';
echo real_ip();
echo '</i>"</p>' . "\r\n" . '<p>$ <span>Country</span>: "<i>';
echo $country;
echo '</i>"</p>' . "\r\n" . '<p>$ <span>State</span>: "<i>';
echo $state;
echo '</i>"</p>' . "\r\n" . '<p>$ <span>City</span>: "<i>';
echo $city;
echo '</i>"</p>' . "\r\n" . '<p>$ <span>Location</span>: "<i>';
echo $loc;
echo '</i>"</p>' . "\r\n" . '<p>$ <span>ISP</span>: "<i>';
echo $isp;
echo '</i>"</p>' . "\r\n" . '<p>$ <span>User Agent</span>: "<i>';
echo $_SERVER[HTTP_USER_AGENT];
echo '</i>"</p>' . "\r\n" . '<p>$ <span>Operating System</span>: "<i>';
echo get_os();
echo '</i>"</p>' . "\r\n" . '<p>$ <span>Browser</span>: "<i>';
echo browser_type();
echo '</i>"</p>' . "\r\n" . '<p>$ <span>Device</span>: "<i>';
echo get_device();
echo '</i>"</p>' . "\r\n" . '<p>$ <span>Tor Browser</span>: "<i>';
echo istorexitpoint();
echo '</i>"</p>' . "\r\n" . '<p>root@admin: ~$ <span>Log Session</span>: "<i>Success</i>"</p>' . "\r\n" . '<p>root@admin: ~$ <a>You will be Blacklisted shortly....</a><i></i></p>' . "\r\n\r\n" . '</div>' . "\r\n\t\t\r\n" . '<script>' . "\r\n" . 'var str = document.getElementsByTagName(\'div\')[0].innerHTML.toString();' . "\r\n" . 'var i = 0;' . "\r\n" . 'document.getElementsByTagName(\'div\')[0].innerHTML = "";' . "\r\n\r\n" . 'setTimeout(function() {' . "\r\n" . '    var se = setInterval(function() {' . "\r\n" . '        i++;' . "\r\n" . '        document.getElementsByTagName(\'div\')[0].innerHTML = str.slice(0, i) + "|";' . "\r\n" . '        if (i == str.length) {' . "\r\n" . '            clearInterval(se);' . "\r\n" . '            document.getElementsByTagName(\'div\')[0].innerHTML = str;' . "\r\n" . '        }' . "\r\n" . '    }, 10);' . "\r\n" . '},0);' . "\r\n\r\n" . '</script>' . "\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n" . '?>';

?>