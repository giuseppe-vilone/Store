<?php
    include "lib/gestore_connessione.php";
    include "lib/prodotti.php";
    include "header.php";
?>
<?php

	$id=$_GET['id'];
    $conn= GestoreConnessione::apriConnessione($hostname, $username, $password, $database );
    
    Prodotto::eliminaProdotto($conn,$id);
    
 
    GestoreConnessione::chiudiConnessione($conn);
	
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php';  

	header("Location: http://$host$uri/$extra");

?>

