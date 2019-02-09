
<?php
    class Prodotto
        {

//          Attributi            
            
            public
                $id = -1,
                $nome = "",
                $quantita = 0,
                $prezzo = 0.00,
                $descrizione = "";
           
  //        Metodi
  
            public static function dammiProdotti($conn)
                {
                    $commandSQL = "select ID, NOME, QUANTITA, PREZZO, DESCRIZIONE ".
                                  "from PRODOTTI";
                    $risultato = mysqli_query($conn, $commandSQL);     //esecuzione della query
                    $listaProdotti = array();
                    while($riga = mysqli_fetch_assoc($risultato))
                        {
                            $prodotto = new Prodotto();
                            
                            $prodotto->id = $riga['ID'];
                            $prodotto->nome = $riga['NOME'];
                            $prodotto->quantita = $riga['QUANTITA'];
                            $prodotto->prezzo = $riga['PREZZO'];
                            $prodotto->descrizione = $riga['DESCRIZIONE'];
                            $listaProdotti[] = $prodotto;
                            
                        }
                    return $listaProdotti;
                }
			public static function inserisciProdotto($conn, $prodotto)
			{
				$commandSQL = 	"insert into PRODOTTI ".
								"(NOME, QUANTITA, PREZZO, DESCRIZIONE) ".
								"values " .
								"('$prodotto->nome', $prodotto->quantita, $prodotto->prezzo, '$prodotto->descrizione')";
								
								$risultato = mysqli_query($conn, $commandSQL);
				
			}
			public static function recuperaProdotto($conn, $id)
				{
					$commandSQL = "select ID, NOME, QUANTITA, PREZZO, DESCRIZIONE ". "from PRODOTTI where ID=$id";
					$risultato = mysqli_query($conn, $commandSQL);
					
                    $prodotto = new Prodotto();
					
					
					if($riga = mysqli_fetch_assoc($risultato))
                        {
                            
                            
                            $prodotto->id = $riga['ID'];
                            $prodotto->nome = $riga['NOME'];
                            $prodotto->quantita = $riga['QUANTITA'];
                            $prodotto->prezzo = $riga['PREZZO'];
                            $prodotto->descrizione = $riga['DESCRIZIONE'];
                            
                        }
                    return  $prodotto;
					
				}
				
			public static function aggiornaProdotto($conn, $prodotto)
			{
				$commandSQL = 	"update Prodotti ".
								"set NOME='$prodotto->nome', ".
								"	 QUANTITA = $prodotto->quantita, ".
								"	 PREZZO = $prodotto->prezzo, ".
								"	 DESCRIZIONE = '$prodotto->descrizione' ".
								"where ID=$prodotto->id";
								
				$risultato = mysqli_query($conn, $commandSQL);

			}
			
			public static function eliminaProdotto($conn, $id)
			{
				$commandSQL = "delete from PRODOTTI where ID='$id' ";
				$risultato = mysqli_query($conn, $commandSQL);               
			}

			
			public static function sottraiQuantita($conn, $id_prodotto, $quantita)
			{
				$commandSQL = "update Prodotti ".
								"set QUANTITA = QUANTITA - $quantita ".
								"where ID = $id_prodotto";
								
				$risultato = mysqli_query($conn, $commandSQL);

			}
			

		}  
  ?>
  
  
  
        
        
       



