<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';



	$num = '1';
	//   $num = $_GET["num"];




 $sql = "SELECT * FROM services WHERE num = '".$num."'";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	$row_array['datemonth3'] = $row['datemonth3'];
	$row_array['datemonth6'] = $row['datemonth6'];





    array_push($return_arr,$row_array);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);









?>
