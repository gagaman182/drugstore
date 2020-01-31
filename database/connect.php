<?php

	putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
	$objConnect = oci_connect("cc","cc","192.168.99.250/HY");
	if($objConnect)
	{
		echo "";
	}
	else
	{
		echo "Can not connect to Oracle Server";
	}
?>

