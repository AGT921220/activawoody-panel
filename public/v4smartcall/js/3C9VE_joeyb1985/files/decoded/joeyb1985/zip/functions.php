<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

$____q = "5f4286c89fd0a5d12e1fdbfc7ac38604d1f03eee";
$____w = "eeacba351ec1f443da066229225090999c749a69";
$____e = "9c62f9574a07e572e3a75f6092cf29e52ad1534f";
$____r = "176aa725fa259e5595c56a73ec00d193f50beec4";
$____t = "ccf0412fbc34c00c0cfb4e025061397a725f7103";
$____y = "3bb7ebf6faf653c30e92d16007ff9090493dd27b";
$____u = "f2f7b98596a1a0afbdd84c57050e74bed45265e4";
$____i = "f9d9b5c8097d8f0c1b6f2750f94ece8980e9a6c9";
$____o = "ef76b690111b5cb84e0d2c1d5bcf77b6ec6df740";
$____p = "c2ab445d55f529ae299924dd9e6eba8208bb2405";
$____a = "3b2358339f6150d8ff7f65c182e74aea7f2869e0";
$____s = "da107c41948e47d16059d1d08776ebfbe1b6ef72";
$____d = "4e21859aac61ce833effabbae8bd56f5dd09f1de";
$____f = "57a45933de8de6acf358d72a6807d3c7f2b345bb";
$____g = "ecc0303c7e4a4b26542e94216f92128264efe9b7";
$____h = "84f5ce10a16460cbd54f347960d95d4a82cc255d";
$____j = "3fcc5bd1b37163c31eabbc1e0fe4c9ac643b7b4d";
$____k = "2b7fcf0d132f2e4834e5f320f26e888dbb1947d4";
$____l = "3df40b7d64f94e2dac7952d35839b89ff02dac66";
$____z = "d3f6db6c2fec8fb07b6392641ad9ad3dfb84b05c";
$____x = "e6ec1e5841672e5a4347b0efef47e93e425ada21";
$____c = "412e9e8056d1d0443cd6120fa9fb920a3ac84438";
$____v = "6b36215f52966cf0a22f04bee61c1620eaf08ecc";
$____b = "18d0a244311d8cfebd2532e6a2a29ff6bbfc60a3";
$____n = "00f762b24c45c8b81580ab34ab1b5c53544c41fc";
$____m = "25358ead2b63270a1aa758cca9507edf31e67fee";
$____qw = "40f8c0c7bb58158ecd36463b75054144de5507cb";
$____we = "0e9c67f974863d42009d1e3fd142973031241852";
$____er = "a033e7ede22340f8a53edacd66ea1c4c6c42f8da";
$____rt = "274a1fae7eb51c3a78a9e92d99978b11403f960c";
$____ty = "e37d20d69c6be374c68d45fc8576bc98bb33131a";
$____yu = "7d5fb7526ae157a6bf9ab179798df67d4a4970ff";
$____ui = "d9d4fdda2c0dfec5d529de264910f69a60d08d16";
$____io = "2895149712127fb46f98fb52c900cdcf73da3d80";
$____op = "994591708669b5c2adf762bba5081eb8c43ce611";
$____as = "b65b897e59f23b29e34e9ba8bfc3facd07ff99b3";
$____sd = "0dfa2d3b797bd7e9bd1c1d829231dd52e1e92f97";
$____df = "0c5ec47249e0261168fe3095c3b04e6367044b5f";
$____fg = "2bdd03d9fe241d7d5840f03ed5f95678f1b10fbd";
$____gh = "f35807232fbd599ef01f83edd0deb87cb0e8b63b";
$____hj = "d25cdb73536c4d6a627401e7c5bcde294db28066";
$____jk = "5912022f10ad3369e39966783afa55dc0a6c4690";
$____kl = "e6b3e309afa8ec10d7ac731e79d654c4e306b7b3";
$____zx = "06a4c984af188496f64cbf1cd0045ecb3cad5041";
$____xc = "a16a4fdded78408e0bfe4407a434f0175558f743";
$____cv = "4a493670138890e2edf7455a8d7556509ee52feb";
$____vb = "b7834e57e12d62f7bbf52999e4a1ed2df6244877";
$____bn = "64f10558fe6dd69a23730a40d5b67a0a15e04588";
$____nm = "a396d3a878311c33312a477d6df26947fc8eb5ae";
$____mn = "838bb62d0041b6edf14a0c07d8b085cd574f041f";
$____bv = "b65a8793377fade54dff3c4035540155fe0a34b6";
$____cx = "c457f27903b3290f255ddfadd89f91b8232e33a2";
$____zl = "b8b1dad14acc92830d10e2ab2ce40e1276b183e5";
$____lk = "0057ce2495436c13de3572d26d01fd4a42a0e28b";
$____jh = "2baf25ffe772de2a52927572c79c2d8fac503ebc";
$____gf = "e0ea96d8a28fa39295ae452f94297c3ab82ef6ab";
$____ds = "0dcf679c31e3229f38265faa3906c283f08845cb";
$____ap = "c6242a1d30f0081c0594068a045093d026cb25d2";
$____oi = "07a91a9e7e03737b0635f03127395fdf6c4ffe01";
$____uy = "b9b3c1d4f32b25f13f9e1392c6e541413ed66e26";
// @Protected ioncube.dk encoding key.
function generate_token()
{
}
function gen_session()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
function real_ip()
{
    $ip = "undefined";
    if (isset($_SERVER)) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            }
        }
    } else {
        $ip = getenv("REMOTE_ADDR");
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else {
            if (getenv("HTTP_CLIENT_IP")) {
                $ip = getenv("HTTP_CLIENT_IP");
            }
        }
    }
    $ip = htmlspecialchars($ip, ENT_QUOTES, "UTF-8");
    return $ip;
}
function get_os()
{
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    $os_platform = "Unknown OS Platform";
    $os_array = ["/windows nt 10/i" => "Windows 10", "/windows nt 6.3/i" => "Windows 8.1", "/windows nt 6.2/i" => "Windows 8", "/windows nt 6.1/i" => "Windows 7", "/windows nt 6.0/i" => "Windows Vista", "/windows nt 5.2/i" => "Windows Server 2003/XP x64", "/windows nt 5.1/i" => "Windows XP", "/windows xp/i" => "Windows XP", "/windows nt 5.0/i" => "Windows 2000", "/windows me/i" => "Windows ME", "/win98/i" => "Windows 98", "/win95/i" => "Windows 95", "/win16/i" => "Windows 3.11", "/macintosh|mac os x/i" => "Mac OS X", "/mac_powerpc/i" => "Mac OS 9", "/linux/i" => "Linux", "/ubuntu/i" => "Ubuntu", "/iphone/i" => "iPhone", "/ipod/i" => "iPod", "/ipad/i" => "iPad", "/android/i" => "Android", "/blackberry/i" => "BlackBerry", "/webos/i" => "Mobile"];
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }
    return $os_platform;
}
function Browser_type()
{
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    $browser = "Unknown Browser";
    $browser_array = ["/msie/i" => "Internet Explorer", "/Trident/i" => "Internet Explorer", "/firefox/i" => "Firefox", "/safari/i" => "Safari", "/chrome/i" => "Chrome", "/edge/i" => "Edge", "/opera/i" => "Opera", "/netscape/i" => "Netscape", "/maxthon/i" => "Maxthon", "/konqueror/i" => "Konqueror", "/ubrowser/i" => "UC Browser", "/mobile/i" => "Handheld Browser"];
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
    if (preg_match("/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i", strtolower($_SERVER["HTTP_USER_AGENT"]))) {
        $tablet_browser++;
    }
    if (preg_match("/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i", strtolower($_SERVER["HTTP_USER_AGENT"]))) {
        $mobile_browser++;
    }
    if (0 < strpos(strtolower($_SERVER["HTTP_ACCEPT"]), "application/vnd.wap.xhtml+xml") || isset($_SERVER["HTTP_X_WAP_PROFILE"]) || isset($_SERVER["HTTP_PROFILE"])) {
        $mobile_browser++;
    }
    $mobile_ua = strtolower(substr($_SERVER["HTTP_USER_AGENT"], 0, 4));
    $mobile_agents = ["w3c ", "acs-", "alav", "alca", "amoi", "audi", "avan", "benq", "bird", "blac", "blaz", "brew", "cell", "cldc", "cmd-", "dang", "doco", "eric", "hipt", "inno", "ipaq", "java", "jigs", "kddi", "keji", "leno", "lg-c", "lg-d", "lg-g", "lge-", "maui", "maxo", "midp", "mits", "mmef", "mobi", "mot-", "moto", "mwbp", "nec-", "newt", "noki", "palm", "pana", "pant", "phil", "play", "port", "prox", "qwap", "sage", "sams", "sany", "sch-", "sec-", "send", "seri", "sgh-", "shar", "sie-", "siem", "smal", "smar", "sony", "sph-", "symb", "t-mo", "teli", "tim-", "tosh", "tsm-", "upg1", "upsi", "vk-v", "voda", "wap-", "wapa", "wapi", "wapp", "wapr", "webc", "winw", "winw", "xda ", "xda-"];
    if (in_array($mobile_ua, $mobile_agents)) {
        $mobile_browser++;
    }
    if (0 < strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "opera mini")) {
        $mobile_browser++;
        $stock_ua = strtolower(isset($_SERVER["HTTP_X_OPERAMINI_PHONE_UA"]) ? $_SERVER["HTTP_X_OPERAMINI_PHONE_UA"] : (isset($_SERVER["HTTP_DEVICE_STOCK_UA"]) ? $_SERVER["HTTP_DEVICE_STOCK_UA"] : ""));
        if (preg_match("/(tablet|ipad|playbook)|(android(?!.*mobile))/i", $stock_ua)) {
            $tablet_browser++;
        }
    }
    if (0 < $tablet_browser) {
        return "Tablet";
    }
    if (0 < $mobile_browser) {
        return "Mobile";
    }
    return "Computer";
}
function IsTorExitPoint()
{
    if (gethostbyname(ReverseIPOctets($_SERVER["REMOTE_ADDR"]) . "." . $_SERVER["SERVER_PORT"] . "." . ReverseIPOctets($_SERVER["SERVER_ADDR"]) . ".ip-port.exitlist.torproject.org") == "127.0.0.2") {
        return "True";
    }
    return "False";
}
function ReverseIPOctets($inputip)
{
    $ipoc = explode(".", $inputip);
    return $ipoc[3] . "." . $ipoc[2] . "." . $ipoc[1] . "." . $ipoc[0];
}

?>