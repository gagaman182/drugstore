<?php
// header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include 'conn.php';
  // $hn = '2/49';
$hn = $_GET["hn"];
$name = $_GET["name"];

$sex = $_GET["sex"];
$idcard = $_GET["idcard"];
$tel = $_GET["tel"];
$address = $_GET["address"];
$doctor = $_GET["doctor"];
$drugstore = $_GET["drugstore"];
$startdrug = $_GET["startdrug"];
$drugrefill3m = $_GET["drugrefill3m"];
$drugrefill6m = $_GET["drugrefill6m"];
$startvn = $_GET["startvn"];
 $drugtype1 = $_GET["drugtype1"];
 $drugtype4 = $_GET["drugtype4"];

 $refill1 = $_GET["refill1"];
 $refill1vnuse = $_GET["refill1vnuse"];
 $refill2 = $_GET["refill2"];
 $refill2vnuse = $_GET["refill2vnuse"];

 $getdrug1 = $_GET["getdrug1"];
 $getdrugdate1 = $_GET["getdrugdate1"];
 $seedoctor1 = $_GET["seedoctor1"];
 $seedoctordate1 = $_GET["seedoctordate1"];
//  $rounds = $_GET["rounds"];
$year = $_GET["year"];
 $getdrug2 = $_GET["getdrug2"];
 $getdrugdate2 = $_GET["getdrugdate2"];



 $date = date('Y-m-d H:i:s');

 	//last num in services
	 $lastidperson = "select max(id) from person ";
	
	 if ($resultperson = $conn -> query($lastidperson)) {
		 while ($rowperson = $resultperson -> fetch_row()) {
			 $numperson = $rowperson[0];
			 $numperson++;
		
if (isset($hn)) {
	//insert person
	$strperson  = " INSERT INTO person(id,hn,name,sex,idcard,tel,address,stamptime) VALUES('".$numperson."','".$hn."','".$name."','".$sex."','".$idcard."','".$tel."','".$address."','".$date."')";
	if ($conn->query($strperson) === TRUE) {
		// echo "ระบบทำงานเสร็จสมบูรณ์";
		
		$return_message = array();
		$row_array['message'] = "เพิ่มข้อมูลบุคคลสำเร็จ";
		array_push($return_message,$row_array);
	
	
	} else {
		// echo "Error: " . $sql . "<br>" . $conn->error;
		$return_message = array();
		$row_array['message'] = "เพิ่มข้อมูลไม่สำเร็จหรือมีข้อมูลแล้ว";
		array_push($return_message,$row_array);
		
	}

}
		 
}

	//last num in services
	$lastid = "select max(num) from services ";
	
	if ($result = $conn -> query($lastid)) {
		while ($row = $result -> fetch_row()) {
			$num = $row[0];
			$num++;
		}
		
	  }
	  
	  //insert service
$strservice  = " INSERT INTO services(num,hn,doctor,drugstore,startdrug,startvn,refill1,refill1vn,refill2,refill2vn,appointdocotor1,stamptime,getdrug1,getdrugdate1,seedoctor1,seedoctordate1,year,getdrug2,getdrugdate2,datemonth3,datemonth6) 
VALUES('".$num."','".$hn."','".$doctor."','".$drugstore."','".$startdrug."','".$startvn."','".$refill1."','".$refill1vnuse."','".$refill2."','".$refill2vnuse."','".$appointdocotor1."','".$date."','".$getdrug1."','".$getdrugdate1."','".$seedoctor1."',
'".$seedoctordate1."','".$year."','".$getdrug2."','".$getdrugdate2."','".$drugrefill3m."','".$drugrefill6m."')";
	
		if ($conn->query($strservice) === TRUE) {
			// echo "ระบบทำงานเสร็จสมบูรณ์";
		$return_messag = array();
		$row_array['message2'] = "เพิ่มข้อมูลรับบริการสำเร็จ";
		array_push($return_message,$row_array);
			
				
		} else {
			//  echo "Error: " . $sql . "<br>" . $conn->error;
			$return_message= array();
		$row_array['message2'] = "เพิ่มข้อมูลไม่สำเร็จหรือมีข้อมูลแล้ว";
		array_push($return_message,$row_array);
		
		}


	
}else{
	echo "เพิ่มข้อมูลไม่สำเร็จ";
}


mysqli_close($conn);
	
echo json_encode($return_message);




?>