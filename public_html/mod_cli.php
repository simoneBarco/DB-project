<?php
	require("library.php");
	printHeader("Modifica Residenza - Agenzia Assicurativa","","mod_cli");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])))
		echo" <h3>Effettuare il login per accedere alla pagina.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];

		gest_menu($typelog, "mod_cli");
		if(isset($_POST['citta']) AND isset($_POST['provi'])){
			$citt= ucfirst($_POST['citta']);
			$prov= strtoupper($_POST['provi']);
			$query= "UPDATE Cliente SET CittaResidenza='$citt', ProvinciaResidenza='$prov' 
					WHERE CodiceFiscale='$cf'";
			$result= mysql_query($query) or die("Query fallita! ".mysql_error());
			if($result){
				echo"
					<div id='corpo'>
						<h3>Modifica effettuata!</h3>";
						unset($_POST['citta']);
						unset($_POST['provi']);
						header("Refresh:2; URL=mod_cli.php");
				echo"</div>";
			}
		}
		else{
		echo"
			<div id='corpo'>";
				$query= "SELECT CittaResidenza, ProvinciaResidenza
						FROM Cliente
						WHERE CodiceFiscale='$cf'";
				$result= mysql_query($query) or die("Query fallita! ".mysql_error());
				$riga= mysql_fetch_array($result);
				$citt= $riga['CittaResidenza'];
				$prov= $riga['ProvinciaResidenza'];
				echo "
					<form action='mod_cli.php' method='post'>
						<fieldset>
							<legend><h3>Modifica Residenza</h3></legend>
							<table>
								<tr><td>Città attuale</td><td>".$citt."</td></tr>
								<tr><td>Provincia attuale</td><td>".$prov."</td></tr>
								<tr><td>Nuova Città</td><td><input type='text' name='citta'></td></tr>
								<tr><td>Nuova Provincia</td><td><input type='text' name='provi'></td></tr>
								<tr><td><input type='submit' value='Modifica' class='button'></td></tr>
							</table>
						</fieldset>
					</form>
				</div>";
		}
	}
	page_end();
?>