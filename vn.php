<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
$hn = $_GET["hn"];
// $hn = '1/49';

$data=array();

$strSQL  = "select * from (
	SELECT
to_char(opd_time,'yyyy-mm-dd') as opdtime,
PLA_PLACECODE1,
OPD_FINANCE_NO as vn
	FROM
		OPD_FINANCE_HEADERS
	INNER JOIN PATIENTS on OPD_FINANCE_HEADERS.PAT_RUN_HN = PATIENTS.RUN_HN  and OPD_FINANCE_HEADERS.PAT_YEAR_HN = PATIENTS.year_hn  
	where  hn =  '".$hn."'
	ORDER BY
		OPD_FINANCE_NO DESC)x


	

	
";

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){

	$a['opdtime']=$rs_pmk[0];
	$a['pla']=$rs_pmk[1];
	$a['vn']=$rs_pmk[2];
	
	
	


	
	array_push($data,$a);
}	
	


echo json_encode($data);

oci_close($objConnect);






?>
