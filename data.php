<?php
	 header('Access-Control-Allow-Origin: *');
   
//    $hn = '2632/49';

include 'connect.php';

 $hn = $_GET["hn"];
$data=array();

$strSQL  = " SELECT
ROWNUM,
hn,
PRENAME ||''|| PATIENTS.NAME ||' '|| SURNAME as name,

CASE WHEN SEX = 'M' THEN 'ชาย' 
	 WHEN SEX = 'F' THEN 'หญิง' 
end as SEX,
ID_CARD,
CASE WHEN MOBILE IS NULL THEN TEL ELSE TEL ||','|| MOBILE END AS TEL,
to_char(PATIENTS.HOME ||' ต. '||TAMBON.NAME||' อ. '||DISULTS.DIST_NAME ||'  จ. '||PROVINCES.PROV_NAME) as ADDRESS


FROM
PATIENTS
LEFT JOIN TAMBON ON TAMBON.CODE = PATIENTS.TAMBON
LEFT JOIN PROVINCES ON PATIENTS.PRO1_PROV_CODE = PROVINCES.PROV_CODE
LEFT JOIN DISULTS ON PATIENTS.DIS_DIST_CODE = DISULTS.DIST_CODE

WHERE
hn =  '".$hn."' ";

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){
	

	$a['rownum']=iconv('tis-620','UTF-8',$rs_pmk[0]);
	$a['hn']=iconv('tis-620','UTF-8',$rs_pmk[1]);
	$a['name']=$rs_pmk[2];

	$a['sex']=$rs_pmk[3];
	$a['idcard']=$rs_pmk[4];
	$a['tel']=$rs_pmk[5];
	$a['address']=$rs_pmk[6];
	


	
	array_push($data,$a);
}	
	


echo json_encode($data);

oci_close($objConnect);






?>
