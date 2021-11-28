<?php
	$NoOS = $_GET["NoOs"];
	$AreaDemand = $_GET["AreaDemand"];
	$DtIniServ = $_GET["DtIniServ"];
	echo  "[{\"Id\":\"novo\"}, {\"NoOS\":\"" . $NoOS . "\"}, {\"AreaDemand\":\"" . $AreaDemand . "\"}, {\"DtIniServ\":\"" . $DtIniServ . "\"}]";
	include "connection.php";
	$data = [
		'NoOS' => $NoOS,
		'AreaDem' => $AreaDemand,
		'DtIni' => $DtIniServ,
	];
	$sql = "INSERT INTO PedidoCab (NoOS, AreaDem, DtIni) VALUES(:NoOS, :AreaDem, :DtIni)";
	$sth = $conn->prepare($sql);
	$sth->execute($data);
?>