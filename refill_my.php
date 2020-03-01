<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';




	 $startvn = $_GET["startvn"];




	$sql = "select * from services where startvn =  '".$startvn."' and rounds = 'รอบ1'";
	$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
		
	$row_array['refill1'] = $row['refill1'];
	$row_array['refill1vn'] = $row['refill1vn'];
	$row_array['getdrug1'] = $row['getdrug1'];
	$row_array['getdrugdate1'] = $row['getdrugdate1'];
	
	


    array_push($return_arr,$row_array);
   }
 }
 







mysqli_close($conn);

echo json_encode($return_arr);

// print json_encode($rows);







?>