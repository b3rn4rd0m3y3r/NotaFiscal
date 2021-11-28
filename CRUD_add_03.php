<?php
	$NoOS = $_GET["NoOs"];
	$AreaDemand = $_GET["AreaDemand"];
	$DtIniServ = $_GET["DtIniServ"];
	$Descri = $_GET["Descri"];
	echo  "[{\"Id\":\"novo\"}, {\"NoOS\":\"" . $NoOS . "\"}, {\"AreaDemand\":\"" . $AreaDemand . "\"}, {\"DtIniServ\":\"" . $DtIniServ . "\"}]";
	include "connection.php";
	$data = [
		'NoOS' => $NoOS,
		'AreaDem' => $AreaDemand,
		'DtIni' => $DtIniServ,
		'Descri' => $Descri
	];
	$sql = "INSERT INTO PedidoCab (NoOS, AreaDem, DtIni, Descri ) VALUES (:NoOS, :AreaDem, :DtIni, :Descri)";
	$sth = $conn->prepare($sql);
	$sth->execute($data);
?>