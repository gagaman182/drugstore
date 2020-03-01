<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
$hn = $_GET["hn"];
$vn = $_GET["vn"];

// $hn = '19638/52';
// $vn = '42873932';

$data=array();

$strSQL  = "SELECT

DISEASE_WAREHOUSE.ICD_CODE,
DIAGNOSIS_TYPE.NAME

FROM
	DISEASE_WAREHOUSE
INNER JOIN DIAGNOSIS_TYPE on DISEASE_WAREHOUSE.TYPE = DIAGNOSIS_TYPE.DIAGNOSIS_TYPE
INNER JOIN OPD_FINANCE_HEADERS ON DISEASE_WAREHOUSE.opd_opd_no = OPD_FINANCE_HEADERS.opd_no

WHERE
	OPD_FINANCE_HEADERS.OPD_FINANCE_NO = '".$vn."'
and DISEASE_WAREHOUSE.HN = '".$hn."'



	

	
";

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){


	$a['ICD_CODE']=$rs_pmk[0];
	$a['NAME']=$rs_pmk[1];

	
	


	
	array_push($data,$a);
}	
	


echo json_encode($data);

oci_close($objConnect);





?>
