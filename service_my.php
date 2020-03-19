<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';




	 $hn = $_GET["hn"];





 $sql = "select * from services where hn =  '".$hn."'";





$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
    $row_array['num'] = $row['num'];
	$row_array['hn'] = $row['hn'];
	$row_array['year'] = $row['year'];
	$row_array['startdrug'] = $row['startdrug'];
	$row_array['startvn'] = $row['startvn'];
	$row_array['appointdocotor1'] = $row['appointdocotor1'];
	$row_array['seedoctor1'] = $row['seedoctor1'];
	$row_array['seedoctordate1'] = $row['seedoctordate1'];
	$row_array['datemonth3'] = $row['datemonth3'];
	$row_array['datemonth6'] = $row['datemonth6'];




    array_push($return_arr,$row_array);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);

// print json_encode($rows);







?>
