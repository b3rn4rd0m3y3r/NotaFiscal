<?php
	//$NoOS = $_GET["NoOs"];
	$TpServ = $_GET["TpServ"];

	include "connection.php";
	// Teste de existъncia
	// Gravamos os TpItem com "n-descriчуo"
	// Devido aos acentos, testaremos apenas os dois primeiros caracteres
	$sql = "SELECT sum(Quantidade) as Qtd from PedidoItens where TpItem Like ? ";
	$params = array(
		urldecode($TpServ) . "%"
		);
	//echo urldecode($TpServ); // Nуo pode haver outros echoes que nуo o de resposta efetiva
	$sth = $conn->prepare($sql);
	$sth->execute($params);
	$Soma = 0;
	if( $row = $sth->fetch() ){
		echo  "[{\"Id\":\"EXISTE\"}, {\"Qtd\":\"" . $row['Qtd'] . "\"}]";
		} else {
		echo  "[{\"Id\":\"NAO EXISTE\"} , {\"Qtd\":\"0\"}]";
		}
?>