<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for SourceGuardian Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/

$db = new SQLite3("./data/.boxbr_sports.db");
                    $res = $db->query("SELECT * FROM boxbrsports");
                    $row = $res->fetchArray(SQLITE3_ASSOC);
                    if ($row["type"] == "0") {
                        $_1 = $row["header_n"];
                        $_2 = str_replace("#", "", $row["border_c"]);
                        $_3 = str_replace("#", "", $row["background_c"]);
                        $_4 = str_replace("#", "", $row["text_c"]);
                        $_5 = $row["days"];
                        $_6 = $row["auto_s"];
                        $api = $row["api"];
                        $url = "https:\\/\\/www.tvsportguide.com\\/widget\\/" . $api . "?filter_mode=all&filter_value=&days=" . $_5 . "&heading=" . $_1 . "&border_color=custom&autoscroll=" . $_6 . "&prev_nonce=a7242d2019&custom_colors=" . $_2 . "," . $_3 . "," . $_4;
                    } else {
                        if ($row["type"] == "2") {
                            $url = html_entity_decode($row["urljs"]);
                        } else {
                            $url = $row["url"];
                        }
                    }
                    echo "\r\n<html>\r\n<head>\r\n<title>BoxBR Apks Rebrand - Sports Events\r\n</title>\r\n<meta http-equiv=\"Cache-Control\" content=\"no-cache, no-store, must-revalidate\" />\r\n<meta http-equiv=\"Pragma\" content=\"no-cache\" />\r\n<meta http-equiv=\"Expires\" content=\"0\" />\r\n\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0,text/html,charset=utf-8\">\r\n\t\r\n\t<style>\r\n\tbody {\r\n\tbackground: black;\r\n\t\tmargin: 0;\r\n\t\t/* Reset default margin */\r\n  background-size: 100% 100%;\r\n  background-attachment: fixed;\r\n  background-position: center;\r\n  \r\n  background-repeat: no-repeat;}\r\n\t}\r\n\tiframe {\r\n\t\tdisplay: block;\r\n\t\tbackground: transparent;\r\n\t\tborder: none;\r\n\t\theight: 100vh;\r\n\t\twidth: 100vw;\r\n\t}\r\n\t.container {\r\n  position: relative;\r\n  overflow: hidden;\r\n  width: 100%;\r\n  padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */\r\n}\r\n\r\n/* Then style the iframe to fit in the container div with full height and width */\r\n.responsive-iframe {\r\n  position: absolute;\r\n  top: 0;\r\n  left: 0;\r\n  bottom: 0;\r\n  right: 0;\r\n  width: 100%;\r\n  height: 100%;\r\n}\r\n\tdiv {\r\n\r\n    background: transparent;\r\n\r\n    width: 70vw;\r\n    position: relative;\r\n    top: 50%;\r\n    transform: translateY(-50%);\r\n    margin: 0 auto;\r\n    padding: 30px 30px 10px;\r\ndisplay: none;\r\n    z-index: 3;\r\n}\r\n\r\n\t</style>\r\n</head>\r\n<body bgcolor=\"black\">\r\n\t ";
                    if ($row["type"] == "2") {
                        echo $url;
                        echo "\r\n    <script type=\"text/javascript\" src=\"//code.jquery.com/jquery-1.7.js\"></script>\r\n    <script type=\"text/javascript\">\r\n   (function(){\r\n    var 1box=document.getElementById('box');\r\n\r\n    function infScroll(){\r\n        box.scrollTop +=1;\r\n        if(box.scrollTop===3000){\r\n            box.scrollTop=0;\r\n        }\r\n        window.requestAnimationFrame(infScroll);\r\n    }\r\n    window.requestAnimationFrame(infScroll);\r\n}());\r\n\r\n</script> ";
                    } else {
                        echo "\r\n<iframe  class=\"responsive-iframe\" allowtransparency=\"true\" style=\"background: transparent;\" id=\"iframe\" src=\"" . $url . "\" frameborder=\"0\"></iframe>\r\n";
                    }
                    echo "\r\n</body>\r\n</html> ";

?>