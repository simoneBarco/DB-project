<?php
	require("library.php");
	printHeader("Visualizza Portafoglio - Agenzia Assicurativa","","port");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])))
		echo" <h3>Effettuare il login come Dipendente per accedere alla pagina.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];

		gest_menu($typelog, "port");
	
		echo"
			<div id='corpo'>
				<h3>Portafoglio</h3>";
				if($typelog==4){
					$query= "SELECT NPolizza, CFDip, Nome, Cognome, Importo 
					FROM (Portafoglio JOIN Polizza ON NPolizza=Numero) 
					JOIN Cliente ON CFCliente=CodiceFiscale WHERE CFDip='$cf'
					UNION
					SELECT NPolizza, CFDip, Nome, Cognome, Importo
					FROM `PortafoglioAgenzie` 
					WHERE Agenzia= (
						SELECT Codice 
						FROM Agenzia 
						WHERE AgenteGenerale='$cf')";

				}
				else{
					$query= "SELECT NPolizza, CFDip, Nome, Cognome, Importo 
					FROM (Portafoglio JOIN Polizza ON NPolizza=Numero) 
					JOIN Cliente ON CodiceFiscale=CFCliente WHERE CFDip='$cf'";
				}
				$result= mysql_query($query) or die("Query fallita! ".mysql_error());
				$riga= mysql_fetch_array($result);
				if(!$riga)
					echo" nessuna voce";
				else{
					
					echo"
					
					<table>
					<tr><th>Numero Polizza</th><th>CFDip</th><th>Nome Cliente</th><th>Cognome Cliente</th><th>Importo</th></tr>";
					while($riga){
						$npol= $riga['NPolizza'];
						$cfdip= $riga['CFDip'];
						$nomeC= $riga['Nome'];
						$cognC= $riga['Cognome'];
						$imp= $riga['Importo'];
						echo"
							<tr><td><a href=\"javascript:apri2('visualizza.php?pol=$npol');\">".$npol."</a></td>
							<td><a href=\"javascript:apri('vis_dip.php?dip=$cfdip');\">".$cfdip."</td>
							<td>".$nomeC."</td>
							<td>".$cognC."</td>
							<td>".$imp."</td></tr>";
							$riga= mysql_fetch_array($result);
					}
				}
				echo"</table>
			</div>";
	}
	page_end();
?>