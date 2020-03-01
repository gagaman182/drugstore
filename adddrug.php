<?php
header('Content-Type: text/html; charset=utf-8');
include 'conn.php';


$drugcode = $_GET["drugcode"];
$drugname = $_GET["drugname"];
$unit = $_GET["unit"];
$vn = $_GET["vn"];
$num = $_GET["num"];
// $icdcode = "i10";
// $icdtype = "p";
// $vn = "444";
$date = date('Y-m-d H:i:s');



	
$strdiag  = "  INSERT INTO drugs(drugcode,drugname,unit,vn,stamptime) VALUES('".$drugcode."','".$drugname."','".$unit."','".$vn."','".$date."')";
		if ($conn->query($strdiag) === TRUE) {
			echo "ระบบทำงานเสร็จสมบูรณ์";
			
				
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$sql= "select num from services where startvn = '".$vn."'  ";
		if ($result = mysqli_query($conn, $sql)) {
			// Fetch one and one row
			while ($row = mysqli_fetch_row($result)) {
				$numserivce =  $row[0];
		   
			  
			$sql = "UPDATE drugs SET servicenum='".$numserivce."'  WHERE vn = '".$vn."' ";
		  
		  
		  
		  
		  if ($conn->query($sql) === TRUE) {
			  echo "ระบบทำงานเสร็จสมบูรณ์";
		  } else {
		  
			  echo "Error: " . $sql . "<br>" . $conn->error;
		  }
		  
		  }
		  mysqli_free_result($result);
		  }
		   
		  






?>