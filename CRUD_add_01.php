<?php
	$NoOS = $_GET["NoOs"];
	$AreaDemand = $_GET["AreaDemand"];
	$DtIniServ = $_GET["DtIniServ"];
	echo  "[{\"Id\":\"novo\"}, {\"NoOS\":\"" . $NoOS . "\"}, {\"AreaDemand\":\"" . $AreaDemand . "\"}, {\"DtIniServ\":\"" . $DtIniServ . "\"}]";
?>