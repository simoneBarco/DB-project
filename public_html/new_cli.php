<?php
	require("library.php");
	printHeader("Inserimento nuovo Cliente - Agenzia Assicurativa","","new_cli");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])) OR $_SESSION['typelog']=='1')
		echo" <h3>Effettuare il login come Dipendente per accedere a questa pagina.</h3>";
	else{
		if(!(isset($_POST['cf2']))){
			$cf= $_SESSION['login'];
			$typelog= $_SESSION['typelog'];

			gest_menu($typelog, "new_cli");
	
			echo"
				<div id='corpo'>
					<form action='new_cli.php' method='post'>
						<fieldset>
							<legend><h3>Inserimento dati nuovo cliente</h3></legend>
							<table border='0'>
								<tr><td>Inserisci CodiceFiscale</td><td><input type='text' name='cf2'></td>
								<td>Inserisci Password</td><td><input type='text' name='psw'></td></tr>
								<tr><td>Inserisci Nome</td><td><input type='text' name='nome'></td>
								<td>Inserisci Cognome</td><td><input type='text' name='cogn'></td></tr>
								<tr><td>Inserisci data di nascita</td><td><input type='text' name='datan'></td>
								<td>Inserisci città di residenza</td><td><input type='text' name='citt'></td></tr>
								<tr><td>Inserisci Provincia di residenza</td><td><input type='text' name='prov'></td>
								<td>Inserisci data patente</td><td><input type='text' name='datap'></td></tr>
								<tr><td><input type='submit' value='Aggiungi' class='button'></td></tr>
							</table>
						</fieldset>
					</form>
				
					<table>
						<tr><th>Codice Fiscale</th><th>Password</th><th>Nome</th><th>Cognome</th>
						<th>Data di nascita</th><th>Città di residenza</th><th>Provincia di residenza</th>
						<th>Data patente</th><th>AnniPatente</th><th>ClasseDiMerito</th></tr>";
						$query= "SELECT * FROM Cliente";
						$result= mysql_query($query) or die("Query fallita! ".mysql_error());
						$riga= mysql_fetch_array($result);
						while($riga){
							echo"
								<tr><td>".$riga['CodiceFiscale']."</td><td>"
								.$riga['Password']."</td><td>".$riga['Nome']."</td><td>"
								.$riga['Cognome']."</td><td>".$riga['DataNascita']."</td><td>"
								.$riga['CittaResidenza']."</td><td>".$riga['ProvinciaResidenza'].
								"</td><td>".$riga['DataPatente']."</td>
								<td>".$riga['AnniPatente']."</td><td>".$riga['ClasseDiMerito']."
								</td></tr>";
							$riga= mysql_fetch_array($result);
						}
					echo"</table>
				</div>";
		}
		elseif ($_POST['cf2']==NULL) {
			echo"
				<div id='corpo'>
					<h3>Errore nell'inserimento dei dati</h3>";
					unset($_POST['cf2']);
					header("Refresh:2; URL=new_cli.php");
			echo"</div>";
		}
		else{
			$cf2= strtoupper($_POST['cf2']);
			$psw= $_POST['psw'];
			$nome= ucfirst($_POST['nome']);
			$cogn= ucfirst($_POST['cogn']);
			$datan= $_POST['datan'];
			$citt= ucfirst($_POST['citt']);
			$prov= strtoupper($_POST['prov']);
			$datap= $_POST['datap'];
			
			$query= "INSERT INTO Cliente (CodiceFiscale, Password, 
				Nome, Cognome, DataNascita, CittaResidenza, ProvinciaResidenza
				, DataPatente, AnniPatente) 
				VALUES ('$cf2','$psw','$nome','$cogn','$datan','$citt',
				'$prov','$datap', 0)";
			$result= mysql_query($query) or die("Query fallita! ".mysql_error());
			if($result){
					$query2= "SELECT AnniPatente('$cf2') AS AnniPatente";
					$result2= mysql_query($query2) or die("Query fallita2! ".mysql_error());
					$ris= mysql_fetch_array($result2);
					$anni= $ris['AnniPatente'];
					$query3= "UPDATE Cliente 
								SET AnniPatente='$anni'
								WHERE CodiceFiscale='$cf2'";
					$result3= mysql_query($query3);
					if($result3){
						echo"
						<div id='corpo'>
							<h3>Inserimento effettuato!</h3>";
							unset($_POST['cf2']);
							header("Refresh:2; URL=new_cli.php");
						echo"</div>";
					}
			}
		}
	}
	page_end();
?>