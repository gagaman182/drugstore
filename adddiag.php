<?php
header('Content-Type: text/html; charset=utf-8');
include 'conn.php';


$icdcode = $_GET["icdcode"];
$icdtype = $_GET["icdtype"];
$vn = $_GET["vn"];
$num = $_GET["num"];
// $icdcode = "i10";
// $icdtype = "p";
// $vn = "444";
$date = date('Y-m-d H:i:s');


	
$strdiag  = "  INSERT INTO diags(icdcode,icdtype,vn,stamptime,servicenum) VALUES('".$icdcode."','".$icdtype."','".$vn."','".$date."','".$num."')";
		if ($conn->query($strdiag) === TRUE) {
			echo "ระบบทำงานเสร็จสมบูรณ์";
			
				
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}



		$sql= "select num from services where startvn = '".$vn."'  ";
	









?>