<?php
	require("library.php");
	printHeader2("Visualizza Dipendente - Agenzia Assicurativa","","");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])))
		echo" <h3>Effettuare il login per accedere a questa pagina.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];
		$dip= $_GET['dip'];

		if($typelog!=4){
			echo"
				<div class='pcent'>
					<h3>Dati Dipendente</h3>";
					$query= "SELECT Nome, Cognome, CittaSede, ProvinciaSede
							FROM Dipendente JOIN Agenzia ON Agenzia=Codice
							WHERE CodiceFiscale= '$dip'";

					$result= mysql_query($query) or die("Query fallita! ".mysql_error());
					$riga= mysql_fetch_array($result);
					$nome= $riga['Nome'];
					$cogn= $riga['Cognome'];
					$citta= $riga['CittaSede'];
					$prov= $riga['ProvinciaSede'];

					echo"
						<table>
							<tr><th>Nome</th><td>".$nome."</td></tr>
							<tr><th>Cognome</th><td>".$cogn."</td></tr>
							<tr><th>CittaSede</th><td>".$citta."</td></tr>
							<tr><th>ProvinciaSede</th><td>".$prov."</td></tr>
						</table>
					<a href=\"javascript:self.close()\">Chiudi</a>
				</div>";
		}
		else{
			echo"
			<div class='pcent'>
				<h3>Dati Dipendente</h3>";
				$query= "SELECT Nome, Cognome, Provvigione, CittaSede, ProvinciaSede
						FROM Dipendente JOIN Agenzia ON Agenzia=Codice
						WHERE CodiceFiscale= '$dip'";

				$result= mysql_query($query) or die("Query fallita! ".mysql_error());
				$riga= mysql_fetch_array($result);
				$nome= $riga['Nome'];
				$cogn= $riga['Cognome'];
				$provv= $riga['Provvigione'];
				$citta= $riga['CittaSede'];
				$prov= $riga['ProvinciaSede'];

				echo"
					<table>
						<tr><th>Nome</th><td>".$nome."</td></tr>
						<tr><th>Cognome</th><td>".$cogn."</td></tr>
						<tr><th>Provvigione</th><td>".$provv."%</td></tr>
						<tr><th>CittaSede</th><td>".$citta."</td></tr>
						<tr><th>ProvinciaSede</th><td>".$prov."</td></tr>
					</table>
				<a href=\"javascript:self.close()\">Chiudi</a>
			</div>";
			
		}
	}
	page_end();
?>