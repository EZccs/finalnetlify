<?php
header('Content-Type: text/html; charset=utf-8');
$server = "localhost:3306";
$user = "root";
$password = "1234";
$dbname = "injdatabase";

$db = new mysqli($server, $user, $password, $dbname);

function myquery($sql)
	{
		global $db;
		return $db->query($sql);
	}
?>
