<?php
$functionsFile = "../includes/functions.php";
include($functionsFile);
$row = loadSportsOptions();
$headerName = $row['header_name'];
$bdColour = str_replace("#", "", $row['border_colour']);
$bgColour = str_replace("#", "", $row['background_colour']);
$txtColour = str_replace("#", "", $row['text_colour']);
$days = 5;
$key = $row['api_key'];
$url = "https://www.tvsportguide.com/widget/$key?filter_mode=all&filter_value=&days=$days&heading=$headerName&border_color=custom&autoscroll=1&prev_nonce=a7242d2019&custom_colors=$bdColour,$bgColour,$txtColour";
$response = file_get_contents($url);
$response = str_replace('<i class="gfx tvm-wlogo" target="_blank" style="display: inline-block !important;"></i>','',$response);
$response = str_replace('Presented by','',$response);
$response = str_replace('%%sitename%% %%page%% %%sep%% %%sitedesc%%','Sports Guide',$response);
echo $response;