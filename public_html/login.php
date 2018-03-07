<?php
	require("library.php");
	printHeader("Login - Agenzia Assicurativa","","login");
	$conn=dbConnectFix();

	if(isset($_SESSION['login'])){
		echo "<div id='corpo'>";
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];
		switch($typelog){
			case 1: //Cliente
				$query= "SELECT Nome, Cognome FROM Cliente WHERE CodiceFiscale= '$cf'";
				$result= mysql_query($query) or die("Query fallita!". mysql_error());
				$tmpuserdata= mysql_fetch_array($result);
				echo "<p><h3>Login effettuato come cliente ". $tmpuserdata['Nome']. " ". $tmpuserdata['Cognome']."</h3></p>";
				header("Refresh:2; URL=gest_cliente.php");
				break;
			case 2: //Produttori
				$query= "SELECT Nome, Cognome FROM Dipendente JOIN Produttore ON CodiceFiscale=CFDip WHERE CodiceFiscale='$cf'";
				$result= mysql_query($query) or die("Query fallita!". mysql_error());
				$tmpuserdata= mysql_fetch_array($result);
				echo "<p><h3>Login effettuato come Produttore ". $tmpuserdata['Nome']. " ". $tmpuserdata['Cognome']."</h3></p>";
				header("Refresh:2; URL=gest_dip.php");
				break;
			case 3: //SubAgenti
				$query= "SELECT Nome, Cognome FROM Dipendente JOIN SubAgente ON CodiceFiscale=CFdip WHERE CodiceFiscale='$cf'";
				$result= mysql_query($query) or die("Query fallita!". mysql_error());
				$tmpuserdata= mysql_fetch_array($result);
				echo "<p><h3>Login effettuato come SubAgente ". $tmpuserdata['Nome']. " ". $tmpuserdata['Cognome']."</h3></p>";
				header("Refresh:2; URL=gest_dip.php");
				break;
			case 4: //Agenti
				$query= "SELECT Nome, Cognome FROM Agente a JOIN Dipendente d ON CFDip=CodiceFiscale WHERE CodiceFiscale='$cf'";
				$result= mysql_query($query) or die("Query fallita!". mysql_error());
				$tmpuserdata= mysql_fetch_array($result);
				echo "<p><h3>Login effettuato come Agente ". $tmpuserdata['Nome']. " ". $tmpuserdata['Cognome']."</h3></p>";
				header("Refresh:2; URL=gest_dip.php");
				break;
		}
		echo "</div>";
	}
	else{
		if(isset($_POST['login']) && isset($_POST['pwd'])){
			$cf= strtoupper($_POST['login']);
			$pw= $_POST['pwd'];
			echo "<p><h3>Verifica dati in corso...<h3></p>";

			$done= false;
			$query= "SELECT CodiceFiscale, Password FROM Cliente";
			$result=mysql_query($query) or die("Query fallita!" . mysql_error());
			//Clienti
			while(($row = mysql_fetch_assoc($result))&&(!$done)){
				if(($row["CodiceFiscale"]==$cf)&&($row["Password"]==$pw)){
					//Trovato
					$done=true;
					//Inizia sessione (cliente)
					$_SESSION['login']=$cf;
					$_SESSION['typelog']=1;
				}
			}

			$query="SELECT CodiceFiscale, Password FROM Dipendente JOIN Produttore ON CodiceFiscale=CFDip";
			$result=mysql_query($query) or die("Query fallita!" . mysql_error());
			//Produttori
			while(($row = mysql_fetch_assoc($result))&&(!$done)){
				if(($row["CodiceFiscale"]==$cf)&&($row["Password"]==$pw)){
					//Trovato
					$done=true;
					//Inizia sessione (subagente))
					$_SESSION['login']=$cf;
					$_SESSION['typelog']=2;
				}
			}

			$query="SELECT CodiceFiscale, Password FROM Dipendente JOIN SubAgente ON CodiceFiscale=CFDip";
			$result=mysql_query($query) or die("Query fallita!" . mysql_error());
			//SubAgenti
			while(($row = mysql_fetch_assoc($result))&&(!$done)){
				if(($row["CodiceFiscale"]==$cf)&&($row["Password"]==$pw)){
					//Trovato
					$done=true;
					//Inizia sessione (subagente))
					$_SESSION['login']=$cf;
					$_SESSION['typelog']=3;
				}
			}

			$query="SELECT CodiceFiscale, Password FROM Dipendente JOIN Agente 
							ON Dipendente.CodiceFiscale= Agente.CFDip";
			$result=mysql_query($query) or die("Query fallita!" . mysql_error());
			//SubAgenti/Produttori
			while(($row = mysql_fetch_assoc($result))&&(!$done)){
				if(($row["CodiceFiscale"]==$cf)&&($row["Password"]==$pw)){
					//Trovato
					$done=true;
					//Inizia sessione (agente)
					$_SESSION['login']=$cf;
					$_SESSION['typelog']=4;
				}
			}

			if(!$done){
				echo "<p><h3>Codice fiscale e/o password errati</h3></p>";
				header("Refresh:2; URL=login.php");
				//header("Location: login.php");
			//	header("Location: ".$_SERVER['HTTP_REFERER']);
				//exit(0);
			}
			else{
				header("Location:login.php");
			}
		}
		else{
			echo "
				<div id='corpo'>
					<form method='post' action='login.php'>
					<fieldset>
						<legend><h3>Inserire credenziali d'accesso</h3></legend>
						<table>
							<tr><td>Codice Fiscale</td>
							<td><input type='text' name='login' class='item'/></td></tr>
							<tr><td>Password</td>
							<td><input type='password' name='pwd' class='item'/></td></tr>
							<tr><td><div class='btn'>
								<input type='submit' value='Accedi' class='button'/>
							</div></td></tr>
						</table>
					</fieldset>
					</form>
				</div>";
		}
	}
	page_end();
?>