<?php
header('Content-Type: application/json');

// Debugging output
error_log("Starting API request handling");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['result' => 'error', 'message' => 'Only POST requests are allowed']);
    exit();
}

try {
    $db = new SQLite3('database.db');
} catch (Exception $e) {
    echo json_encode(['result' => 'error', 'message' => 'Database connection failed']);
    exit();
}

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
$action = $data['action'] ?? null;

if (!$action) {
    echo json_encode(['result' => 'error', 'message' => 'No action specified']);
    exit();
}

// Debugging output
error_log("Received action: " . $action);

switch ($action) {
    case 'check-maintainencemode':
        echo checkMaintenanceMode();
        break;
    case 'get_advertisemnt_status':
        echo getAdvertisementStatus();
        break;
    case 'get-advertisement':
        echo getadvertisement();
        break;
    case 'add-device':
        echo addDevice($data);
        break;
    case 'addreport':
        echo addReport($data);
        break;
    case 'addclientfeedback':
        echo addClientFeedback($data);
        break;
    case 'get-announcements':
        echo getAnnouncements($data);
        break;
    case 'read-announcement':
        echo readAnnouncements($data);
        break;
    case 'get_lastupdated':
        echo getLastUpdated($data);
        break;
    case 'get-enhanced-announcements':
        echo getEnhancedAnnouncement($data);
        break;
    case 'get-allcombinedashrequest':
        echo processAdData($data);
        break;
    case 'get-ovpnzip':
        echo getovpnzip();
        break;
    default:
        echo json_encode(['result' => 'error', 'message' => 'Invalid action']);
        break;
}

function getovpnzip() {
	if (!empty($_SERVER['HTTPS'])) {$proto = 'https';}else{$proto = 'http';}
	$current = "$proto://".$_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], "/"));
	echo '{"result":"success","sc":"fa059e4a456aec6e165fbe25085151c4","message":"Data retrieved successfully","vpnstatus":"on","link":"'.$current.'/vpn.php'.'"}';

}

function checkMaintenanceMode() {
	global $db;

	$result = $db->querySingle("SELECT title, body, mode FROM maintenance WHERE id=1", true);
	$sc = generateRandomSC();
	$response = [
		"result" => "success",
		"sc" => $sc,
		"maintenancemode" => $result['mode'] ?? 'off',
		"message" => $result['title'] ?? '',
		"footercontent" => $result['body'] ?? ''
	];

	return json_encode($response);
}

function getAdvertisementStatus() {
	global $db;

	$sc = generateRandomSC();
	$response = [
		"result" => "success",
		"sc" => $sc,
		"add_status" => '1',
		"add_viewable_rate" => '1',
		"message" => 'seccuesssssssss'
	];
	
	return json_encode($response);

}

function getLastUpdated() {
	global $db;

	$sc = generateRandomSC();
	$response = [
		"result" => "success",
		"sc" => $sc,
		"updated_on" => "2024-05-24 15:31:31"
	];
	
	return json_encode($response);

}

function getadvertisement() {
  global $db;
  $result = $db->querySingle("SELECT title, text FROM advertisement WHERE id=1", true);

  $response = json_encode([
    "result" => "success",
    "sc" => "95f052a144084c2ddf005edc0f2f55ca",
    "message" => "advertisement data",
    "totalrecords" => 1,
    "timeinterval" => "",
    "data" => [
      [
        "id" => rand(10, 99),
        "title" => $result['title'],
        "type" => "message",
        "pages" => "dashboard",
        "position" => "bottom",
        "schedule_type" => "alltime",
        "number" => "",
        "redirect_link" => "",
        "custom_recc" => "",
        "text" => $result['text']
      ]
    ]
  ]);

  return $response;
}



function addDevice($data) {
	global $db;

	$deviceid = $data['deviceid'] ?? '';
	$deviceusername = $data['deviceusername'] ?? '';
	$date = $data['d'] ?? '';

	$stmt = $db->prepare("INSERT OR REPLACE INTO devices(deviceid, deviceusername, added_on) VALUES (?, ?, ?)");
	$stmt->bindParam(1, $deviceid);
	$stmt->bindParam(2, $deviceusername);
	$stmt->bindParam(3, $date);
	$stmt->execute();
	$sc = generateRandomSC();
	$response = [
		"result" => "success",
		"sc" => $sc,
		"message" => "Details Updated Successfully"
	];

	return json_encode($response);
}

