<?php
$db = new SQLite3('./.db.db');
$res = $db->query('SELECT * FROM sports'); 
$row = $res->fetchArray(SQLITE3_ASSOC);
$headerName = $row['header_n'];
$bdColour = str_replace("#", "", $row['border_c']);
$bgColour = str_replace("#", "", $row['background_c']);
$txtColour = str_replace("#", "", $row['text_c']);
$days = $row['days'];
$key = $row['api'];
$url = "https://www.tvsportguide.com/widget/$key?filter_mode=all&filter_value=&days=$days&heading=$headerName&border_color=custom&autoscroll=1&prev_nonce=a7242d2019&custom_colors=$bdColour,$bgColour,$txtColour";
$response = file_get_contents($url);

$response = str_replace('<i class="gfx tvm-wlogo" target="_blank" style="display: inline-block !important;"></i>','',$response);

$response = str_replace('Presented by','',$response);

$response = str_replace('%%sitename%% %%page%% %%sep%% %%sitedesc%%','Sport Guide',$response);
echo $response;
                                                                        