<?php

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

$db = new SQLite3('./.db.db');
if (!$db) {
    die("Connection failed: " . $db->lastErrorMsg());
}
$query = "CREATE TABLE IF NOT EXISTS rtxreport (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    sc TEXT,
    action TEXT,
    username TEXT,
    macaddress TEXT,
    section TEXT,
    section_category TEXT,
    report_title TEXT,
    report_sub_title TEXT,
    report_cases TEXT,
    report_custom_message TEXT,
    stream_name TEXT,
    stream_id INTEGER,
    dates TEXT
)";

if (!$db->exec($query)) {
    die("Error creating table: " . $db->lastErrorMsg());
}

$seenquery = "CREATE TABLE IF NOT EXISTS rtxseen (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    deviceid TEXT,
    announcement_id TEXT,
    rtxseens INTEGER
)";

$db->exec($seenquery);

$feedbackquery = "CREATE TABLE IF NOT EXISTS rtxfeedback (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    username TEXT,
    macaddress TEXT,
    feedback TEXT
)";
$db->exec($feedbackquery);


if (isset($data['action']) && $data['action'] === "get_advertisemnt_status") {
    


    $statment = '{"result":"success","sc":"' . $data['sc'] . '","add_status":"1","add_viewable_rate":"2","add_type":"rewarded","message":"Record fetch successfully"}';
    
    echo $statment;
    
} else if (isset($data['action']) && $data['action'] === "get-announcements") {
    
        $note = $db->query('SELECT * FROM note');
        
        
        function checkid($deviceid, $announcement_id) {
            $db = new SQLite3('./.db.db');
            $checkQuery = "SELECT COUNT(*) AS count FROM rtxseen WHERE deviceid = :deviceid AND announcement_id = :announcement_id";
        
            $stmt = $db->prepare($checkQuery);
            $stmt->bindValue(':deviceid', $deviceid, SQLITE3_TEXT);
            $stmt->bindValue(':announcement_id', $announcement_id, SQLITE3_TEXT);
        
            $result = $stmt->execute();
            $row = $result->fetchArray(SQLITE3_ASSOC);
            $db->close();
            
            
            if ($row['count'] > 0) {
               return 1;
            } else {
               return 0;
            }
        }
        

        while ($notes = $note->fetchArray(SQLITE3_ASSOC)) {
        	$cdata[] = ['id' => $notes['Title'], 'title' => $notes['Title'], 'message' => $notes['Description'], 'created_on' => $notes['CreateDate'],'seen' => checkid($data['deviceid'], $notes['Title'])];
        }
        
        $jdata = json_encode($cdata);
        $annousement = '{"result":"success","sc":"' . $data['sc'] . '","message":"No Announcements Available","totalrecords":0,"data":'.$jdata.'}';
    
        echo $annousement;
    
}else if (isset($data['action']) && $data['action'] === "addreport") {
    
    
        function Jsonissu($jsonissu){
            
                $first = str_replace('\\u0027', "'", $jsonissu);
                $second = str_replace('["', "❌ ", $first);
                $therd = str_replace('"]', "", $second);
                $forth = str_replace('","', "<br>❌ ", $therd);
                
                return $forth;
            
        }
        
        function addNewlinesEvery30Chars($text) {
            if (!empty($text)) {
                $lines = str_split($text, 80);
                $result = implode("<br>", $lines);
                
                return $result;
            } else {
                return '';
            }
        }
    
        $stmt = $db->prepare("INSERT INTO rtxreport (sc, action, username, macaddress, section, section_category, report_title, report_sub_title, report_cases, report_custom_message, stream_name, stream_id, dates) 
                             VALUES (:sc, :action, :username, :macaddress, :section, :section_category, :report_title, :report_sub_title, :report_cases, :report_custom_message, :stream_name, :stream_id, :dates)");
        

        $stmt->bindValue(':sc', $data['sc']);
        $stmt->bindValue(':action', $data['action']);
        $stmt->bindValue(':username', $data['username']);
        $stmt->bindValue(':macaddress', $data['macaddress']);
        $stmt->bindValue(':section', $data['section']);
        $stmt->bindValue(':section_category', $data['section_category']);
        $stmt->bindValue(':report_title', $data['report_title']);
        $stmt->bindValue(':report_sub_title', $data['report_sub_title']);
       /* $stmt->bindValue(':report_cases', $data['report_cases']); */
        $stmt->bindValue(':report_cases', Jsonissu($data['report_cases']));
        /*$stmt->bindValue(':report_custom_message', $data['report_custom_message']);*/
        $stmt->bindValue(':report_custom_message', addNewlinesEvery30Chars($data['report_custom_message']));
        $stmt->bindValue(':stream_name', $data['stream_name']);
        $stmt->bindValue(':stream_id', $data['stream_id']);
        $stmt->bindValue(':dates', date("Y-m-d"));
        $result = $stmt->execute();
    

    
    
    $report_sucsess = '{"result":"success","sc":"' . $data['sc'] . '","message":"Report send sucessfully!"}';
    
    $report_notsucsess = '{"result":"success","sc":"' . $data['sc'] . '","message":"Report not send sucessfully!"}';
    
    if ($result) {
        echo $report_sucsess;
    } else {
        echo $report_notsucsess;
    }
    
    $db->close();
}else if (isset($data['action']) && $data['action'] === "hddgfhfghs=") {
    
    $maintaince = '{"result":"success","sc":"' . $data['sc'] . '","maintenancemode":"off","message":"We apologize for any inconvenience caused! Our App is presently undergoing maintenance to enhance your experience. We will be back up and running soon. Thank you for being so patient!","footercontent":"This App is under Working Plesae wait for sometime"}';
    
    echo $maintaince;

}else if (isset($data['action']) && $data['action'] === "get-ovpnzip") {
    
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $domain = $_SERVER['HTTP_HOST'];
    $currentScript = $_SERVER['PHP_SELF'];
    $currentUrl = $protocol . $domain . $currentScript;
    
    $modifiedString = str_replace('/api.php', '/vpnk.php', $currentUrl);
    
    
   $ppn = '{"result":"success","message":"Data retrieved successfully","vpnstatus":"on","link":"'.$modifiedString.'"}';


    echo $ppn;

}else if (isset($data['action']) && $data['action'] === "read-announcement") {
    
    $deviceid = $data['deviceid'];
    $announcement_id = $data['announcement_id'];
    
    $insertQuery = "INSERT INTO rtxseen (deviceid, announcement_id, rtxseens) VALUES (:deviceid, :announcement_id, 1)";
    
    $stmt = $db->prepare($insertQuery);
    $stmt->bindValue(':deviceid', $deviceid, SQLITE3_TEXT);
    $stmt->bindValue(':announcement_id', $announcement_id, SQLITE3_TEXT);
    
    $report_seen = '{"result":"success","sc":"' . $data['sc'] . '","message":"Report send sucessfully!"}';
    
    $report_notseen = '{"result":"success","sc":"' . $data['sc'] . '","message":"Report not send sucessfully!"}';
    
    
    if ($stmt->execute()) {
        echo  $report_seen;
    } else {
        echo $report_notseen;
    }

}else if (isset($data['action']) && $data['action'] === "addclientfeedback") {
    
    $stmt = $db->prepare("INSERT INTO rtxfeedback (username , macaddress , feedback) 
                             VALUES (:username, :macaddress, :feedback)");
                             
    $stmt->bindValue(':username', $data['username']);
    $stmt->bindValue(':macaddress', $data['macaddress']);
    $stmt->bindValue(':feedback', $data['feedback']);   
    $result = $stmt->execute();
    
    
    $report_sucsess = '{"result":"success","message":"Feedback send successfully!"}';
    
    $report_notsucsess = '{"result":"success","message":"Feedback not send successfully!"}';
    
    if ($result) {
        echo $report_sucsess;
    } else {
        echo $report_notsucsess;
    }
    
    $db->close();

}else if (isset($data['action']) && $data['action'] === "get-advertisement") {
    
    $dbs = new SQLite3('./.db_inapp_ads.db');
    if (!$dbs) {
        die("Database connection error.");
    }

    $myadsstatus;
    $adsqty;
    $query = "SELECT * FROM textadstext";
    $result = $dbs->query($query);
    
    $query2 = "SELECT * FROM adsstatus";
    $result2 = $dbs->query($query2);
    
    if ($result) {
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $myadsstatus = $row['textads'];
        }
        
        while ($row = $result2->fetchArray(SQLITE3_ASSOC)) {
            if($row['adstype']=== 'ON'){
                $adsqty = '2';
            }else{
                $adsqty = '0';
            }
            
        }
        
        $topads = '{"result":"success","sc":"' . $data['sc'] . '","message":"advertisement data","totalrecords":'.$adsqty.',"timeinterval":"","data":[{"id":"105","title":"GREETING","type":"message","pages":"dashboard","position":"top","schedule_type":"alltime","number":"","redirect_link":"","custom_recc":"","text":"'.$myadsstatus.'","images":[""]}]}';
        
        echo $topads;
    } else {
        echo "Error fetching records: " . $db->lastErrorMsg();
    }
    
    
    
    
    
    
    
    $dbs->close();


}


?>

