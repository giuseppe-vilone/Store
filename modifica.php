<?php
    include "lib/gestore_connessione.php";
    include "lib/prodotti.php";
	include "header.php";
?>
<?php
    $messaggio = "";
	$conn= GestoreConnessione::apriConnessione($hostname, $username, $password, $database );
	if($_SERVER['REQUEST_METHOD']=='GET')
	{
	
		$id=$_GET['id'];
		
		
		$prodotto = Prodotto::recuperaProdotto($conn, $id);    
	 
		
	}
	else
	{
		$id= $_POST['id'];
		$nome= $_POST['prodotto'];
		$prezzo= $_POST['prezzo'];
		$quantita= $_POST['quantity'];
		$descrizione= $_POST['descrizione'];
		$prodotto = new Prodotto();
		$prodotto->id = $id;
		$prodotto->nome = $nome;
		$prodotto->prezzo = $prezzo;
		$prodotto->quantita = $quantita;
		$prodotto->descrizione = $descrizione;
		
		
		Prodotto::aggiornaProdotto($conn, $prodotto);
		
		$messaggio = "Prodotto $id modificato";
	}
	GestoreConnessione::chiudiConnessione($conn);

?>
    <div class="contenitore">
	<h1 style= "size: 24px; color:orange; text-align: center;"><?php echo "$messaggio"?></h1>
        <div id="corpo">
           
            <section class="due">
                <form class="form-horizontal" role="form" style="margin-left: 25%;" method= "POST" >
                    <div class="form-group">
                        <label for="prodotto" class="col-sm-3 control-label">
                            Prodotto <?php echo "$prodotto->id"?>
                        </label>
                            <div class=" col-sm-9">
                                <input type="hidden" class="form-control" name = "id" id="id" value = "<?php echo "$prodotto->id"?>">
								<input type="text" class="form-control" name = "prodotto" id="prodotto" value = "<?php echo "$prodotto->nome"?>">
                            </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="prezzo" class="col-sm-3 control-label">
                            Prezzo
                        </label>
                            <div class=" col-sm-9">
                                <input type="text" class="form-control" name ="prezzo" id="prezzo" value = "<?php echo "$prodotto->prezzo"?>">
                            </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="quantità" class="col-sm-3 control-label">
                            Quantità
                        </label>
                        <div class=" col-sm-9 ">
                        <input class="select item-change-quantity" name="quantity" id="5727468" type="number" min="1" max="10" step="1" value = "<?php echo "$prodotto->quantita"?>">
                        </div>
                     </div>
                    <br/>
                    <div class="form-group">
                        <label for="descrizione" class="col-sm-3 control-label">
                            Descrizione
                        </label>
                        <div class="col-sm-9">
                            <textarea type ="text "class="form-control" name ="descrizione" id="descrizione" value = "<?php echo "$prodotto->descrizione"?>"></textarea>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <div class="col-sm-push-3 col-sm-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </section>
            
        </div>
    </div>

<?php
include "footer.php";
?>