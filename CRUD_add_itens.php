<?php
	header('Access-Control-Allow-Origin: *');

	include "connection.php";

	// Reading JSON POST using PHP
	$json = file_get_contents('php://input');
	$jsonObj = json_decode($json);
	$NoOS = $jsonObj[0]->NoOS;
	echo $json;
	
	// Arquivo de log e itens
	$flog = fopen($NoOS.'_log.txt', 'w');
	$fp = fopen($NoOS.'.txt', 'w');
	fclose($fp);
	$fp = fopen($NoOS.'.txt', 'w');
	// Funções PHP
	// Teste de existência do registro
	function existeReg($conn, $flog, $Nos, $Tpit){
		fwrite($flog, "existeReg" ."\r\n");
		
		$Retorno = 0; // Default: não existe
		
		//$sql = "SELECT NoOS, NoItem, TpItem FROM PedidoItens WHERE ( NoOS = ? AND TpItem = ? )";
		$sql = "SELECT NoOS, NoItem, TpItem FROM PedidoItens WHERE ( NoOS = '" . $Nos . "' AND TpItem = '" . $Tpit . "' )";
		fwrite($flog, $sql ."\r\n");
		$params = array(
			$Nos,
			$Tpit
			);
		fwrite($flog, "params" ."\r\n");
		$sth = $conn->prepare($sql);
		fwrite($flog, "prepare" ."\r\n");
		// Usar try
		$sth->execute();
		fwrite($flog, "exec" ."\r\n");
		if( $row = $sth->fetch() ){
			$Retorno = 1;
			}
		fwrite($flog, "Retorno" ."\r\n");
		return $Retorno;
		}
	// Adição de novo registro
	function insertReg($conn, $Nos, $Noit, $Tpit, $Quant){
		$data = [
			'NoOS' => $Nos,
			'NoItem' => $Noit,
			'TpItem' => $Tpit,
			'Quantidade' => $Quant
		];		
		$sql = "INSERT INTO PedidoItens (NoOS, NoItem, TpItem, Quantidade ) VALUES (:NoOS, :NoItem, :TpItem, :Quantidade)";
		$sth = $conn->prepare($sql);
		$sth->execute($data);		
		}
	// Atualização de registro
	function updateReg($conn, $Nos, $Noit, $Tpit, $Quant){
		$data = [
			'NoOS' => $Nos,
			'NoItem' => $Noit,
			'TpItem' => $Tpit,
			'Quantidade' => $Quant
		];			
		$sql = "UPDATE PedidoItens SET NoItem = :NoItem, TpItem = :TpItem, Quantidade = :Quantidade WHERE ( NoOS = :NoOS AND TpItem = :TpItem )";
		$sth = $conn->prepare($sql);
		$sth->execute($data);	
		}
	// Deleção de registro
	function deleteReg($conn, $Nos, $Tpit){
		$data = [
			'NoOS' => $Nos,
			'TpItem' => $Tpit
		];	
		$sql = "DELETE FROM PedidoItens WHERE ( NoOS = :NoOS AND TpItem = :TpItem )";
		$sth = $conn->prepare($sql);
		$sth->execute($data);			
		}
	
	
	// Início da execução da script
	
	$NoItens = count($jsonObj);

	$S = "";
	$itens = "";
	$sNo = "";
	// Percorre os itens do JSON, exceto o item 0 (zero) dos títulos
	//$conn->beginTransaction();
	for($i=1;$i<$NoItens;$i++){
		// No. de ordem para o atributo "id" do LI
		$sNo = "000". trim($jsonObj[$i]->Ordem);
		$sNo = substr($sNo,strlen($sNo)-3,3);
		// Caso queira gravar com as linhas deletadas, comente a linha
		// de baixo e o fecha chaves correspondente
		fwrite($flog, $sNo ."\r\n");
		if( $jsonObj[$i]->classe != "inverso" ){
			$S .= "<li id=it" . $sNo . "><ul id=it" . $sNo;
			if( $jsonObj[$i]->classe != "null" ){
				$S .= " class=" . $jsonObj[$i]->classe;
				}
			$S  .= ">";
			$TpItem = mb_convert_encoding($jsonObj[$i]->TipodoItem, 'ISO-8859-1', 'auto');
			$S .= "<li>" . $i . "</li>" ;
			$S .= "<li>" . $jsonObj[$i]->NoItem . "</li>" ;
			$S .= "<li>" . $TpItem . "</li>" ;
			$S .= "<li>" . $jsonObj[$i]->Quantidade . "</li>" ;
			$S .= "<li class=painel></li>" ;
			$S .= "</ul></li>" ;
			// Tratamento no banco de dados
			
			$existe = existeReg($conn, $flog, $NoOS, $TpItem); 

			if( $existe == 1 ){
				fwrite($flog, "Update: ". $NoOS."-". $jsonObj[$i]->NoItem ."-". $TpItem ."-". $jsonObj[$i]->Quantidade ."\r\n");
				updateReg($conn, $NoOS, $jsonObj[$i]->NoItem, $TpItem, $jsonObj[$i]->Quantidade);
				
				} else {
				fwrite($flog, "Insert: " . $NoOS."-". $jsonObj[$i]->NoItem ."-". $TpItem ."-". $jsonObj[$i]->Quantidade ."\r\n");
				insertReg($conn, $NoOS, $jsonObj[$i]->NoItem, $TpItem, $jsonObj[$i]->Quantidade);
				
				}
			} else {
			// Tratamento de deleção

			$TpItem = mb_convert_encoding($jsonObj[$i]->TipodoItem, 'ISO-8859-1', 'auto');
			fwrite($flog, "Delete: " . $NoOS."-". $jsonObj[$i]->NoItem ."-". $TpItem ."\r\n");
			deleteReg($conn, $NoOS, $TpItem);
			}
			
		$itens .= "Itens: " . $jsonObj[$i]->classe . "-" . $jsonObj[$i]->NoItem . "-" . $TpItem . "-" . $jsonObj[$i]->Quantidade . PHP_EOL;
		}
	
	//$conn->commit();

	fwrite($fp, $S ."\r\n");
	fwrite($fp, mb_convert_encoding($json, 'ISO-8859-1', 'auto')."\r\n");
	fwrite($fp, $itens);
	fwrite($fp, "No. Itens: " . $NoItens ."\r\n");

	//fwrite($fp, $S ."\r\n");
	
	
	fclose($fp);
	fclose($flog);
	
	
	
	?>