<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';


$data=array();

$strSQL  = " SELECT
DOC_CODE as doccode,
PRENAME ||''||NAME || ' ' || SURNAME AS NAME
FROM
DOC_DBFS
WHERE
DEL_FLAG IS NULL
";

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){
	
	$a['doccode']=$rs_pmk[0];
	$a['name']=$rs_pmk[1];
	
	


	
	array_push($data,$a);
}	
	


echo json_encode($data);

oci_close($objConnect);






?>
