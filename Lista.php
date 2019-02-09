
<?php
//lez 56
    include "lib/gestore_connessione.php";
    include "lib/prodotti.php";
    include "header.php";
?>
<?php
 $nl="<br />";
 // Sicurezza
 if($_SERVER['REQUEST_METHOD']=='POST')
 {
    // recuperiamo i dati
   $email =$_POST['username'];
   $psw =$_POST['password'];
    // Verifica Bottone premuto
    if(isset($_POST['submit']))
    {
      $comandoSQL=
      "SELECT * psw From users WHERE email ='".$email."'";
      
       //1 Stabilire una (o più) connessione/i
       $conn = mysqli_connect("localhost", "web_visitor", "sporting93","magazzino");
       
       //2 Selezionare database
       mysqli_select_db($conn,"magazzino");
        //2 Inviare il comando
       $risultato = mysqli_query($conn,$comandoSQL);
       //3 Elaborare il risultato
       
        // Ripetere eventualmente i passi 2 e 3
       //4 chiudere La/le connessione/i
       
       echo $comandoSQL;
    }
    else
    {
      echo "Hai premuto Register";
    }   
 }

?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Start corpo-->
<form method="post" action= "sottrazione.php">
<input name="contatore" id="contatore" type="hidden" value="0" >

<div id="corpo" >
  <!-- Start corpo Sx-->
  <div id="corpoSx">
  <section class="uno">
<div class="w3-padding w3-white notranslate">
<div class="table-responsive">
<table class=" table table-bordered ">
    <thead>
      <tr class="active">
        <th><h1>Data</h1></th>
		<th><h1>Luogo</h1></th>
		<th><h1>Prodotto</h1></th>  		
		<th><h1></h1></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="date"> </td>
        <td><select id="luogo" name="paese"></select></td>
			<script type= "text/javascript">
				  elencoPaese = new Array("Vibo Marina", "Gerocarne", "Chiaravalle", "Sorianello","Vazzano", "Pizzoni", "Serra San Bruno");
				  codicePaese = new Array(1, 2, 3, 4, 5,6 ,7);
				  // Inizializzaione combo
				  caricaDropDown('luogo', elencoPaese, codicePaese);
				  function caricaDropDown(qualeDropDown, descrizioni, valori)
					  {
							for(i=0; i<descrizioni.length; i++)
								$('#'+ qualeDropDown).append("<option value='" +
								valori[i] + "'>"+ descrizioni[i]+"</option>");
					  }
			</script>

		<td>
			<?php

				$conn= GestoreConnessione::apriConnessione($hostname, $username, $password, $database );

				$listaProdotti = Prodotto::dammiProdotti($conn);
				$j=1;

				echo "<select id='prodotti'>";
				echo "<option value='-1'>-- Select Item --</option>n";
				foreach ($listaProdotti as $prodotto)
				{
					echo "<option value='$prodotto->id'>$prodotto->nome</option>";
				}
				++$j;
				GestoreConnessione::chiudiConnessione($conn);
				echo "</select >";

			?>
		 
		</td>
        <td>
			<div id= button class="btn-group btn-group-justified" role="group" aria-label="...">
			<div class="btn-group" role="group">
				<a class="btn-cta-freequote" >
					<button type="button" class="btn btn-default" onclick = "confermaScelta() ;">
						<h4>Aggiungi</h4>
					</button>
				</a>
			</div>	
			</div>
		</td>
		   </tbody>
  </table>
  </div >
</div>

<div class="table-responsive">
<table class="table table-hover" id="lista">
    <thead>
      <tr>
		<th><h1>Prodotto</h1></th>
		<th><h1>Quantità </h1></th>  
		<th><h1>Modifica</h1></th>
      </tr>
    </thead>
	<tbody>
	
		<script>
		
			function confermaScelta()
			{
			  var count=$('#contatore').val();
			  count++;
			  $('#contatore').val(count);
			  var id_prodotto = $('#prodotti option:selected').val();
			  var nome_prodotto = $('#prodotti option:selected').text();
			  
			  
			  if($("input[name^='id_'][value='"+id_prodotto+"']").length>0)
			  {
				  alert("Il prodotto " +nome_prodotto+" è già presente nella lista");
				  return;
			  }
			  
			  
			  $('#lista').append("<tr id='elimina_"+count+"'><td>"+nome_prodotto+"<input name='id_"+count+"' id='id_"+count+"' type='hidden' value='"+id_prodotto+"' ></td><td>"+"<input class='select item-change-quantity' name='quantity_"+count+"' id='quantity_"+count+"' type='number' min='1' max='50' step='1' value='1' >"+"</td><td><button type='button' class='btn btn-default' onClick='"+
     $("#lista").on('click', '.btn.btn-default', function () {
       $(this).closest('tr').remove();
     })+
     "'><i class='fa fa-trash'></i></button></td></tr>");
     }
		</script>

	</tbody>
	</table>
</div>
  <div id=Salva class="btn-group btn-group-justified" role="group" aria-label="...">
			<div class="btn-group" role="group">
				<a class="btn-cta-freequote"  >
					<button type="submit" class="btn btn-default" >
						<h4>Salva</h4>
					</button>
				</a>
			</div>	
</div>	

</center>
</div> 
</section>
</div>
</form >
<div>			
  <!-- End corpo Sx-->
	<div class="clear"></div>
 </div> 
<!--End Corpo -->
<div id="push"></div>
</div>
<script>
 /* function cancella(id)
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
  }*/
  </script>
  
  <?php
  	
  ?>
  
<?php
include "footer.php";
?>