function addReport($data) {
	global $db;

	$stmt = $db->prepare("INSERT INTO reports (username, macaddress, section, section_category, report_title, report_sub_title, report_cases, report_custom_message, stream_name, stream_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

	if (!$stmt) {
		logError($db->lastErrorMsg());
		return json_encode(['result' => 'error', 'message' => 'Database error']);
	}
	$stmt->bindParam(1, $data['username']);
	$stmt->bindParam(2, $data['macaddress']);
	$stmt->bindParam(3, $data['section']);
	$stmt->bindParam(4, $data['section_category']);
	$stmt->bindParam(5, $data['report_title']);
	$stmt->bindParam(6, $data['report_sub_title']);
	$stmt->bindParam(7, $data['report_cases']);
	$stmt->bindParam(8, $data['report_custom_message']);
	$stmt->bindParam(9, $data['stream_name']);
	$stmt->bindParam(10, $data['stream_id']);

	if (!$stmt->execute()) {
		logError($db->lastErrorMsg());
		return json_encode(['result' => 'error', 'message' => 'Failed to add report']);
	}

	$sc = generateRandomSC();
	return json_encode([
		"result" => "success",
		"sc" => $sc,
		"message" => "Report added successfully"
	]);
}
function addClientFeedback($data) {
	global $db;

	$stmt = $db->prepare("INSERT INTO feedback (username, macaddress, feedback_content) VALUES (?, ?, ?)");

	$stmt->bindParam(1, $data['username']);
	$stmt->bindParam(2, $data['macaddress']);
	$stmt->bindParam(3, $data['feedback']);

	$stmt->execute();

	$response = [
		"result" => "success",
		"message" => "Feedback sent successfully!"
	];

	return json_encode($response);
}


function getAnnouncements($data) {
    global $db;
    
    $deviceId = $data['deviceid'] ?? null;
    if (!$deviceId) {
        return json_encode(['result' => 'error', 'message' => 'Device ID is required']);
    }

    $announcements = [];
    $result = $db->query("SELECT * FROM announcements ORDER BY created_on DESC");
    
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $stmt = $db->prepare("SELECT 1 FROM announcement_views WHERE announcement_id = ? AND deviceid = ?");
        $stmt->bindParam(1, $row['id']);
        $stmt->bindParam(2, $deviceId);
        $seenResult = $stmt->execute();
        $seen = $seenResult->fetchArray(SQLITE3_ASSOC) ? 1 : 0;

        if ($seen === 0) {
            $stmt = $db->prepare("INSERT INTO announcement_views (announcement_id, deviceid) VALUES (?, ?)");
            $stmt->bindParam(1, $row['id']);
            $stmt->bindParam(2, $deviceId);
            $stmt->execute();
        }

        $announcements[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'message' => $row['message'],
            'created_on' => $row['created_on'],
            'seen' => $seen
        ];
    }
    
    $sc = generateRandomSC();
    
    return json_encode([
        "result" => "success",
        "sc" => $sc,
        "message" => count($announcements) ? "Announcements fetched successfully" : "No announcements",
        "totalrecords" => count($announcements),
        "data" => $announcements
    ]);
}

function readAnnouncements($data) {
    global $db;

    $deviceId = $data['deviceid'] ?? null;
    $announcementId = $data['announcementid'] ?? null;

    if (!$deviceId || !$announcementId) {
        return json_encode(['result' => 'error', 'message' => 'Device ID and Announcement ID are required']);
    }

    $stmt = $db->prepare("INSERT OR IGNORE INTO announcement_views (announcement_id, deviceid) VALUES (?, ?)");
    $stmt->bindParam(1, $announcementId);
    $stmt->bindParam(2, $deviceId);

    if ($stmt->execute()) {
        return json_encode(['result' => 'success', 'message' => 'Announcement marked as read']);
    } else {
        return json_encode(['result' => 'error', 'message' => 'Failed to mark announcement as read']);
    }
}


function getAnnouncement($data) {
    global $db;
    
    $announcements = [];
    $result = $db->query("SELECT * FROM announcements ORDER BY created_on DESC");
    if (!$result) {
        die(json_encode(['error' => $db->lastErrorMsg()]));
    }    
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $announcements[] = $row;
    }
    
    $responseData = [];
    foreach ($announcements as $announcement) {
        $stmt = $db->prepare("SELECT 1 FROM announcement_views WHERE announcement_id = ? AND deviceid = ?");
        $stmt->bindParam(1, $announcement['id']);
        $stmt->bindParam(2, $data['deviceid']);
        $res = $stmt->execute();
        $seen = $res->fetchArray(SQLITE3_ASSOC) ? 1 : 0;
    
        if ($seen === 0) {
            $stmt = $db->prepare("INSERT INTO announcement_views (announcement_id, deviceid) VALUES (?, ?)");
            $stmt->bindParam(1, $announcement['id']);
            $stmt->bindParam(2, $data['deviceid']);
            $stmt->execute();
        }
    
        $responseData[] = [
            'id' => $announcement['id'],
            'title' => $announcement['title'],
            'message' => $announcement['message'],
            'whmcs_userid' => '56237',
            'whmcs_serviceid' => '115764',
            'created_on' => $announcement['created_on'],
            'updated_on' => '2024-05-24 15:31:31',
            'seen' => '0'
        ];
    }
    
    $sc = generateRandomSC();
    
    return json_encode([
        "result" => "success",
        "sc" => $sc,
        "message" => count($responseData) ? "Announcements fetched successfully" : "No announcements",
        "totalrecords" => count($responseData),
        "data" => $responseData
    ]);
}


