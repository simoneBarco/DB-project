<?php
	require("library.php");
	printHeader("Lista Polizze - Agenzia Assicurativa","","polizze");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])))
		echo" <h3>Effettuare il login per accedere.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];

		gest_menu($typelog, "polizze");
	
		echo"
			<div id='corpo'>
				<h3><u>Polizze Attive</u></h3>
				<p>Polizze sulla Casa</p>";
				$query= "SELECT Numero, Massimale, DataStipula, DataScadenza, CFDipendente,
				Durata, CittaResidenza, ProvinciaResidenza, PrezzoAnnuo, AnnoCostruzione, 
				AnnoRistrutturazione, SpeseLegali, Tipo
				FROM Polizza JOIN Casa ON CodCasa=Casa.Codice JOIN Cliente ON CFCliente=CodiceFiscale
				WHERE CFCliente='$cf'";
				$result= mysql_query($query) or die("Query fallita! ".mysql_error());
				$riga= mysql_fetch_array($result);
				if(!$riga)
					echo" <h4>Nessuna polizza attiva</h4>";
				else{
					echo"
						<table>
							<tr><th>N</th><th>Massimale</th><th>Stipula
							</th><th>Scadenza</th><th>CFDip</th>
							<th>Dura</th><th>Prezzo
							</th><th>Costruzione</th><th>Ristrutturazione
							</th><th>Citta</th><th>Provincia</th><th>SpeseLegali
							</th><th>Tipo</th></tr>";
						while($riga){
							$num= $riga['Numero'];
							$dataSt= $riga['DataStipula'];
							$dataSc= $riga['DataScadenza'];
							$mass= $riga['Massimale'];
							$nomeD= $riga['CFDipendente'];
							$dur= $riga['Durata'];
							$prezzo= $riga['PrezzoAnnuo'];
							//dati casa
							$annoC= $riga['AnnoCostruzione'];
							$annoR= $riga['AnnoRistrutturazione'];
							$citta= $riga['CittaResidenza'];
							$prov= $riga['ProvinciaResidenza'];
							$spese= $riga['SpeseLegali'];
							$tipo= $riga['Tipo'];

							echo"
							<tr><td>".$num."</td><td>".$mass."</td><td>"
							.$dataSt."</td><td>".$dataSc."</td><td><a href=\"javascript:apri('vis_dip.php?dip=$nomeD');\">"
							.$nomeD.
							"</a></td>"."<td>".$dur."</td><td>"
							.$prezzo."</td><td>".$annoC."</td><td>".
							$annoR."</td><td>".$citta."</td><td>".$prov.
							"</td><td>".$spese."</td><td>".$tipo."</td></tr>";
							$riga= mysql_fetch_array($result);
						}
						echo"</table>";
				}
				echo"<p>Polizze RCAuto</p>";
				$query2= "SELECT Numero, Massimale, DataStipula, DataScadenza,
				CFDipendente, Durata, PrezzoAnnuo,
				Potenza, Cilindrata, AnniPatente, ClasseDiMerito
				FROM Polizza JOIN RCAuto ON CodRC=RCAuto.Codice JOIN Cliente ON CFCliente=CodiceFiscale
				WHERE CFCliente='$cf'";
				$result2= mysql_query($query2) or die("Query fallita! ".mysql_error());
				$riga2= mysql_fetch_array($result2);
				if(!$riga2)
					echo" <h4>Nessuna polizza attiva</h4>";
				else{
					echo"
						<table>
							<tr><th>N</th><th>Massimale</th><th>Stipula
							</th><th>Scadenza</th><th>CFDip</th><th>Dura</th><th>Prezzo
							</th><th>Potenza</th><th>Cilindrata</th><th>
							AnniPatente</th><th>ClasseDiMerito</th></tr>";
						while($riga2){
							$num2= $riga2['Numero'];
							$mass2= $riga2['Massimale'];
							$dataSt2= $riga2['DataStipula'];
							$dataSc2= $riga2['DataScadenza'];
							$nomeD2= $riga2['CFDipendente'];
							$dur2= $riga2['Durata'];
							$prezzo2= $riga2['PrezzoAnnuo'];
							//dati rc
							$pot= $riga2['Potenza'];
							$cil= $riga2['Cilindrata'];
							$anniP= $riga2['AnniPatente'];
							$classe= $riga2['ClasseDiMerito'];

							echo"
							<tr><td>".$num2."</td><td>".$mass2."</td><td>"
							.$dataSt2."</td><td>".$dataSc2."</td><td><a href=\"javascript:apri('vis_dip.php?dip=$nomeD2');\">"
							.$nomeD2."</a></td><td>".$dur2."</td>
							<td>".$prezzo2."</td><td>".$pot."</td><td>".
							$cil."</td><td>".$anniP."</td><td>".$classe.
							"</td></tr>";
							$riga2= mysql_fetch_array($result2);
						}
						echo"</table>";
				}

		echo"</div>";
	}
	page_end();
?>	