<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';


	 $hn = $_GET["hn"];
	 $vn = $_GET["vn"];
	 $type = $_GET["type"];
	 $num = $_GET["num"];


	 $return_arr = array();
if($type === '1'){


 $sql = "DELETE FROM person WHERE hn = '".$hn."' ";




if ($conn->query($sql) === TRUE) {
	$row_array['message'] = "ลบข้อมูลบุคคลสำเร็จ";
	array_push($return_arr,$row_array);
} else {
	$row_array['message'] =  "ลบข้อมูลไม่สำเร็จ " ;
	array_push($return_arr,$row_array);
}
}elseif($type === '2'){
// $sql = "DELETE FROM services WHERE hn = '".$hn."' and startvn = '".$vn."' ";
$sql = "DELETE FROM services WHERE num = '".$num."'  ";




if ($conn->query($sql) === TRUE) {
	$row_array['message2'] = "ลบข้อมูลบริการสำเร็จ";
	array_push($return_arr,$row_array);
} else {
	$row_array['message2'] =  "ลบข้อมูลไม่สำเร็จ" ;
	array_push($return_arr,$row_array);
}

}elseif($type === '3'){
	$sql = "DELETE FROM diags WHERE servicenum = '".$num."' ";
	
	

	
	if ($conn->query($sql) === TRUE) {
		$row_array['message3'] = "ลบข้อมูลโรคสำเร็จ";
		array_push($return_arr,$row_array);
	} else {
		$row_array['message3'] =  "ลบข้อมูลไม่สำเร็จ" ;
		array_push($return_arr,$row_array);
	}
}elseif($type === '4'){
	$sql = "DELETE FROM drugs WHERE servicenum = '".$num."' ";
	
	

	
	if ($conn->query($sql) === TRUE) {
		$row_array['message4'] = "ลบข้อมูลยาสำเร็จ";
		array_push($return_arr,$row_array);
	} else {
		$row_array['message4'] =  "ลบข้อมูลไม่สำเร็จ" ;
		array_push($return_arr,$row_array);
	}
}

 

mysqli_close($conn);

echo json_encode($return_arr);









?>
