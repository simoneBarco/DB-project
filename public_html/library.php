<?php

//Funzione per iniziare la pagina. In input i titoli
function page_start($title,$longtitle) {
  echo<<<END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="it" lang="it">
<head><link rel="stylesheet" href="st.css"  type="text/css" media="screen"/>
<script> 
function apri(url) { 
    newin = window.open(url,'titolo','scrollbars=no,resizable=yes, width=290,height=320,status=no,location=no,toolbar=no');
}
function apri2(url) { 
    newin = window.open(url,'titolo','scrollbars=no,resizable=yes, width=1300,height=200,status=no,location=no,toolbar=no');
}
</script>

<title>$title</title></head>
<body>
	<div id="testata">
		<h2>$longtitle</h2>
	</div>
END;
};

function printHeader($title,$longtitle,$pageName)
{
	if($longtitle==""){$longtitle=$title;}
	page_start($title,$longtitle);
	//Apri sessione
	session_start();
	if(isset($_SESSION['login']))
	{
		$typel=$_SESSION['typelog'];
	}
	else
	{
		$typel=0;
	}
	main_menu($typel,$pageName);
}
function printHeader2($title,$longtitle,$pageName)
{
	if($longtitle==""){$longtitle=$title;}
	page_start($title,$longtitle);
	//Apri sessione
	session_start();
	if(isset($_SESSION['login']))
	{
		$typel=$_SESSION['typelog'];
	}
	else
	{
		$typel=0;
	}
	
}
//Generazione dinamica menù
function main_menu($typelog,$currentPage)
{
	echo"
		<div id=\"nav\">
			<ul>";
	//Pagine comuni
	if($currentPage=="home"){echo"<li>Home</li>";}else{echo"<li><a href=\"index.php\">Home</a></li>";}
	//if($currentPage=="prestazioni"){echo"<li>Prestazioni</li>";}else{echo"<li><a href=\"prova.php\">Prestazioni</a></li>";}
	//if($currentPage=="contatti"){echo"<li>Contatti</li>";}else{echo"<li><a href=\"contatti.php\">Contatti</a></li>";}
	//Tipo di login
	if($typelog<1)
	{
		if($currentPage=="login"){echo"<li>Login</li>";}else{echo"<li><a href=\"login.php\">Login</a></li>";} //Utente non loggato
	}
	else
	{
		if($currentPage=="logout"){echo"<li>Logout</li>";}else{echo"<li><a href=\"logout.php\">Logout</a></li>";} //Utente loggato
		switch($typelog)
		{
			case 1: //Cliente
				if($currentPage=="gestione_cliente"){echo"<li>Gestione Cliente</li>";}else{echo"<li><a href=\"gest_cliente.php\">Gestione Cliente</a></li>";} //Cliente
				break;
			case 2: //Produttore
				if($currentPage=="gestione"){echo"<li>Gestione Dipendente</li>";}else{echo"<li><a href=\"gest_dip.php\">Gestione Dipendente</a></li>";} 
				break;
			case 3: //SubAgente
				if($currentPage=="gestione"){echo"<li>Gestione Dipendente</li>";}else{echo"<li><a href=\"gest_dip.php\">Gestione Dipendente</a></li>";} 
				break;
			case 4: //Agente
				if($currentPage=="gestione"){echo"<li>Gestione Dipendente</li>";}else{echo"<li><a href=\"gest_dip.php\">Gestione Dipendente</a></li>";} 
				break;
		}
	}
	echo<<<END
		</ul>
	</div>
END;
};

