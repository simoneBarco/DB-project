<?php
	require("library.php");
	printHeader("Inserimento nuovo Subagente - Agenzia Assicurativa","","new_sub");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])) OR $_SESSION['typelog']!='4')
		echo" <h3>Effettuare il login come Agente per accedere alla pagina.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];

		gest_menu($typelog, "new_sub");

		if(!(isset($_POST['agg']))){
			echo"
				<div id='corpo'>
					<form action='new_sub.php' method='post'>
						<fieldset>
							<legend><h3>Inserisci dati Subagente</h3></legend>
							<table>
								<tr><td>Codice Fiscale</td><td><input type='text' name='ncf'></td></tr>
								<tr><td>Password</td><td><input type='text' name='pwd'></td></tr>
								<tr><td>Nome</td><td><input type='text' name='nome'></td></tr>
								<tr><td>Cognome</td><td><input type='text' name='cogn'></td></tr>
								<tr><td>Sede Ufficio</td><td><input type='text' name='uff'></td></tr>
								<tr><td></td><td><input type='submit' name='agg' value='Aggiungi'></td></tr>
							</table>
						</fieldset>
					</form>

					<table>
							<tr><th>Codice Fiscale</th><th>Password</th><th>Nome</th><th>Cognome</th><th>Provvigione</th><th>Agenzia</th><th>Sede Ufficio</th></tr>";
						$query= "SELECT CodiceFiscale, Password, Nome, Cognome, Provvigione, Agenzia, SedeUfficio FROM Dipendente JOIN SubAgente ON CodiceFiscale=CFDip WHERE Agenzia= (SELECT Codice FROM Agenzia WHERE AgenteGenerale='$cf')";
						$result= mysql_query($query) or die("Query fallita! ".mysql_error());
						$riga= mysql_fetch_array($result);
						while($riga){
							echo" 
								<tr><td>".$riga['CodiceFiscale']."</td><td>".$riga['Password']."</td><td>".$riga['Nome']."</td><td>".$riga['Cognome']."</td><td>".$riga['Provvigione']."</td><td>".$riga['Agenzia']."</td><td>".$riga['SedeUfficio']."</td></tr>";
							$riga= mysql_fetch_array($result);
						}
					echo" </table>
				</div>";
		}
		elseif ($_POST['ncf']==NULL) {
			echo"
				<div id='corpo'>
					<h3>Errore nell'inserimento dei dati</h3>";
					unset($_POST['agg']);
					unset($_POST['ncf']);
					unset($_POST['pwd']);
					unset($_POST['nome']);
					unset($_POST['cogn']);
					unset($_POST['uff']);
					header("Refresh:2; URL=new_sub.php");
			echo"</div>";
		}
		else{
			$ncf= strtoupper($_POST['ncf']);
			$pass= $_POST['pwd'];
			$nome=  ucfirst($_POST['nome']);
			$cogn= ucfirst($_POST['cogn']);
			$uffi= $_POST['uff'];

			$query1= "SELECT Codice FROM Agenzia WHERE AgenteGenerale='$cf'";
			$result1= mysql_query($query1) or die("Query1 fallita! ".mysql_error());
			$riga1= mysql_fetch_array($result1);
			$sede= $riga1['Codice'];

			$query2= "INSERT INTO Dipendente (CodiceFiscale, Password, Nome, Cognome, Provvigione, Agenzia) VALUES ('$ncf', '$pass', '$nome', '$cogn', NULL, '$sede');";
			$result2= mysql_query($query2) or die("Query2 fallita! ".mysql_error());
			$query3= "INSERT INTO SubAgente (CFDip, SedeUfficio) VALUES ('$ncf', '$uffi') ";
			$result3= mysql_query($query3) or die("Query3 fallita! ".mysql_error());
			if($result2 AND $result3){
				echo"
					<div id='corpo'>
						<h3>Inserimento effettuato!</h3>";
						unset($_POST['agg']);
						unset($_POST['ncf']);
						unset($_POST['pwd']);
						unset($_POST['nome']);
						unset($_POST['cogn']);
						unset($_POST['uff']);
						header("Refresh:2; URL=new_sub.php");
				echo" </div>";
			}
			
		}
	}
	page_end();
?>