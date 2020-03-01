<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';




	 
 $date1 = $_GET["date1"];
 $date2 = $_GET["date2"];






 $sql = "SELECT
 person.hn,
person.name,
services.datemonth3,
services.datemonth6


FROM
 services
inner join person on services.hn = person.hn
WHERE
 (datemonth3 BETWEEN '".$date1."'
AND '".$date2."')
OR (datemonth6 BETWEEN '".$date1."'
AND '".$date2."')
";





$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	$row_array['hn'] = $row['hn'];
	$row_array['name'] = $row['name'];
	$row_array['datemonth3'] = $row['datemonth3'];
	$row_array['datemonth6'] = $row['datemonth6'];
	
	


    array_push($return_arr,$row_array);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);

// print json_encode($rows);







?>
