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
	$data = [
		'NoOS' => $NoOS,
		'AreaDem' => $AreaDemand,
		'DtIni' => $DtIniServ,
		'Descri' => $Descri
	];
	$sth = $conn->prepare($sql);
	$sth->execute($params);
	if( $row = $sth->fetch() ){
		echo  "[{\"Id\":\"EXISTE\"}, {\"NoOS\":\"" . $row['NoOS'] . "\"}, {\"AreaDemand\":\"" . $row['AreaDem'] . "\"}, {\"DtIniServ\":\"" . $row['DtIni'] . "\"}, {\"Descri\":\"" . $row['Descri'] . "\"}]";
		// Faz Update no banco
		$sql = "UPDATE PedidoCab SET AreaDem = :AreaDem, DtIni = :DtIni, Descri = :Descri WHERE NoOS = :NoOS ";
		$sth = $conn->prepare($sql);
		$sth->execute($data);		
		} else {
		echo  "[{\"Id\":\"novo\"}, {\"NoOS\":\"" . $NoOS . "\"}, {\"AreaDemand\":\"" . $AreaDemand . "\"}, {\"DtIniServ\":\"" . $DtIniServ . "\"}]";
		}
?>