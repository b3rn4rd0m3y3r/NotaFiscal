<?php
//echo '<pre>';
//print_r(PDO::getAvailableDrivers());
//echo '</pre>';
	//$strFullName = "C:\\inetpub\\wwwroot\\efenerg\\efenerg.mdb";
	//$strConn = "odbc:Driver={Driver do Microsoft Access (*.mdb)}:Dbq=". $strFullName;
	try {
		$conn = new PDO('sqlite:Pedidos.db3');
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
?>