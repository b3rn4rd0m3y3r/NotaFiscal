<?php
	//$NoOS = $_GET["NoOs"];
	$TpServ = $_GET["TpServ"];

	include "connection.php";
	// Teste de exist�ncia
	// Gravamos os TpItem com "n-descri��o"
	// Devido aos acentos, testaremos apenas os dois primeiros caracteres
	$sql = "SELECT sum(Quantidade) as Qtd from PedidoItens where TpItem Like ? ";
	$params = array(
		urldecode($TpServ) . "%"
		);
	//echo urldecode($TpServ); // N�o pode haver outros echoes que n�o o de resposta efetiva
	$sth = $conn->prepare($sql);
	$sth->execute($params);
	$Soma = 0;
	if( $row = $sth->fetch() ){
		echo  "[{\"Id\":\"EXISTE\"}, {\"Qtd\":\"" . $row['Qtd'] . "\"}]";
		} else {
		echo  "[{\"Id\":\"NAO EXISTE\"} , {\"Qtd\":\"0\"}]";
		}
?>