<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';




	 $startvn = $_GET["startvn"];



	$sql = "select * from services where startvn =  '".$startvn."' and rounds = 'รอบ2'";
	$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
		
	$row_array['refill2'] = $row['refill2'];
	$row_array['refill2vn'] = $row['refill2vn'];
	$row_array['getdrug2'] = $row['getdrug2'];
	$row_array['getdrugdate2'] = $row['getdrugdate2'];
	
	


    array_push($return_arr,$row_array);
   }
 }
 







mysqli_close($conn);

echo json_encode($return_arr);

// print json_encode($rows);







?>