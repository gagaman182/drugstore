<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';




	 
 $date1 = $_GET["date1"];
 $date2 = $_GET["date2"];
 $drugstore = $_GET["drugstore"];
 $type = $_GET["type"];

//  $date1 = '2019-01-10';
//  $date2 = '2020-03-31';
//  $drugstore = 'หมอยา';
//  $type = '1';



if($type === '1'){



 $sql = "SELECT
 '1' as states,
 person.hn,
person.name,
services.startdrug,
services.drugstore


FROM
 services
inner join person on services.hn = person.hn
WHERE
 


services.drugstore like '".$drugstore."'
and 
startdrug BETWEEN '".$date1."' 
AND '".$date2."'



";
$return_arr = array();
if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
    $row_array['states'] = $row['states'];
	$row_array['hn'] = $row['hn'];
	$row_array['name'] = $row['name'];
	$row_array['startdrug'] = $row['startdrug'];
	 $row_array['drugstore'] = $row['drugstore'];
    array_push($return_arr,$row_array);
   }
 }
}elseif($type === '2'){
	$sql = "SELECT
	'2' as states,
	person.hn,
   person.name,
   services.datemonth3,
   services.drugstore
   
   
   FROM
	services
   inner join person on services.hn = person.hn
   WHERE
	
   
   
   services.drugstore like '".$drugstore."'
   and 
    datemonth3 BETWEEN '".$date1."' 
   AND '".$date2."'

   
   
   ";
   $return_arr = array();
   if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
		$row_array['states'] = $row['states'];
	$row_array['hn'] = $row['hn'];
	$row_array['name'] = $row['name'];
	$row_array['datemonth3'] = $row['datemonth3'];
	$row_array['drugstore'] = $row['drugstore'];
    array_push($return_arr,$row_array);
   }
 }
}elseif($type === '3'){
	$sql = "SELECT
	'3' as state,
	person.hn,
   person.name,
   services.datemonth6,
   services.drugstore
   
   
   FROM
	services
   inner join person on services.hn = person.hn
   WHERE
	
   
   
   services.drugstore like '".$drugstore."'
   and 
   datemonth6 BETWEEN '".$date1."' 
   AND '".$date2."'
   
   
   
   ";
   $return_arr = array();
     if ($result = mysqli_query( $conn, $sql )){
		while ($row = mysqli_fetch_assoc($result)) {
			$row_array['states'] = $row['states'];
		$row_array['hn'] = $row['hn'];
		$row_array['name'] = $row['name'];
		$row_array['datemonth6'] = $row['datemonth6'];
		$row_array['drugstore'] = $row['drugstore'];
		array_push($return_arr,$row_array);
	   }
	 }
}




mysqli_close($conn);

echo json_encode($return_arr);

// print json_encode($rows);







?>
