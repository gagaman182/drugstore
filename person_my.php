<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';




// $query   = "select * from person";




 $sql = "select * from person";
// $result = mysqli_query($conn,$sql);


// $rows = array();
// while($r = mysqli_fetch_array($result,MYSQLI_NUM)) {
// 	$row[hn] = trim($row[hn]);
	
// }

$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
    $row_array['id'] = $row['id'];
	$row_array['hn'] = $row['hn'];
	$row_array['name'] = $row['name'];
	$row_array['sex'] = $row['sex'];
	$row_array['idcard'] = $row['idcard'];
	$row_array['tel'] = $row['tel'];


    array_push($return_arr,$row_array);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);

// print json_encode($rows);







?>
