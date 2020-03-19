<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';




	 $num = $_GET["num"];




 $sql = "SELECT
 
 person.hn,
person.name,
person.sex,
person.idcard,
person.tel,
person.address,
services.year,
services.num,
services.drugstore,
services.doctor,
services.startvn,
services.startdrug,
services.refill1vn,
services.refill1,
services.getdrug1,
services.getdrugdate1,
services.refill2vn,
services.refill2,
services.getdrug2,
services.getdrugdate2,
services.appointdocotor1,
services.seedoctor1,
services.seedoctordate1,
services.datemonth3,
services.datemonth6



FROM
 services
inner join person on services.hn = person.hn
WHERE
num = '".$num."'";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {

	$row_array['hn'] = $row['hn'];
	$row_array['name'] = $row['name'];
	$row_array['sex'] = $row['sex'];
	$row_array['idcard'] = $row['idcard'];
	$row_array['tel'] = $row['tel'];
	$row_array['year'] = $row['year'];
	$row_array['address'] = $row['address'];
	$row_array['num'] = $row['num'];
	$row_array['drugstore'] = $row['drugstore'];
	$row_array['doctor'] = $row['doctor'];
	$row_array['startvn'] = $row['startvn'];
	$row_array['startdrug'] = $row['startdrug'];
	$row_array['refill1vn'] = $row['refill1vn'];
	$row_array['refill1'] = $row['refill1'];
    $row_array['getdrug1'] = $row['getdrug1'];
	$row_array['getdrugdate1'] = $row['getdrugdate1'];
	$row_array['refill2vn'] = $row['refill2vn'];
	$row_array['refill2'] = $row['refill2'];
	$row_array['getdrug2'] = $row['getdrug2'];
	$row_array['getdrugdate2'] = $row['getdrugdate2'];
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









?>
