<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
$hn = $_GET["hn"];
$vn = $_GET["vn"];

// $hn = '19638/52';
// $vn = '42873932';

$data=array();

$strSQL  = "SELECT
DATA_DRUG_WH.CODE,
DRUGCODES.NAME,
DATA_DRUG_WH.QUANTITY


FROM
	DATA_DRUG_WH
LEFT JOIN PLACES ON DATA_DRUG_WH.PLA_PLACECODE = PLACES.PLACECODE
INNER JOIN DRUGCODES on DATA_DRUG_WH.CODE = DRUGCODES.CODE
WHERE
DATA_DRUG_WH.OFH_OPD_FINANCE_NO = '".$vn."'
and DATA_DRUG_WH.HN = '".$hn."'




	

	
";

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){


	$a['CODE']=$rs_pmk[0];
	$a['NAME']=$rs_pmk[1];
	$a['QUANTITY']=$rs_pmk[2];

	
	


	
	array_push($data,$a);
}	
	


echo json_encode($data);

oci_close($objConnect);





?>
