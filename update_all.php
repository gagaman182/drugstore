<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';

     $num = $_GET["num"];
	 $hn = $_GET["hn"];
	 $name = $_GET["name"];
	 $sex = $_GET["sex"];
	 $idcard = $_GET["idcard"];
	 $tel = $_GET["tel"];

	 $rounds = $_GET["rounds"];
	 $drugstore = $_GET["drugstore"];
	 $doctor = $_GET["doctor"];
	 $startdrug = $_GET["startdrug"];
	 $startvn = $_GET["startvn"];
	 $drugrefillm3 = $_GET["startdrug"];
$drugrefillm6 = $_GET["startdrug"];

	 $refill1vn = $_GET["refill1vn"];
	 $refill1 = $_GET["refill1"];
	 $getdrug1 = $_GET["getdrug1"];
	 $getdrugdate1 = $_GET["getdrugdate1"];
	 $refill2vn = $_GET["refill2vn"];
	 $refill2 = $_GET["refill2"];
	 $getdrug2 = $_GET["getdrug2"];
	 $getdrugdate2 = $_GET["getdrugdate2"];
	 $appointdocotor1 = $_GET["appointdocotor1"];
	 $seedoctor1 = $_GET["seedoctor1"];
	 $seedoctordate1 = $_GET["seedoctordate1"];

	 $drugcode = $_GET["drugcode"];
	 $drugname = $_GET["drugname"];
	 $unit = $_GET["unit"];
	 $icdcode = $_GET["icdcode"];
	 $icdtype = $_GET["icdtype"];
	
	 $date = date('Y-m-d H:i:s');

	


	 $return_arr = array();



 $sql = "UPDATE person SET hn='".$hn."' ,name = '".$name."',sex = '".$sex."',idcard = '".$idcard."',tel = '".$tel."' WHERE hn = '".$hn."' ";




if ($conn->query($sql) === TRUE) {
	$row_array['message'] = "แก้ไขข้อมูลบุคคลสำเร็จ";
	array_push($return_arr,$row_array);
} else {
	$row_array['message'] =  "แก้ไขข้อมูลบุคคลไม่สำเร็จ " ;
	array_push($return_arr,$row_array);
}


$sql2 = "UPDATE services SET rounds='".$rounds."' ,drugstore = '".$drugstore."', doctor = '".$doctor."' ,startdrug = '".$startdrug."',startvn = '".$startvn."' ,
refill1vn = '".$refill1vn."',refill1 = '".$refill1."',getdrug1 = '".$getdrug1."',getdrugdate1 = '".$getdrugdate1."',refill2vn = '".$refill2vn."',refill2 = '".$refill2."',
getdrug2 = '".$getdrug2."',getdrugdate2 = '".$getdrugdate2."',appointdocotor1 = '".$appointdocotor1."',seedoctor1 = '".$seedoctor1."',seedoctordate1 = '".$seedoctordate1."',
datemonth3 = DATE_ADD('".$drugrefillm3."',INTERVAL 60 DAY),datemonth6 = DATE_ADD('".$drugrefillm6."',INTERVAL 120 DAY)
WHERE num = '".$num."'   ";




if ($conn->query($sql2) === TRUE) {
	$row_array['message2'] = "แก้ไขข้อมูลบริการสำเร็จ";
	array_push($return_arr,$row_array);
} else {
	$row_array['message2'] =  "แก้ไขข้อมูลบริการไม่สำเร็จ " ;
	array_push($return_arr,$row_array);
}


// $sqldiagdel = "SELECT
// num

// FROM
// diags
// WHERE
//  servicenum = '".$num."' ";




// if ($result = mysqli_query( $conn, $sqldiagdel )){
//    while ($row = mysqli_fetch_assoc($result)) {
//    $numserivce = $row['num'];

   
//   }
// }
// if($numserivce === '".$num."' ){

// 	$sql = "DELETE FROM diag  WHERE num = '".$num."'";


// if ($conn->query($sql) === TRUE) {
// 	$row_array['messagedelete'] = "ลบข้อมูลบริการสำเร็จ";

// } else {
// 	$row_array['messagedelete'] =  "ลบข้อมูลไม่สำเร็จ" ;

// }
// $strdiag  = "  INSERT INTO diags(icdcode,icdtype,vn,stamptime,servicenum) VALUES('".$icdcode."','".$icdtype."','".$startvn."','".$date."','".$num."')";
// 		if ($conn->query($strdiag) === TRUE) {
// 			echo "ระบบทำงานเสร็จสมบูรณ์";
			
				
// 		} else {
// 			echo "Error: " . $sql . "<br>" . $conn->error;
// 		}

// }else{
// 	$strdiag  = "  INSERT INTO diags(icdcode,icdtype,vn,stamptime,servicenum) VALUES('".$icdcode."','".$icdtype."','".$startvn."','".$date."','".$num."')";
// 		if ($conn->query($strdiag) === TRUE) {
// 			echo "ระบบทำงานเสร็จสมบูรณ์";
			
				
// 		} else {
// 			echo "Error: " . $sql . "<br>" . $conn->error;
// 		}

// }




// $sql3 = "UPDATE diags SET icdcode='".$icdcode."' ,icdtype = '".$icdtype."'
// WHERE vn = '".$startvn."'   ";

	$sqldiag = "DELETE FROM diags  WHERE num = '".$num."'";


if ($conn->query($sqldiag) === TRUE) {
	$row_array['messagedelete'] = "ลบข้อมูลบริการสำเร็จ";
	array_push($return_arr,$row_array);

} else {
	$row_array['messagedelete'] =  "ลบข้อมูลไม่สำเร็จ" ;
	array_push($return_arr,$row_array);
}

	$sqldrug = "DELETE FROM drugs  WHERE num = '".$num."'";


	if ($conn->query($sqldrug) === TRUE) {
		$row_array['messagedelete2'] = "ลบข้อมูลบริการสำเร็จ";
		array_push($return_arr,$row_array);
	
	} else {
		$row_array['messagedelete2'] =  "ลบข้อมูลไม่สำเร็จ" ;
		array_push($return_arr,$row_array);
	}


// if ($conn->query($sql3) === TRUE) {
// 	$row_array['message3'] = "แก้ไขข้อมูลโรคสำเร็จ";
// 	array_push($return_arr,$row_array);
// } else {
// 	$row_array['message3'] =  "แก้ไขข้อมูลโรคไม่สำเร็จ " ;
// 	array_push($return_arr,$row_array);
// }

// $sql4 = "UPDATE drugs SET unit='".$unit."' ,icdcode = '".$icdcode."',icdtype = '".$icdtype."'
// WHERE vn = '".$startvn."'   ";




// if ($conn->query($sql3) === TRUE) {
// 	$row_array['message4'] = "แก้ไขข้อมูลยาสำเร็จ";
// 	array_push($return_arr,$row_array);
// } else {
// 	$row_array['message4'] =  "แก้ไขข้อมูลยาไม่สำเร็จ " ;
// 	array_push($return_arr,$row_array);
// }




 

mysqli_close($conn);

echo json_encode($return_arr);









?>
