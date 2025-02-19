<?php

    $db = new SQLite3('./.db_ads.db');
    if (!$db) {
        die("Database connection error.");
    }

    $myadsstatus;
    $query = "SELECT * FROM adsstatus";
    $result = $db->query($query);
    
    if ($result) {
        echo "<ul>";
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $myadsstatus = $row['adstype'];
        }
        echo $myadsstatus;
        
        if($myadsstatus === 'Autoads'){
            header("Location: normalauto.php");
            $result->finalize();
            exit();
        }else{
            header("Location: menads.php");
            $result->finalize();            
            exit(); 
        }
        
    } else {
        echo "Error fetching records: " . $db->lastErrorMsg();
    }
    $db->close();

?>
