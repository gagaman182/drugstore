<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';


 $sql = "SELECT
 'คนไข้ทั้งหมด' as name,
 count(case when startdrug <>''  then num end)  as data
     FROM
 services
 UNION ALL
 SELECT
 'refill ยา ครั้งที่ 1' as name,
 count(case when refill1 <>''  then num end)  as data
 FROM
 services
 UNION ALL
 SELECT
 'refill ยา ครั้งที่ 2' as name,
 count(case when refill2 <>''  then num end)  as data
         FROM
 services
 
 
     
 
 
 
     
 
 ";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	$row_array['name'] = $row['name'];
	$row_array['data'] =  array(intval($row['data']));
	
	
	
    array_push($return_arr,$row_array);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);


// $a = array ('a' => 'apple', 'b' => 'banana', 'c' => array ('x', 'y', 'z'));


// echo json_encode($a);



?>
