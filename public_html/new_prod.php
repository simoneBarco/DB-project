<?php
	require("library.php");
	printHeader("Inserimento nuovo Produttore - Agenzia Assicurativa","","new_prod");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])) OR $_SESSION['typelog']!='4')
		echo" <h3>Effettuare il login come Agente per accedere alla pagina.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];

		gest_menu($typelog, "new_prod");
	
		if(!(isset($_POST['agg']))){
			echo"
				<div id='corpo'>
					<form action='new_prod.php' method='post'>
						<fieldset>
							<legend><h3>Inserisci Produttore</h3></legend>
							<table>
								<tr><td>Codice Fiscale</td><td><input type='text' name='ncf2'></td></tr>
								<tr><td>Password</td><td><input type='text' name='pwd'></td></tr>
								<tr><td>Nome</td><td><input type='text' name='nome'></td></tr>
								<tr><td>Cognome</td><td><input type='text' name='cogn'></td></tr>
								<tr><td>Durata Contratto</td><td><input type='text' name='cont'></td></tr>
								<tr><td></td><td><input type='submit' name='agg' value='Aggiungi'></td></tr>
							</table>
						</fieldset>
					</form>
					<table>
						<tr><th>Codice Fiscale</th><th>Nome</th><th>Cognome</th><th>Provvigione</th><th>Agenzia</th><th>Durata Contratto</th></tr>";
						$query= "SELECT CodiceFiscale, Nome, Cognome, Provvigione, Agenzia, DurataContratto FROM Dipendente JOIN Produttore ON CodiceFiscale=CFDip WHERE Agenzia= (SELECT Codice FROM Agenzia WHERE AgenteGenerale='$cf')";
						$result= mysql_query($query) or die("Query fallita! ".mysql_error());
						$riga= mysql_fetch_array($result);
						while($riga){
							echo" 
								<tr><td>".$riga['CodiceFiscale']."</td><td>".$riga['Nome']."</td><td>".$riga['Cognome']."</td><td>".$riga['Provvigione']."</td><td>".$riga['Agenzia']."</td><td>".$riga['DurataContratto']."</td></tr>";
							$riga= mysql_fetch_array($result);
						}
					echo" </table>
				</div>";
		}
		elseif ($_POST['ncf2']==NULL) {
			echo"
				<div id='corpo'>
					<h3>Errore nell'inserimento dei dati</h3>";
					unset($_POST['agg']);
					unset($_POST['ncf2']);
					unset($_POST['pwd']);
					unset($_POST['nome']);
					unset($_POST['cogn']);
					unset($_POST['cont']);
					header("Refresh:2; URL=new_prod.php");
			echo"</div>";
		}
		else{
			$ncf2= strtoupper($_POST['ncf2']);
			$pass= $_POST['pwd'];
			$nome= ucfirst($_POST['nome']);
			$cogn= ucfirst($_POST['cogn']);
			$dura= $_POST['cont'];

			$query1= "SELECT Codice FROM Agenzia WHERE AgenteGenerale='$cf'";
			$result1= mysql_query($query1) or die("Query1 fallita! ".mysql_error());
			$riga1= mysql_fetch_array($result1);
			$sede= $riga1['Codice'];

			$query2= "INSERT INTO Dipendente (CodiceFiscale, Password, Nome, Cognome, Provvigione, Agenzia) VALUES ('$ncf2', '$pass', '$nome', '$cogn', NULL, '$sede')";
			$result2= mysql_query($query2) or die("Query2 fallita! ".mysql_error());
			$query3= "INSERT INTO Produttore (CFDip, DurataContratto) VALUES ('$ncf2', '$dura') ";
			$result3= mysql_query($query3) or die("Query3 fallita! ".mysql_error());
			if($result2 AND $result3){
				echo"
					<div id='corpo'>
						<h3>Inserimento effettuato!</h3>";
						unset($_POST['agg']);
						header("Refresh:2; URL=new_prod.php");
				echo"</div>";
			}
		}
	}
	page_end();
?>