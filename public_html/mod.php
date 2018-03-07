<?php
	require("library.php");
	printHeader("Modifica Sede Ufficio - Agenzia Assicurativa","","new_cli");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])) OR $_SESSION['typelog']=='1')
		echo" <h3>Effettuare il login come Dipedente per accedere a questa pagina.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];

		gest_menu($typelog, "mod");
		if(isset($_POST['sede'])){
			$sede=ucfirst($_POST['sede']);
			$query= "UPDATE SubAgente SET SedeUfficio='$sede' WHERE CFDip='$cf'";
			$result= mysql_query($query) or die("Query fallita! ".mysql_error());
			echo "
				<div id='corpo'>
					<h3>Modifica effettuata!</h3>";
					unset($_POST['sede']);
					header("Refresh:2; URL=mod.php");
				echo "</div>";
		}
		else{
			echo "
				<div id='corpo'>";
					$query= "SELECT SedeUfficio FROM SubAgente WHERE CFDip='$cf'";
					$result= mysql_query($query) or die("Query fallita! ".mysql_error());
					$riga= mysql_fetch_array($result);
					$sede= $riga['SedeUfficio'];
					echo "
						<form action='mod.php' method='post'>
							<fieldset>
								<legend><h3>Modifica Sede Ufficio</h3></legend>
								<table>
									<tr><td>Sede attuale</td><td>".$sede."</td></tr>
									<tr><td>Nuova Sede</td><td><input type='text' name='sede'></td></tr>
									<tr><td><input type='submit'  value='Modifica' class='button'></td></tr>
								</table>
							</fieldset>
						</form>";
				echo" </div>";
		}
	}
	page_end();
?>