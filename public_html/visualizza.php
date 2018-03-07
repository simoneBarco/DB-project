<?php
	require("library.php");
	printHeader2("Visualizza polizza - Agenzia Assicurativa","","");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])) OR $_SESSION['typelog']=='1')
		echo" <h3>Effettuare il login come Dipedente per accedere a questa pagina.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];
		$pol= $_GET['pol'];

		//gest_menu($typelog, "mod");
		$query2= "SELECT CodCasa, CodRC FROM Polizza WHERE Numero='$pol'";
		$result2= mysql_query($query2) or die("Query fallita! ".mysql_error());
		$riga2= mysql_fetch_assoc($result2);
		if($riga2['CodRC']==NULL){
			$query= "SELECT Numero, Massimale, DataStipula, DataScadenza, 
			CFCliente, Durata, PrezzoAnnuo, AnnoCostruzione, AnnoRistrutturazione, 
			CittaResidenza, ProvinciaResidenza, SpeseLegali, Tipo
			FROM Polizza JOIN Casa ON CodCasa=Codice JOIN Cliente ON CFCliente=CodiceFiscale
			WHERE Numero='$pol'";
			$result= mysql_query($query) or die("Query fallita! ".mysql_error());
			$riga= mysql_fetch_assoc($result);
			echo"
				<div class='pcent'>
					<table>
						<tr><th>N</th><th>Massimale</th><th>Stipula</th>
						<th>Scadenza</th><th>Cliente</th><th>Durata</th>
						<th>PrezzoAnnuo</th><th>AnnoCostruzione</th><th>AnnoRistrutturazione</th>
						<th>Città</th><th>Provincia</th><th>SpeseLegali</th><th>Tipo</th></tr>
						<tr><td>".$riga['Numero']."</td><td>".$riga['Massimale']."</td><td>"
						.$riga['DataStipula']."</td><td>".$riga['DataScadenza']."</td><td>".
						$riga['CFCliente']."</td><td>".$riga['Durata']."</td><td>".
						$riga['PrezzoAnnuo']."</td><td>".$riga['AnnoCostruzione']."</td><td>".
						$riga['AnnoRistrutturazione']."</td><td>".$riga['CittaResidenza']."</td><td>".
						$riga['ProvinciaResidenza']."</td><td>".$riga['SpeseLegali']."</td><td>".
						$riga['Tipo']."</td></tr>
					</table>
					<a href=\"javascript:self.close()\">Chiudi</a>
				</div>";
		}
		else{
			$query= "SELECT Numero, Massimale, DataStipula, DataScadenza, 
			CFCliente, Durata, PrezzoAnnuo, Potenza, Cilindrata, AnniPatente, ClasseDiMerito
			FROM Polizza JOIN RCAuto ON CodRC=Codice JOIN Cliente ON CFCliente=CodiceFiscale
			WHERE Numero='$pol'";
			$result= mysql_query($query) or die("Query fallita! ".mysql_error());
			$riga= mysql_fetch_assoc($result);
			echo"
				<div class='pcent'>
					<table>
						<tr><th>N</th><th>Massimale</th><th>Stipula</th>
						<th>Scadenza</th><th>Cliente</th><th>Durata</th>
						<th>PrezzoAnnuo</th><th>Potenza</th><th>Cilindrata</th>
						<th>AnniPatente</th><th>ClasseDiMerito</th></tr>
						<tr><td>".$riga['Numero']."</td><td>".$riga['Massimale']."</td><td>"
						.$riga['DataStipula']."</td><td>".$riga['DataScadenza']."</td><td>".
						$riga['CFCliente']."</td><td>".$riga['Durata']."</td><td>".
						$riga['PrezzoAnnuo']."</td><td>".$riga['Potenza']."</td><td>".
						$riga['Cilindrata']."</td><td>".$riga['AnniPatente']."</td><td>".
						$riga['ClasseDiMerito']."</td></tr>
					</table>
					<a href=\"javascript:self.close()\">Chiudi</a>
				</div>";
		}
	}
	page_end();
?>
