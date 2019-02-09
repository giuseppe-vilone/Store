<?php
    include "header.php";
    include "lib/gestore_connessione.php";
    include "lib/prodotti.php";
    
    $nome="";
    $prezzo="";
    $quantita="";
    $descrizione="";
    $msg="";
    $msg_Nome="";
    $msg_Prezzo="";
    $msg_Quantita="";
    $msg_Descrizione="";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
       
        if(!isset ($_POST['prodotto']) )   
        {
            $msg_Nome="Nome prodotto non presente";
        }
        else
        {
            $nome=$_POST['prodotto'];
            $nome=trim($nome);
            if(strlen($nome) === 0)
            {
              $msg_Nome="Il valore é richiesto";  
            }
             if(strlen($nome) > 255)
            {
              $msg_Nome="Nome prodotto troppo lungo, max 255 caratteri";  
            }
        }

//          Prezzo        
        
         if(!isset ($_POST['prezzo']) )   
        {
            $msg_Prezzo="Il prezzo non è presente";
        }
        else
        {
            $prezzo=$_POST['prezzo'];
            $prezzo=trim($prezzo);
            if(strlen($prezzo) === 0)
            {
              $msg_Prezzo="Il valore é richiesto";  
            }
             if(strlen($prezzo) > 255)
            {
              $msg_Prezzo="Max 255 caratteri";  
            }
        }        
//          Quantità
       
        
         if(!isset ($_POST['quantity']) )   
        {
            $msg_Quantita="La quantità non è presente";
        }
        else
        {
            $quantita=$_POST['quantity'];
            $quantita=trim($quantita);
            if(strlen($quantita) === 0)
            {
              $msg_Quantita="Il valore é richiesto";  
            }
             if(strlen($prezzo) > 255)
            {
              $msg_Quantita="Max 255 caratteri";  
            }
        } 
         
//          Descrizione
            

        if(!isset ($_POST['descrizione']) )   
        {
            $msg_Descrizione="Non è stata inserita nessuna descrizione";
        }
        else
        {
            $descrizione=$_POST['descrizione'];
            $descrizione=trim($descrizione);
            if(strlen($descrizione > 4000))
            {
              $msg_Descrizione="La descrizione del prodotto è troppo lunga, max 4000 caratteri";  
            }
        }
            
        
           
        
        $prezzo=$_POST['prezzo'];
        $quantita=$_POST['quantity'];
        
        
        $descrizione=$_POST['descrizione'];
        
        
       
        
        if (strlen($msg_Nome)===0)
        {
         $prodotto=new Prodotto();
       
  
            $prodotto->nome=$nome;
            $prodotto->quantita= $quantita;
            $prodotto->prezzo=$prezzo;
            $prodotto->descrizione=$descrizione;
 
            $conn= GestoreConnessione::apriConnessione($hostname, $username, $password, $database );
            Prodotto::inserisciProdotto($conn, $prodotto);
            GestoreConnessione::chiudiConnessione($conn);
            $msg="Il Prodotto $nome è stato aggiunto";
        }
    }
?>

    <div class="contenitore">
        <div id="corpo">
           <h1><?php echo $msg  ?></h1>
            <section class="due">
                <form class="form-horizontal" role="form" style="margin-left: 25%;" method="post" action="inserisci.php" >
                    <div class="form-group">
                        <label for="prodotto" class="col-sm-3 control-label">
                            Prodotto
                        </label>
                            <div class=" col-sm-9">
                                <input type="text" name="prodotto" id="prodotto" class="form-control"  placeholder="Prodotto" value="<?php echo $nome ?>"> <?php echo $msg_Nome ?>
                            </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="prezzo" class="col-sm-3 control-label">
                            Prezzo
                        </label>
                            <div class=" col-sm-9">
                                <input type="text" class="form-control" name="prezzo" id="prezzo" placeholder="Prezzo" value="<?php echo $prezzo ?>">
                            </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="quantità" class="col-sm-3 control-label">
                            Quantità
                        </label>
                        <div class=" col-sm-9 ">
                        <input class="form-control" name="quantity" placeholder="Quantità" value="<?php echo $quantita ?>">
                        </div>
                     </div>
                    <br/>
                    <div class="form-group">
                        <label for="descrizione" class="col-sm-3 control-label">
                            Descrizione
                        </label>
                        <div class="col-sm-9">
                            <textarea type ="text "class="form-control" name="descrizione"  id="descrizione" placeholder="Descrizione del prodotto" ><?php echo $descrizione ?></textarea>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <div class="col-sm-push-3 col-sm-4">
                            <button type="submit" class="btn btn-primary">Inserisci</button>
                        </div>
                    </div>
                </form>
            </section>
            
        </div>
    </div>

<?php
include "footer.php";
?>