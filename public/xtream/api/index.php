<?php
$action = $_GET['action'];
if ($action == 'eggnxt') {
	include('dns.php');
}
else if ($action == 'notenxt') {
	include('note.php');
}