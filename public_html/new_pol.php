<?php
	require("library.php");
	printHeader("Nuova Polizza - Agenzia Assicurativa","","");
	$conn= dbConnectFix();
	if(!(isset($_SESSION['login'])) OR $_SESSION['typelog']=='1')
		echo" <h3>Effettuare il login come Dipendente per accedere a questa pagina.</h3>";
	else{
		$cf= $_SESSION['login'];
		$typelog= $_SESSION['typelog'];
		if(isset($_SESSION['tipo']))
			$tipoA= $_SESSION['tipo'];
		gest_menu($typelog, "");
		if(isset($_POST['conferma'])){

			if($tipoA=='rc'){
			#INSERIMENTO RC
				$mass= $_SESSION['mass'];
				$datas= $_SESSION['datas'];
				$datasc= $_SESSION['datasc'];
				$cfcli= $_SESSION['cfcli'];
				$dur= $_SESSION['dur'];
				$prezz=$_SESSION['prezz'];
				$pote=$_SESSION['pote'];
				$cili= $_SESSION['cili'];
				
				$query= "SELECT Codice 
							FROM RCAuto 
							WHERE PrezzoAnnuo=$prezz AND Potenza='$pote' AND Cilindrata='$cili'";
				$result= mysql_query($query) or die("Query1 fallita! ".mysql_error());
				$ris= mysql_fetch_assoc($result);
				if($ris['Codice']!=NULL){
					
					$cod= $ris['Codice'];
					$query2= "INSERT INTO Polizza VALUES(NULL,'$mass','$datas','$datasc','$cfcli',NULL,'$cod','$cf')";
					$result2= mysql_query($query2) or die("Query2 fallita! ".mysql_error());
					if($result2){
						echo"<div id='corpo'>
							<h3>Inserimento avvenuto con successo!</h3>
							</div>";
						unset($_SESSION['mass']);
						unset($_SESSION['datas']);
						unset($_SESSION['datasc']);
						unset($_SESSION['cfcli']);
						unset($_SESSION['dur']);
						unset($_SESSION['prezz']);
						unset($_SESSION['pote']);
						unset($_SESSION['cili']);
						unset($_SESSION['tipo']);
						header("Refresh:2; URL=new_pol.php");
					}
				}
				else{
					$query= "INSERT INTO RCAuto VALUES(NULL,'$dur','$prezz','$pote','$cili')";
					$result= mysql_query($query) or die("Query11 fallita! ".mysql_error());
					if($result){
						echo"<div id='corpo'>
							<h3>Inserita nuova tipologia di RC Auto!<br>";
						$query2= "SELECT Codice 
							FROM RCAuto 
							WHERE PrezzoAnnuo='$prezz' AND Potenza='$pote' AND Cilindrata='$cili'";
						$result2= mysql_query($query2) or die("Query22 fallita! ".mysql_error());
						if($result2){
							$ris= mysql_fetch_assoc($result2);
							$cod= $ris['Codice'];
							$query3= "INSERT INTO Polizza VALUES(NULL,'$mass','$datas','$datasc','$cfcli',NULL,'$cod','$cf')";
							$result3= mysql_query($query3) or die("Query33 fallita! ".mysql_error());
							if($result3){
								echo"Inserimento avvenuto con successo!</h3>
									</div>";
								unset($_SESSION['mass']);
								unset($_SESSION['datas']);
								unset($_SESSION['datasc']);
								unset($_SESSION['cfcli']);
								unset($_SESSION['dur']);
								unset($_SESSION['prezz']);
								unset($_SESSION['pote']);
								unset($_SESSION['cili']);
								unset($_SESSION['tipo']);
								header("Refresh:2; URL=new_pol.php");
							}
						}
					}
				}
			}
			elseif($tipoA=='casa'){
				#INSERIMENTO CASA
				$mass= $_SESSION['mass'];
				$datas= $_SESSION['datas'];
				$datasc= $_SESSION['datasc'];
				$cfcli= $_SESSION['cfcli'];
				$dur= $_SESSION['dur'];
				$prezz=$_SESSION['prezz'];
				$annoC=$_SESSION['annoC'];
				$annoR= $_SESSION['annoR'];
				$spes= $_SESSION['spes'];
				$eve= $_SESSION['eve'];
				
				$query= "SELECT Codice 
							FROM Casa 
							WHERE PrezzoAnnuo=$prezz AND AnnoCostruzione='$annoC' 
							AND AnnoRistrutturazione='$annoR' AND SpeseLegali='$spes'
							AND Tipo='$eve'";
				$result= mysql_query($query) or die("Query1C fallita! ".mysql_error());
				$ris= mysql_fetch_assoc($result);
				if($ris['Codice']!=NULL){
					
					$cod= $ris['Codice'];
					$query2= "INSERT INTO Polizza VALUES(NULL,'$mass','$datas','$datasc','$cfcli','$cod',NULL,'$cf')";
					$result2= mysql_query($query2) or die("Query2C fallita! ".mysql_error());
					if($result2){
						echo"<div id='corpo'>
							<h3>Inserimento avvenuto con successo!</h3>
							</div>";
						unset($_SESSION['mass']);
						unset($_SESSION['datas']);
						unset($_SESSION['datasc']);
						unset($_SESSION['cfcli']);
						unset($_SESSION['dur']);
						unset($_SESSION['prezz']);
						unset($_SESSION['annoC']);
						unset($_SESSION['annoR']);
						unset($_SESSION['citt']);
						unset($_SESSION['prov']);
						unset($_SESSION['spes']);
						unset($_SESSION['eve']);
						unset($_SESSION['tipo']);
						header("Refresh:2; URL=new_pol.php");
					}
				}
				else{
					$query= "INSERT INTO Casa VALUES(NULL,'$dur','$prezz','$annoC','$annoR','$spes','$eve')";
					$result= mysql_query($query) or die("Query11C fallita! ".mysql_error());
					if($result){
						echo" <div id='corpo'>
								<h3>Inserita nuova tipologia di Casa!<br>";
						$query2= "SELECT Codice 
							FROM Casa 
							WHERE PrezzoAnnuo=$prezz AND AnnoCostruzione='$annoC' 
							AND AnnoRistrutturazione='$annoR' AND SpeseLegali='$spes'
							AND Tipo='$eve'";
						$result2= mysql_query($query2) or die("Query22C fallita! ".mysql_error());
						if($result2){
							$ris= mysql_fetch_assoc($result2);
							$cod= $ris['Codice'];
							$query3= "INSERT INTO Polizza VALUES(NULL,'$mass','$datas','$datasc','$cfcli','$cod',NULL,'$cf')";
							$result3= mysql_query($query3) or die("Query33C fallita! ".mysql_error());
							if($result3){
								echo"Inserimento avvenuto con successo!</h3>
									</div>";
									unset($_SESSION['mass']);
								unset($_SESSION['datas']);
								unset($_SESSION['datasc']);
								unset($_SESSION['cfcli']);
								unset($_SESSION['dur']);
								unset($_SESSION['prezz']);
								unset($_SESSION['annoC']);
								unset($_SESSION['annoR']);
								unset($_SESSION['citt']);
								unset($_SESSION['prov']);
								unset($_SESSION['spes']);
								unset($_SESSION['eve']);
								unset($_SESSION['tipo']);
								header("Refresh:2; URL=new_pol.php");
							}
						}
					}
				}
			}
		}
		elseif(isset($_POST['inserisci'])){
			if($tipoA=='rc'){
			#CONFERMA RC
				$mass= $_POST['mass'];
				$datas= $_POST['dataS'];
				$datasc= $_POST['dataSc'];
				$cfcli= $_POST['cfcli'];
				$dur= $_POST['dur'];
				//
				if($_POST['prezzo']==0)
					$prezz=$_POST['pre2'];
				else
					$prezz=$_POST['prezzo'];
				//
				if($_POST['potenza']==0)
					$pote=$_POST['pot2'];
				else
					$pote= $_POST['potenza'];
				//
				if($_POST['cil']==0)
					$cili= $_POST['cil2'];
				else
					$cili= $_POST['cil'];
				$_SESSION['mass']= $mass;
				$_SESSION['datas']= $datas;
				$_SESSION['datasc']= $datasc;
				$_SESSION['cfcli']= $cfcli;
				$_SESSION['dur']= $dur;
				$_SESSION['prezz']= $prezz;
				$_SESSION['pote']= $pote;
				$_SESSION['cili']= $cili;
				echo"
					<div id='corpo'>
					<form action='new_pol.php' method='post'>
					<fieldset>
					<legend><h3>Conferma dati</h3></legend>
						<table>
							<tr><th>Massimale</th><td>".$mass."</td></tr>
							<tr><th>DataStipula</th><td>".$datas."</td></tr>
							<tr><th>DataScadenza</th><td>".$datasc."</td></tr>
							<tr><th>CodiceFiscale</th><td>".$cfcli."</td></tr>
							<tr><th>Durata</th><td>".$dur."</td></tr>
							<tr><th>Prezzo annuo</th><td>".$prezz."</td></tr>
							<tr><th>Potenza</th><td>".$pote."</td></tr>
							<tr><th>Cilindrata</th><td>".$cili."</td></tr>";
							$query= "SELECT AnniPatente FROM Cliente WHERE CodiceFiscale='$cfcli'";
							$result= mysql_query($query) or die("Query fallita! ".mysql_error());
							$riga= mysql_fetch_assoc($result);
						echo"<tr><th>Anni patente</th><td>".$riga['AnniPatente']."</td></tr>";
							$query2= "SELECT ClasseDiMerito FROM Cliente WHERE CodiceFiscale='$cfcli'";
							$result2= mysql_query($query2) or die("Query fallita! ".mysql_error());
							$riga2= mysql_fetch_assoc($result2);
						echo"
							<tr><th>Classe di Merito</th><td>".$riga2['ClasseDiMerito']."</td></tr>
							<tr><td><input type='submit' name='conferma' value='Conferma' class='button'></td>
						</table>
					</fieldset>
					</form>
				</div>";
			}
			elseif ($tipoA=='casa'){
			#CONFERMA CASA
				$mass= $_POST['mass'];
				$datas= $_POST['dataS'];
				$datasc= $_POST['dataSc'];
				$cfcli= $_POST['cfcli'];
				$dur= $_POST['dur'];
				//
				if($_POST['prezzo']==0)
					$prezz=$_POST['pre2'];
				else
					$prezz=$_POST['prezzo'];
				$annoC= $_POST['annoC'];
				$annoR= $_POST['annoR'];
				//
				if($_POST['spes']==0)
					$spes= $_POST['spes2'];
				else
					$spes= $_POST['spes'];
				//
				if($_POST['eve']=='0')
					$eve= $_POST['eve2'];
				else
					$eve= $_POST['eve'];
				$_SESSION['mass']= $mass;
				$_SESSION['datas']= $datas;
				$_SESSION['datasc']= $datasc;
				$_SESSION['cfcli']= $cfcli;
				$_SESSION['dur']= $dur;
				$_SESSION['prezz']= $prezz;
				$_SESSION['annoC']= $annoC;
				$_SESSION['annoR']= $annoR;
				$_SESSION['spes']= $spes;
				$_SESSION['eve']= $eve;
				
				echo"
					<div id='corpo'>
					<form action='new_pol.php' method='post'>
					<fieldset>
					<legend><h3>Conferma Dati</h3></legend>
						<table>
							<tr><th>Massimale</th><td>".$mass."</td></tr>
							<tr><th>DataStipula</th><td>".$datas."</td></tr>
							<tr><th>DataScadenza</th><td>".$datasc."</td></tr>
							<tr><th>CodiceFiscale</th><td>".$cfcli."</td></tr>
							<tr><th>Durata</th><td>".$dur."</td></tr>
							<tr><th>Prezzo annuo</th><td>".$prezz."</td></tr>
							<tr><th>Anno costruzione</th><td>".$annoC."</td></tr>
							<tr><th>Anno ristrutturazione</th><td>".$annoR."</td></tr>";
							$query="SELECT CittaResidenza FROM Cliente WHERE CodiceFiscale='$cfcli'";
							$result= mysql_query($query);
							$riga= mysql_fetch_assoc($result);
							echo"
							<tr><th>Città</th><td>".$riga['CittaResidenza']."</td></tr>";
							$query= "SELECT ProvinciaResidenza FROM Cliente WHERE CodiceFiscale='$cfcli'";
							$result= mysql_query($query);
							$riga= mysql_fetch_assoc($result);
							echo"
							<tr><th>Provincia</th><td>".$riga['ProvinciaResidenza']."</td></tr>
							<tr><th>Spese legali</th><td>".$spes."</td></tr>
							<tr><th>Tipo</th><td>".$eve."</td></tr>

							<tr><td><input type='submit' name='conferma' value='Conferma' class='button'></td></tr>
						</table>
					</fieldset>
					</form>
				</div>";
			}
		}
		else{
			if(isset($_POST['tipo'])){
				if($_POST['tipo']=='rc'){
					#--------------------------RCAUTO-------------------
					$_SESSION['tipo']=$_POST['tipo'];
					echo"
						<div id='corpo'>
							<form action='new_pol.php' method='post'>
								<fieldset>
									<legend><h3>Dati nuova polizza RCAuto</h3></legend>
									<table>
										<tr><th>Massimale</th><td><input type='text' name='mass'></td></tr>
										<tr><th>DataStipula</th><td><input type='text' name='dataS' value='1970-01-01'></td></tr>
										<tr><th>Data scadenza</th><td><input type='text' name='dataSc' value='1971-01-01'></td></tr>
										<tr><th>Codice Fiscale Cliente</th><td>";
										$query= "SELECT CodiceFiscale FROM Cliente";
										$result= mysql_query($query);
										if($result && mysql_num_rows($result)>0){
											echo"<select name='cfcli'>";
											while($row= mysql_fetch_assoc($result)){
												?>
													<option value="<?php echo $row['CodiceFiscale']?>"><?php echo $row['CodiceFiscale']?></option>
												<?php
											}	
											echo"</select>";
										}
										echo "<tr><th>Durata</th><td><input type='text' name='dur' value='12' readonly></td></tr>
										<tr><th>Prezzo annuo</th><td><select name='prezzo'>";
										$query= "SELECT PrezzoAnnuo FROM RCAuto
												GROUP BY PrezzoAnnuo";
										$result= mysql_query($query);
										if($result && mysql_num_rows($result)>0){
											while($row= mysql_fetch_assoc($result)){
												?>
												<option value="<?php echo $row['PrezzoAnnuo']?>"><?php echo $row['PrezzoAnnuo']?></option>
												<?php
											}	
										}echo"<option value='0'>Altro</option>
											</select>";
										echo"</td><td><input type='text' name='pre2'></td></tr>";										
										echo"<tr><th>Potenza</th><td>
										<select name='potenza'>";
										$query= "SELECT Potenza FROM RCAuto
												GROUP BY Potenza";
										$result= mysql_query($query);
										if($result && mysql_num_rows($result)>0){
											while($row= mysql_fetch_assoc($result)){
												?>
													<option value="<?php echo $row['Potenza']?>"><?php echo $row['Potenza']?></option>
												<?php
											}	
										}
										echo"<option value='0'>Altro</option>
											</select>";
										echo"</td><td><input type='text' name='pot2'></td></tr>
										<tr><th>Cilindrata</th><td>";
										echo"<select name='cil'>";
										$query= "SELECT Cilindrata FROM RCAuto
												GROUP BY Cilindrata";
										$result= mysql_query($query);
										if($result && mysql_num_rows($result)>0){
											while($row= mysql_fetch_assoc($result)){
												?>
													<option value="<?php echo $row['Cilindrata']?>"><?php echo $row['Cilindrata']?></option>
												<?php
											}	
										}
										echo"<option value='0'>Altro</option>
											</select></td><td><input type='text' name='cil2'</td></tr>";
										echo"<tr><td><input type='submit' name='inserisci' value='Inserisci' class='button'></td></tr>
									</table>
								</fieldset>
							</form>
						</div>";
				}
				else if($_POST['tipo']=='casa'){
				#--------------------------CASA-------------------
				$_SESSION['tipo']=$_POST['tipo'];
					echo"
						<div id='corpo'>
							<form action='new_pol.php' method='post'>
								<fieldset>
									<legend><h3>Dati nuova polizza Casa</h3></legend>
									<table>
										<tr><th>Massimale</th><td><input type='text' name='mass'></td></tr>
										<tr><th>Data stipula</th><td><input type='text' name='dataS' value='1970-01-01'></td></tr>
										<tr><th>Data scadenza</th><td><input type='text' name='dataSc' value='1971-01-01'></td></tr>
										<tr><th>Codice Fiscale Cliente</th><td>";
										$query= "SELECT CodiceFiscale FROM Cliente";
										$result= mysql_query($query);
										if($result && mysql_num_rows($result)>0){
											echo"<select name='cfcli'>";
											while($row= mysql_fetch_assoc($result)){
												?>
													<option value="<?php echo $row['CodiceFiscale']?>"><?php echo $row['CodiceFiscale']?></option>
												<?php
											}	
											echo"</select>";
										}
										echo"</td></tr>
										<tr><th>Durata</th><td><input type='text' name='dur' value='180' readonly></td></tr>
										<tr><th>Prezzo annuo</th><td><select name='prezzo'>";
										$query= "SELECT PrezzoAnnuo FROM Casa
												GROUP BY PrezzoAnnuo";
										$result= mysql_query($query);
										if($result && mysql_num_rows($result)>0){
											while($row= mysql_fetch_assoc($result)){
												?>
												<option value="<?php echo $row['PrezzoAnnuo']?>"><?php echo $row['PrezzoAnnuo']?></option>
												<?php
											}	
										}echo"<option value='0'>Altro</option>
											</select><td><input type='text' name='pre2'></td></tr>
										<tr><th>Anno costruzione</th><td><input type='text' name='annoC'></td></tr>
										<tr><th>Anno ristrutturazione</th><td><input type='text' name='annoR'></td></tr>
										<tr><th>Spese Legali</th><td>";
										$query= "SELECT SpeseLegali FROM Casa
												GROUP BY SpeseLegali";
										$result= mysql_query($query);
										if($result && mysql_num_rows($result)>0){
											echo"<select name='spes'>";
											while($row= mysql_fetch_assoc($result)){
												?>
													<option value="<?php echo $row['SpeseLegali']?>"><?php echo $row['SpeseLegali']?></option>
												<?php
											}	
											echo"<option value='0'>Altro</option>
											</select>";
										}
										echo"</td><td><input type='text' name='spes2'></td></tr>
										<tr><th>Tipo</th><td>";
										$query= "SELECT Tipo FROM Casa
												GROUP BY Tipo";
										$result= mysql_query($query);
										if($result && mysql_num_rows($result)>0){
											echo"<select name='eve'>";
											while($row= mysql_fetch_assoc($result)){
												?>
													<option value="<?php echo $row['Tipo']?>"><?php echo $row['Tipo']?></option>
												<?php
											}	
											echo"<option value='0'>Altro</option>
											</select>";
										}
										echo"</td><td><input type='text' name='eve2'></td></tr>
										<tr><td><input type='submit' name='inserisci' value='Inserisci' class='button'></td></tr>

									</table>
								</fieldset>
							</form>
						</div>";
				}
			}
			else{
				echo"
					<div id='corpo'>
						<h3>Scegliere tipo di assicurazione</h3>
						<form action='new_pol.php' method='post'>
							<fieldset>
								<legend><h3>Tipo assicurazione</h3></legend>
								RCAuto <input type='radio' name='tipo' value='rc'><br>
								Casa <input type='radio' name='tipo' value='casa'><br>
								<input type='submit' value='Continua' class='button'>
							</fieldset>
						</form>";
					echo"</div>";
			}
		}
	}
	page_end();
?>
