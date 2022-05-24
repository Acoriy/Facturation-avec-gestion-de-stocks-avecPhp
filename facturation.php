<?php 
	include("commun/connexion.php");
	include("commun/entete.php");
?>
<script language='javascript' type="text/javascript">
function recolter()
{
	document.getElementById("formulaire").request({
		onComplete:function(transport){
			switch(document.getElementById('param').value)
			{
				case 'recup_client':
					var tab_info = transport.responseText.split('|');
					document.getElementById('civilite').value = tab_info[0];
					document.getElementById('nom_client').value = tab_info[1];
					document.getElementById('prenom_client').value = tab_info[2];			
				break;
				
				case 'recup_article':
					var tab_info = transport.responseText.split('|');
					document.getElementById('designation').value = tab_info[0];
					document.getElementById('puht').value = tab_info[1];
					document.getElementById('qte').value = tab_info[2];					
				break;
				
				case 'creer_client':
					var rep = transport.responseText;
					if(rep=="nok")
						alert("Le client existe déjà");
					else
					{
						var liste = document.getElementById("ref_client");
						var option = document.createElement("option");
						option.value = rep;
						option.text = rep;
						liste.add(option);
						liste.selectedIndex = liste.length-1;						
					}
				break;				
				
			}	
		}
	});
}
</script>
			<div style="width:100%;display:block;text-align:center;">
			</div>
			
			<div class="div_saut_ligne" style="height:30px;">
			</div>						
			
			<div style="float:left;width:10%;height:40px;"></div>
			<div style="float:left;width:80%;height:auto;text-align:center;">
			<div class="titre_h1">
			<h1>Facturation Clients avec gestion des Stocks</h1>
			</div>
			</div>
			<div style="float:left;width:10%;height:40px;"></div>
			
			<div class="div_saut_ligne" style="height:30px;">
			</div>
			
			<div style="float:left;width:10%;height:350px;"></div>
			<div style="float:left;width:80%;height:350px;text-align:center;">
			<form id="formulaire" name="formulaire" method="post" action="rep_facture.php">
				<div class="titre_h1" style="height:350px;">
					<div style="width:10%;height:50px;float:left;"></div>
					<div style="width:35%;height:50px;float:left;font-size:20px;font-weight:bold;text-align:left;color:#a13638;">
						<u>Informations du client</u><br />
					</div>
					<div style="width:10%;height:50px;float:left;"></div>
					<div style="width:35%;height:50px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						<input type="button" id="creer_client" name="creer_client" value="Créer le client" onclick="document.getElementById('param').value='creer_client';recolter();" />
					</div>
					<div style="width:10%;height:50px;float:left;"></div>

					<div style="width:10%;height:75px;float:left;"></div>
					<div style="width:15%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Réf. Client :<br />
						<select id="ref_client" name="ref_client" onchange="document.getElementById('param').value='recup_client';recolter();">
							<option value="0">Choisir client</option>
							<?php 
								$requete = "SELECT Client_num FROM clients ORDER BY Client_num;";
								$retours = mysqli_query($liaison, $requete);
								while($retour = mysqli_fetch_array($retours))
								{
									echo "<option value='".$retour["Client_num"]."'>".$retour["Client_num"]."</option>";
								}
							?>
						</select>
					</div>
					<div style="width:15%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Civilité :<br />
						<input type="text" id="civilite" name="civilite" />
					</div>
					<div style="width:25%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Nom du client :<br />
						<input type="text" id="nom_client" name="nom_client" />
					</div>
					<div style="width:25%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Prénom du client :<br />
						<input type="text" id="prenom_client" name="prenom_client" />
					</div>					
					<div style="width:10%;height:75px;float:left;"></div>

			<div class="div_saut_ligne" style="height:5px;">
			</div>

					<div style="width:10%;height:50px;float:left;"></div>
					<div style="width:80%;height:50px;float:left;font-size:20px;font-weight:bold;text-align:left;color:#a13638;">
						<u>Ajout des produits commandés</u><br />
					</div>
					<div style="width:10%;height:50px;float:left;"></div>	
					
					<div style="width:10%;height:75px;float:left;"></div>
					<div style="width:15%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Réf. Produit :<br />
						<select id="ref_produit" name="ref_produit" onchange="document.getElementById('param').value='recup_article';recolter();">
							<option value="0">Réf. produit</option>
							<?php 
								$requete = "SELECT Article_code FROM articles ORDER BY Article_code;";
								$retours = mysqli_query($liaison, $requete);
								while($retour = mysqli_fetch_array($retours))
								{
									echo "<option value='".$retour["Article_code"]."'>".$retour["Article_code"]."</option>";
								}							
							?>
						</select>
					</div>
					<div style="width:15%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Qté en stock :<br />
						<input type="text" id="qte" name="qte" disabled style="text-align:right;" />
					</div>
					<div style="width:25%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Désignation du produit :<br />
						<input type="text" id="designation" name="designation" disabled />
					</div>
					<div style="width:25%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Prix unitaire HT :<br />
						<input type="text" id="puht" name="puht" disabled style="text-align:right;" />
					</div>		
					<div style="width:10%;height:75px;float:left;"></div>				

			<div class="div_saut_ligne" style="height:30px;">
			</div>

					<div style="width:10%;height:75px;float:left;"></div>
					<div style="width:15%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Qté commandée :<br />
						<input type="text" id="qte_commande" name="qte_commande" />
					</div>
					<div style="width:15%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Total commande :<br />
						<input type="text" id="total_commande" name="total_commande" disabled />
					</div>
					<div style="width:25%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						<input type="button" id="ajouter" name="ajouter" value="Ajouter" style="margin-top:10px;" /><br />
						<input type="text" id="param" name="param" style="visibility:hidden;" />
					</div>
					<div style="width:25%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						<input type="button" id="valider" name="valider" value="Valider" style="margin-top:10px;" /><br />
					</div>					
					<div style="width:10%;height:75px;float:left;"></div>			
									
					
				</div>
			</form>
			</div>
			<div style="float:left;width:10%;height:350px;"></div>	

			<div class="div_saut_ligne" style="height:50px;">
			</div>						
			
			<div style="float:left;width:10%;height:25px;"></div>
			<div style="float:left;width:80%;height:auto;text-align:center;">
				<div class="titre_h1" style="float:left;height:auto;width:100%;">
					<div style="float:left;width:5%;height:25px;"></div>
					<div style="width:15%;height:25px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Réf.
					</div>
					<div style="width:15%;height:25px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Qté
					</div>
					<div style="width:30%;height:25px;float:left;font-size:16px;font-weight:bold;text-align:left;overflow:hidden;">
						Désignation du produit
					</div>
					<div style="width:15%;height:25px;float:left;font-size:16px;font-weight:bold;text-align:right;">
						PUHT
					</div>
					<div style="width:15%;height:25px;float:left;font-size:16px;font-weight:bold;text-align:right;">
						PTHT
					</div>
					<div style="float:left;width:5%;height:25px;"></div>
					
					<div style="float:left;width:100%;height:auto;">
						<div class="bord"></div>
						<div class="suite">
							B001
						</div>
						<div class="suite">
							125
						</div>
						<div class="des">
							Chaise roulante pour bureau d'entreprise
						</div>
						<div class="prix">
							125.25
						</div>
						<div class="prix" style="font-weight:bold;">
							1243.75
						</div>
						<div class="bord"></div>						
						
					</div>				
					
				</div>
			</div>
			<div style="float:left;width:10%;height:auto;"></div>	
			
			<div class="div_saut_ligne" style="height:30px;">
			</div>				
<?php 
	include("commun/pied-page.php");
?>