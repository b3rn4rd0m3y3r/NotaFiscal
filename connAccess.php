<?php
echo '<pre>';

print_r(PDO::getAvailableDrivers());

echo '</pre>';
	$strFullName = "C:/inetpub/wwwroot/efenerg/efenerg.mdb";
	$strConn = "odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=". $strFullName;
	try {
		$conn = new PDO($strConn);
	}catch(PDOException $e){
		echo $e->getMessage();
	}
	//$conn = new COM('ADODB.Connection');
	//$conn->Open($strConn);
	
	$sql = "SELECT * FROM Usuarios";
	$comm = $conn->prepare($sql);
	$params = array(5, 'String');
	$comm->execute();
	echo "<table border=1 cellspacing=0 cellpadding=6>";
	echo "<thead>";
	echo "<th>Nome Real</th><th>Nome Responsável</th>";
	echo "</thead>";
	while( $row = $comm->fetch() ){
		echo "<tr>";
		echo "<td>" . $row['NomeReal'] . "</td><td>" .  $row['NomeRepres'] . "</td>";
		echo "</tr>";
		}
	echo "</table>";
	
?>