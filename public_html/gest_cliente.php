<?php
	require("library.php");
	printHeader("Dati Cliente - Agenzia Assicurativa","","gestione_cliente");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])) OR $_SESSION['typelog']!='1'){
		echo "<h3>Effettuare il login come Cliente per accedere a questa pagina.</h3>";
	}
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];
		gest_menu($typelog, "gestione_cliente");
		if($typelog!=1)
			echo" <h3>Effettuare il login come cliente!</h3>";
		else{
			$query= "SELECT Nome, Cognome, DataNascita, CittaResidenza, ProvinciaResidenza, 
					DataPatente, AnniPatente, ClasseDiMerito
					FROM Cliente WHERE CodiceFiscale= '$cf'";
			$result= mysql_query($query) or die("Query fallita!". mysql_error());
			$tmpuserdata= mysql_fetch_assoc($result);
			echo "
				<div id='corpo'>
				<h3>Dati Anagrafici</h3>
				<table>
					<tr><th>Nome</th><td>".$tmpuserdata['Nome']."</td></tr>
					<tr><th>Cognome</th><td>".$tmpuserdata['Cognome']."</td></tr>
					<tr><th>Data di nascita</th><td>". $tmpuserdata['DataNascita']."</td></tr>
					<tr><th>Città di residenza</th><td>". $tmpuserdata['CittaResidenza']."</td></tr>
					<tr><th>Provincia di residenza</th><td>". $tmpuserdata['ProvinciaResidenza']."</td></tr>
					<tr><th>Data patente</th><td>". $tmpuserdata['DataPatente']."</td></tr>
					<tr><th>Anni patente</th><td>". $tmpuserdata['AnniPatente']."</td></tr>
					<tr><th>Classe di merito</th><td>". $tmpuserdata['ClasseDiMerito']."</td></tr>
				</table>
				</div>";	

		}
	}
	page_end();
?>