<?php

	include "connection.php";
		$Retorno = 0; // Default: n�o existe
		
		//$sql = "SELECT NoOS, NoItem, TpItem FROM PedidoItens WHERE ( NoOS = ? AND TpItem = ? )";
		$sql = "SELECT NoOS, NoItem, TpItem FROM PedidoItens WHERE ( NoOS = '090' AND TpItem = '8-Clientes resid-n�o resid RMBH' )";
		$params = array(
			$Nos,
			$Tpit
			);
		$sth = $conn->prepare($sql);
		//$sth->execute($params);
		
		// Usar try
		$sth->execute();
		if( $row = $sth->fetch() ){
			$Retorno = 1;
			}
		echo $Retorno;
		var_dump($Retorno);
?>