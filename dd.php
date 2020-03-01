<?php
	 header('Access-Control-Allow-Origin: *');
   
//    $hn = '2632/49';

include 'connect.php';

 $hn = $_GET["hn"];
$data=array();

$strSQL  = " select hn from patients where hn = '1/49' ";

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){
	


	$a['hn']=iconv('tis-620','UTF-8',$rs_pmk[0]);
	


	
	array_push($data,$a);
}	
	


echo json_encode($data);

oci_close($objConnect);






?>
