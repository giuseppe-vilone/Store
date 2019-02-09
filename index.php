
<?php
    include "lib/gestore_connessione.php";
    include "lib/prodotti.php";
    include "header.php";
?>

<!-- Start corpo-->
<div id="corpo" >
  <!-- Start corpo Sx-->
  <!--section -->
	<div id="corpoSx">
		<section class="uno">
			<div class="w3-padding w3-white notranslate">
				<center>
					<table class=" table table-bordered ">
						<thead>
							<tr>
								<th><h1>Id</h1></th>
								<th><h1>Prodotto</h1></th>
								<th><h1>Prezzo</h1></th>
								<th><h1>Quantità</h1></th>
								<th><h1>Descrizione</h1></th>
								<th><h1>Modifica</h1></th>
							</tr>
						</thead>
						<tbody>
 <?php


    $conn= GestoreConnessione::apriConnessione($hostname, $username, $password, $database );
    
    $listaProdotti = Prodotto::dammiProdotti($conn);
    $j=1;
    foreach ($listaProdotti as $prodotto)
    {
        echo "<tr><td><h3>$prodotto->id </h3></td>
              <td><h3>$prodotto->nome</h3></td>
              <td><h3> $prodotto->prezzo </h3></td>
              <td><h3>$prodotto->quantita </h3></td>
              <td><h3>$prodotto->descrizione </h3></td>"
  ?>
								<td>
									<div id= button class="btn-group btn-group-justified" role="group" aria-label="...">
										<div class="btn-group" role="group">
											<a class="btn-cta-freequote" href="modifica.php?id=<?php echo "$prodotto->id"?>"> <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i></button></a>
										</div>
										<div class="btn-group" role="group" >
											<a class="btn-cta-freequote" href="javascript:cancella(<?php echo "$prodotto->id"?>)"> <button type="button" class="btn btn-default" ><i class="fa fa-trash"></i></button></a>
										</div>
									</div>
								</td>
							</tr>
 <?php
         ++$j;
	}
    GestoreConnessione::chiudiConnessione($conn);
?>
						</tbody>

					</table>
				</center>
			</div> 
		</section>
		
		
	</div>
	<!-- End corpo Sx-->
  <!--</section>	-->
  <!--  <div id="push"></div>	-->
	<!--End Corpo -->

</div>
	
		<div class="clear"></div>
		</br>
		<div id="btnSubmit">
			<div  class="col-sm-push-3 col-sm-4">
				<a href="inserisci.php"><button type="submit" class="btn btn-primary" name="btnSubmit">Inserimento</button></a>	
			</div>	
		</div>  
  <script>
  function cancella(id)
  {
	  $.confirm({
		title: 'Elimina prodotto!',
		content: 'Vuoi eliminare il prodotto con identificativo '+id+'?',
		buttons: {
			confirm: {
				text: "Conferma",
				action: function () {					
					window.location.href = "elimina.php?id="+id;
				}
			},
			cancel: { 
				text: "Annulla"
			}
		}
	});
  }
  </script>
<?php
include "footer.php";
?>