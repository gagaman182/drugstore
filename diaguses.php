<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
$hn = $_GET["hn"];
$vn = $_GET["vn"];

//  $hn = '19638/52';
//  $vn = '42873932';

$data=array();

$strSQL  = "SELECT
OPD_FINANCE_HEADERS.OPD_FINANCE_NO,
DIAGNOSIS_TYPE.DIAGNOSIS_TYPE,
DIAGNOSIS_TYPE.NAME,

to_char(wm_concat(DISEASE_WAREHOUSE.ICD_CODE)) as ICD_CODE 


FROM
	DISEASE_WAREHOUSE
INNER JOIN DIAGNOSIS_TYPE on DISEASE_WAREHOUSE.TYPE = DIAGNOSIS_TYPE.DIAGNOSIS_TYPE
INNER JOIN OPD_FINANCE_HEADERS ON DISEASE_WAREHOUSE.opd_opd_no = OPD_FINANCE_HEADERS.opd_no

WHERE
 OPD_FINANCE_HEADERS.OPD_FINANCE_NO = '".$vn."'
 and DISEASE_WAREHOUSE.HN = '".$hn."'
GROUP BY OPD_FINANCE_HEADERS.OPD_FINANCE_NO, DIAGNOSIS_TYPE.DIAGNOSIS_TYPE,DIAGNOSIS_TYPE.NAME 


	

	
";

// OPD_FINANCE_HEADERS.OPD_FINANCE_NO = '".$vn."'
// and DISEASE_WAREHOUSE.HN = '".$hn."'


$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){

	$a['OPD_FINANCE_NO']=$rs_pmk[0];
	$a['DIAGNOSIS_TYPE']=$rs_pmk[1];
	$a['NAME']=$rs_pmk[2];
	$a['ICD_CODE']=iconv('tis-620','UTF-8',$rs_pmk[3]);

	
	


	
	array_push($data,$a);
}	
	


echo json_encode($data);

oci_close($objConnect);





?>
