<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';



	 $vn = $_GET["vn"];

	
	 $sql = "SELECT
	 num
	FROM
	 services
	 WHERE
	 startvn = '".$vn."'";
	
	

	
	if ($result = mysqli_query( $conn, $sql )){
		while ($row = mysqli_fetch_assoc($result)) {
		$numserivce = $row['num'];
		
	   }
	 }
	

	



	   
		  
		$sqldiag = "UPDATE diags SET servicenum='".$numserivce."'  WHERE vn = '".$vn."' ";
	  
	  
	  
	  
	  if ($conn->query($sqldiag) === TRUE) {
		  echo "ระบบทำงานเสร็จสมบูรณ์";
	  } else {
	  
		  echo "Error: " . $sql . "<br>" . $conn->error;
	  }
	  

	    
		$sqldrug = "UPDATE drugs SET servicenum='".$numserivce."'  WHERE vn = '".$vn."' ";
	  
	  
	  
	  
		if ($conn->query($sqldrug) === TRUE) {
			echo "ระบบทำงานเสร็จสมบูรณ์";
		} else {
		
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	  
	 
	   
	  mysqli_close($conn);









?>
