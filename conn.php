<?php


// $conn = @mysql_connect('192.168.4.3','root','1234');

// if (!$conn) {
// 	die('Could not connect: ' . mysql_error());
// }
// mysql_select_db('drugs', $conn);
// mysql_query("SET NAMES UTF8");

$servername = "192.168.4.3";
$username = "root";
$password = "1234";
$dbname = "drugs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn -> set_charset("utf8");

?>