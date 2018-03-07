<?php
	require("library.php");
	printHeader("Rinnova Polizza - Agenzia Assicurativa","","rinn");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])))
		echo" <h3>Effettuare il login come Dipendente per accedere alla pagina.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];

		gest_menu($typelog, "rinn");

		if(isset($_POST['rinnova'])){
			$pol=$_POST['pol'];
			$query= "CALL rinnovo($pol)";
			$result= mysql_query($query) or die("Query fallita! ".mysql_error());
			if($result){
				echo" <div id='corpo'>
						<h3>Rinnovo effettuato!</h3>";
						unset($_POST['pol']);
						header("Refresh:2; URL=rinn.php");
			}
		}
		else{
		echo"
			<div id='corpo'>
				<h3>Rinnovo Polizza</h3>";
				if($typelog==4){
					$query= "SELECT NPolizza AS Numero, DataStipula, DataScadenza, Nome, Cognome
							 FROM PortafoglioAgenzie JOIN Polizza ON NPolizza=Numero
							 WHERE Agenzia= (
							 		SELECT Codice
							 		FROM Agenzia
							 		WHERE AgenteGenerale='$cf'
							 		)
							 UNION
							 SELECT Numero, DataStipula, DataScadenza, Nome, Cognome
							 FROM Polizza JOIN Cliente ON CFCliente=CodiceFiscale
							 WHERE CFDipendente='$cf'";
				}
				else{
					$query= "SELECT Numero, DataStipula, DataScadenza, Nome, Cognome
							FROM Polizza JOIN Cliente ON CFCliente=CodiceFiscale
							WHERE CFDipendente='$cf'";
				}
				$result= mysql_query($query) or die("Query fallita! ".mysql_error());
				$riga= mysql_fetch_array($result);
				if(!$riga)
					echo" nessuna voce";
				else{
					echo"
						<form action='rinn.php' method='post'>
						<table>
						<tr><th>Numero Polizza</th><th>DataStipula</th><th>DataScadenza</th>
						<th>Nome</th><th>Cognome</th></tr>";
						while($riga){
							$npol= $riga['Numero'];
							$datas= $riga['DataStipula'];
							$datasc= $riga['DataScadenza'];
							$nome= $riga['Nome'];
							$cogn= $riga['Cognome'];
							echo"
								<tr><td><input type='radio' name='pol' value='$npol'>".$npol."</td>
								<td>".$datas."</td><td>".$datasc."</td><td>".$nome."</td><td>".$cogn."</td></tr>";
							$riga= mysql_fetch_array($result);
						}
						echo"
							<tr><td><input type='submit' value='Rinnovo' name='rinnova' class='button'></td></tr>
						</table>
						</form>";

				}
		}
	}
	page_end();
?>