//Generazione menù gestione
function gest_menu($typelog,$currentPage)
{
	echo<<<BEG
		<div id="gestnav">
			<ul>
BEG;
	//Tipo di login
			switch($typelog)
			{
				case 1: //Cliente
					if($currentPage=="gestione_cliente"){echo"<li>Dati Anagrafici</li>";}else{echo"<li><a href=\"gest_cliente.php\">Dati Anagrafici</a></li>";}
					if($currentPage=="mod_cli"){echo"<li>Modifica Residenza</li>";}else{echo"<li><a href=\"mod_cli.php\">Modifica Cliente</a></li>";}
					if($currentPage=="polizze"){echo"<li>Visualizza Polizze</li>";}else{echo"<li><a href=\"polizzeCliente.php\">Visualizza Polizze</a></li>";}
					break;
				case 2: //Produttore
					//Sottomenù
					if($currentPage=="new_polP"){echo"<li>Nuova Polizza</li>";}else{echo"<li><a href=\"new_pol.php\">Nuova Polizza</a></li>";}
					if($currentPage=="new_cli"){echo"<li>Nuovo Cliente</li>";}else{echo"<li><a href=\"new_cli.php\">Nuovo Cliente</a></li>";}
					if($currentPage=="port"){echo"<li>Visualizza Portafoglio</li>";}else{echo"<li><a href=\"port.php\">Visualizza Portafoglio</a></li>";}
					if($currentPage=="rinn"){echo"<li>Rinnovo Polizze</li>";}else{echo"<li><a href=\"rinn.php\">Rinnovo Polizze</a></li>";}
					break;
				case 3: //SubAgente
					//Sottomenù
					if($currentPage=="mod"){echo"<li>Modifica Sede Ufficio</li>";}else{echo"<li><a href=\"mod.php\">Modifica Sede Ufficio</a></li>";}
					if($currentPage=="new_pol"){echo"<li>Nuova Polizza</li>";}else{echo"<li><a href=\"new_pol.php\">Nuova Polizza</a></li>";}
					if($currentPage=="new_cli"){echo"<li>Nuovo Cliente</li>";}else{echo"<li><a href=\"new_cli.php\">Nuovo Cliente</a></li>";}
					if($currentPage=="port"){echo"<li>Visualizza Portafoglio</li>";}else{echo"<li><a href=\"port.php\">Visualizza Portafoglio</a></li>";}
					if($currentPage=="rinn"){echo"<li>Rinnovo Polizze</li>";}else{echo"<li><a href=\"rinn.php\">Rinnovo Polizze</a></li>";}
					break;
				case 4: //Agente
					//Sottomenù
					if($currentPage=="new_pol"){echo"<li>Nuova Polizza</li>";}else{echo"<li><a href=\"new_pol.php\">Nuova Polizza</a></li>";}
					if($currentPage=="new_sub"){echo"<li>Nuovo Subagente</li>";}else{echo"<li><a href=\"new_sub.php\">Nuovo Subagente</a></li>";}
					if($currentPage=="new_prod"){echo"<li>Nuovo Produttore</li>";}else{echo"<li><a href=\"new_prod.php\">Nuovo Produttore</a></li>";}
					if($currentPage=="new_cli"){echo"<li>Nuovo Cliente</li>";}else{echo"<li><a href=\"new_cli.php\">Nuovo Cliente</a></li>";}
					if($currentPage=="port"){echo"<li>Visualizza Portafoglio</li>";}else{echo"<li><a href=\"port.php\">Visualizza Portafoglio</a></li>";}
					if($currentPage=="rinn"){echo"<li>Rinnovo Polizze</li>";}else{echo"<li><a href=\"rinn.php\">Rinnovo Polizze</a></li>";}
					break;
			}
	echo<<<END
		</ul>
	</div>
END;
};


//Funzione per terminare una pagina
function page_end() {
  echo "
</body>
</html>";
};



// Funzione per iniziare una tabella html. In input l'array che contiene gli header delle colonne
function table_start($row) {
  echo "<table>\n";
  echo "<tr>\n";
  foreach ($row as $field) 
    echo "<th>$field</th>\n";
  echo "</tr>\n";
};
  
//funzione per stampare un array, come riga di tabella html
function table_row($row) {
  echo "<tr>";
  foreach ($row as $field) 
    if ($field)
      echo "<td>$field</td>\n";
    else
      echo "<td>---</td>\n";
  echo "</tr>";
  };

//funzione per chiudere una tabella html
function table_end() {
  echo "</table>\n";
};

//Connessione in lab
function dbConnectFix()
{
	$fox=0; //Ambiente di lavoro $fox (0=lab, 1=casa)
	if($fox==1)
	{
			return(dbConnectFox());
	}
	else
	{
		$conn=mysql_connect("basidati","sbarco","Qi9uEu8h")
    or die("Impossibile connettersi!");
		mysql_select_db("sbarco-PR",$conn)
		or die(mysql_error());
		return $conn;
	}
}

//Connessione da casa
function dbConnectFox()
{
	 $conn=mysql_connect("localhost","root","")
    or die("Impossibile connettersi!");
  mysql_select_db("AgenziaAssicurativa2",$conn)
		or die(mysql_error());
  return $conn;
}


//Connessione ad un database con parametri
function paramDbConnect($dbname,$dbServer,$dbUsr,$dbPwd)
{
  $conn=mysql_connect($dbServer,$dbUsr,$dbPwd)
    or die("Impossibile connettersi!");
  mysql_select_db($dbname,$conn)
		or die(mysql_error());
  return $conn;
}

//In caso di erori nei moduli
function dieHard()
{
	echo "<h3>Dati non validi!</h3>";
	echo "<p>Controllare i dati inseriti e riprovare.</p>";	
	$url = htmlspecialchars ($_SERVER['HTTP_REFERER']);
  echo "<a href='$url'>Indietro</a>";
  die();
}

?>