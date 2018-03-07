<?php
	require("library.php"); //Funzioni utili
	//Distruggi sessione
	session_start();
	$sname=session_name();
	session_destroy();
	//Cancella il cookie corrispondente
	if(isset($_COOKIE[$sname]))
	{
 		setcookie($sname,'', time()-3600,'/');
	}
	//Inizio pagina
	printHeader("Logout - Agenzia Assicurativa","","logout");
	echo "<div id='corpo'><h3>Logout effettuato.</h3></div>";
	//Fine pagina
	page_end();
?>