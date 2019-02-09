<?php
    include "lib/gestore_connessione.php";
    include "lib/prodotti.php";   
?>

<?php
$conn= GestoreConnessione::apriConnessione($hostname, $username, $password, $database );

$contatore = $_POST['contatore'];

for($i=1; $i<=$contatore; $i++)
{
	if(isset($_POST['id_'.$i]))
	{
		$id_prodotto = $_POST['id_'.$i];
        $quantita = $_POST['quantity_'.$i];
        
        Prodotto::sottraiQuantita($conn, $id_prodotto, $quantita);
	}
}

GestoreConnessione::chiudiConnessione($conn);

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';  

header("Location: http://$host$uri/$extra");

?>