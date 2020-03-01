<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';




	 $id = $_GET["id"];




 $sql = "SELECT
 person.hn,
person.name,
person.sex,
person.idcard,
person.tel,
person.address



FROM
person

WHERE
 id = '".$id."'";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	$row_array['hn'] = $row['hn'];
	$row_array['name'] = $row['name'];
	$row_array['sex'] = $row['sex'];
	$row_array['idcard'] = $row['idcard'];
	$row_array['tel'] = $row['tel'];
	$row_array['address'] = $row['address'];
	
	





    array_push($return_arr,$row_array);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);









?>
