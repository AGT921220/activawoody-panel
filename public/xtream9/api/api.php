 <?php
ini_set('display_errors', 1);
include(__DIR__ . '/../includes/functions.php');
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if (isset($data['action']) && $data['action'] === "get-announcements") {
	$notes = $db->select('note', '*', '', '');
	foreach ($notes as $note) {
		$jdata[] = ['id' => $note['id'], 'title' => $note['note_title'], 'message' => $note['note_content'], 'created_on' => $note['createdate'],'seen' => 0];
	}
	echo '{"result":"success","sc":"' . $data['sc'] . '","message":"No Announcements Available","totalrecords":0,"data":'.json_encode($jdata).'}';
}