<?php
	header('Content-Type: application/json');
   $q = $_GET["q"];
  // $q = '2632/49';

include 'connect.php';



$strSQL  = " select  hn from patients where hn = '1/49'

		
";

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute ($objParse);


$rows = array();
while($r = oci_fetch_array($objParse,OCI_BOTH)) {
     $rows[] = $r;
}


echo json_encode($rows);

exit;



?>