function getEnhancedAnnouncement($data) {
    $sc = "bc0a0dc7beaf1a6a7f13bc9056b7da8f";
    $rewardedAds = [
        'add_status' => '1', 
        'add_viewable_rate' => '2', 
        'add_type' => 'rewarded', 
        'message' => 'advertisement data', 
        'data' => []
    ];
    $dashboardAds = [
        'add_status' => '1', 
        'message' => 'advertisement data', 
        'data' => []
    ];

    $response = [
        "result" => "success",
        "sc" => $sc,
        "rewarded" => $rewardedAds,
        "dashboard" => $dashboardAds
    ];

    return json_encode($response);
}

function processAdData() {
    global $db;

    // Check if TMDB API function is enabled
    $tmdbApiEnabled = $db->querySingle("SELECT tmdb_api_enabled FROM settings WHERE id=1");

    // Retrieve the rewarded ads text from the ads table
    $rewardedResult = $db->querySingle("SELECT text FROM ads WHERE id=1", true);
    if (!$rewardedResult) {
        return json_encode([
            "result" => "error",
            "message" => "Failed to retrieve rewarded ads data"
        ]);
    }

    $rewardedAds = [
        [
            "id" => rand(10, 99),
            "title" => "Bet3", 
            "type" => "message",
            "pages" => "dashboard",
            "position" => "top",
            "schedule_type" => "alltime",
            "number" => "",
            "redirect_link" => "",
            "custom_recc" => "",
            "text" => $rewardedResult['text'],
            "images" => []
        ]
    ];

    // Retrieve the ads2 text
    $ads2TextResult = $db->querySingle("SELECT text FROM ads2 WHERE id=1", true);

    // Retrieve the images associated with ads2 from the ads2_images table
    $imagesResult = $db->query("SELECT url FROM ads2_images WHERE ads2_id=1");
    $images = [];
    while ($row = $imagesResult->fetchArray(SQLITE3_ASSOC)) {
        $images[] = $row['url'];
    }

    // Include TMDB data if the function is enabled
    if ($tmdbApiEnabled) {
        $tmdbData = fetchTMDBData();
        foreach ($tmdbData as $data) {
            $images[] = $data['artWork'];
        }
    }

    $dashboardAds = [
        [
            "id" => rand(1000, 9999),
            "title" => "Bet3", 
            "type" => "image",
            "pages" => "dashboard",
            "position" => "top",
            "schedule_type" => "alltime",
            "number" => "",
            "redirect_link" => "",
            "custom_recc" => "",
            "images" => $images,
            "text" => $ads2TextResult ? $ads2TextResult['text'] : ''
        ]
    ];

    $response = [
        "result" => "success",
        "sc" => "3e7a97f0e75fd54f5c88e8bf144edcc5",
        "rewarded" => [
            "add_status" => "1",
            "add_viewable_rate" => "5",
            "add_type" => "rewarded",
            "message" => "ads data",
            "totalrecords" => count($rewardedAds),
            "timeinterval" => "",
            "data" => $rewardedAds
        ],
        "dashboard" => [
            "add_status" => "1",
            "message" => "ads data",
            "totalrecords" => count($dashboardAds),
            "timeinterval" => "",
            "data" => $dashboardAds
        ]
    ];

    return json_encode($response);
}


function fetchTMDBData() {
    // Fixed TMDB API key
    $api_key = '6ca3392e2903d0ddafc2dae3044ee31f';

    $language = "en-US";
    $movies_url = "https://api.themoviedb.org/3/trending/movie/week?api_key=$api_key&language=$language";
    $shows_url = "https://api.themoviedb.org/3/trending/tv/week?api_key=$api_key&language=$language";

    $movies_data = fetchApiData($movies_url);
    $shows_data = fetchApiData($shows_url);

    $combined_data = [];
    $numMovies = count($movies_data['results']);
    $numShows = count($shows_data['results']);
    $maxCount = max($numMovies, $numShows);

    for ($i = 0; $i < $maxCount; $i++) {
        if ($i < $numMovies) {
            $movie = $movies_data['results'][$i];
            $combined_data[] = [
                "id" => $movie['id'],
                "artWork" => 'https://image.tmdb.org/t/p/original' . $movie['poster_path'],
                "title" => $movie['title'],
            ];
        }

        if ($i < $numShows) {
            $show = $shows_data['results'][$i];
            $combined_data[] = [
                "id" => $show['id'],
                "artWork" => 'https://image.tmdb.org/t/p/original' . $show['poster_path'],
                "title" => $show['name'],
            ];
        }
    }

    return $combined_data;
}

function fetchApiData($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

function generateRandomSC() {
	$randomBytes = random_bytes(16); 
	return bin2hex($randomBytes); 
}

function logError($errorMessage) {
	$date = date('Y-m-d H:i:s');
	$message = "[{$date}] {$errorMessage}\n";

	file_put_contents('errors.log', $message, FILE_APPEND);
}

?>
