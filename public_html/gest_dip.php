<?php
	require("library.php");
	printHeader("Gestione - Agenzia Assicurativa","","gestione");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])) OR $_SESSION['typelog']=='1')
		echo" <h3>Effettuare il login come Dipendente per accedere alla pagina.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];

		gest_menu($typelog, "gestione");
		
		$query= "SELECT Nome, Cognome, Provvigione, CittaSede, ProvinciaSede 
		FROM Dipendente JOIN Agenzia ON Agenzia=Codice WHERE CodiceFiscale='$cf'";
		$result= mysql_query($query) or die("Query fallita! ". mysql_error());
		$tmpusedata= mysql_fetch_assoc($result);
		echo"
			<div id='corpo'>";
			switch ($typelog) {
				case 2:
					echo"<p><h3>Benvenuto Produttore ".$tmpusedata['Nome']." ".
					$tmpusedata['Cognome']."</h3></p>";
					break;
				case 3:
					echo"<p><h3>Benvenuto Subagente ".$tmpusedata['Nome']." ".
					$tmpusedata['Cognome']."</h3></p>";
					break;
				case 4:
					echo"<p><h3>Benvenuto Agente ".$tmpusedata['Nome']." ".
					$tmpusedata['Cognome']."</h3></p>";
					break;
			}
			echo"
				<p>Scegliere una funzione dal men&ugrave; per continuare.</p>
				<p><h4><u>Dati Dipendente</u></h4></p>
				<table>
					<tr><th>Nome</th><td>". $tmpusedata['Nome']."</td></tr>
					<tr><th>Cognome</th><td>". $tmpusedata['Cognome']."</td></tr>
					<tr><th>Provvigione</th><td>". $tmpusedata['Provvigione']."%</td></tr>
					<tr><th>Citta Sede</th><td>".$tmpusedata['CittaSede']."</td></tr>
					<tr><th>Provincia Sede</th><td>".$tmpusedata['ProvinciaSede']."</td></tr>
				</table>
			</div>";
	}
	page_end();
?>