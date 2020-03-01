<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';



	  $num = $_GET["num"];
	//  $num = '1';
	 



	$return_arr = array();



	$sqldiag = "DELETE FROM diags  WHERE servicenum = '".$num."'";


	if ($conn->query($sqldiag) === TRUE) {
		$row_array['messagedelete'] = "ลบข้อมูลบริการสำเร็จ";
		array_push($return_arr,$row_array);
	
	} else {
		$row_array['messagedelete'] =  "ลบข้อมูลไม่สำเร็จ" ;
		array_push($return_arr,$row_array);
	}
	
		$sqldrug = "DELETE FROM drugs  WHERE servicenum = '".$num."'";
	
	
		if ($conn->query($sqldrug) === TRUE) {
			$row_array['messagedelete2'] = "ลบข้อมูลบริการสำเร็จ";
			array_push($return_arr,$row_array);
		
		} else {
			$row_array['messagedelete2'] =  "ลบข้อมูลไม่สำเร็จ" ;
			array_push($return_arr,$row_array);
		}

mysqli_close($conn);

echo json_encode($return_arr);

// print json_encode($rows);







?>
