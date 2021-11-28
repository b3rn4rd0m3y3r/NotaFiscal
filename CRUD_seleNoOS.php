<?php
	$NoOS = $_GET["NoOs"];
	$AreaDemand = $_GET["AreaDemand"];
	$DtIniServ = $_GET["DtIniServ"];
	$Descri = $_GET["Descri"];
	
	

	include "connection.php";
	// Teste de existência
	$sql = "SELECT NoOS, AreaDem, DtIni, Descri FROM PedidoCab WHERE NoOS = ? ";
	$params = array(
		$NoOS
		);
	$sth = $conn->prepare($sql);
	$sth->execute($params);
	if( $row = $sth->fetch() ){
		echo  "[{\"Id\":\"EXISTE\"}, {\"NoOS\":\"" . $row['NoOS'] . "\"}, {\"AreaDemand\":\"" . $row['AreaDem'] . "\"}, {\"DtIniServ\":\"" . $row['DtIni'] . "\"}, {\"Descri\":\"" . $row['Descri'] . "\"}]";
		} else {
		echo  "[{\"Id\":\"novo\"}, {\"NoOS\":\"" . $NoOS . "\"}, {\"AreaDemand\":\"" . $AreaDemand . "\"}, {\"DtIniServ\":\"" . $DtIniServ . "\"}]";
		}
?>