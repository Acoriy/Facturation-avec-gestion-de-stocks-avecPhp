<?php 
	include("commun/connexion.php");
	include("commun/entete.php");
?>
<script language='javascript' type="text/javascript">
function recolter()
{
	document.getElementById("formulaire").request({
		onComplete:function(transport){
			if(document.getElementById('tampon').value=='recup')
			{
				var tab_info = transport.responseText.split('|');
				document.getElementById('des_produit').value = tab_info[0];
				document.getElementById('qte_produit_avt').value = tab_info[1];
				document.getElementById('qte_produit_aps').value = "";
				document.getElementById('qte_produit').value = "";
			}
			else
			{
				if(transport.responseText=="ok")
				{
					document.getElementById('qte_produit_aps').value= parseInt(document.getElementById('qte_produit_avt').value) + parseInt(document.getElementById('qte_produit').value);
					document.getElementById('msg_reponse').innerText = "Le stock a été mis à jour avec succès";
				}
				else
					document.getElementById('msg_reponse').innerText = "Une erreur est survenue, le stock est inchangé";
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
			<h1>Approvisionnement des stocks du magasin</h1>
			</div>
			</div>
			<div style="float:left;width:10%;height:40px;"></div>
			
			<div class="div_saut_ligne" style="height:30px;">
			</div>
			
			<div style="float:left;width:10%;height:250px;"></div>
			<div style="float:left;width:80%;height:250px;text-align:center;">
			<form id="formulaire" name="formulaire" method="post" action="rep_stock.php">
				<div class="titre_h1" style="height:250px;">
					<div style="width:10%;height:75px;float:left;"></div>
					<div style="width:35%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Référence à mettre à jour :<br />
						<select id="ref_produit" name="ref_produit" onchange="document.getElementById('tampon').value='recup';recolter();">
							<option value="0">Choisir une référence</option>
							<?php 
								$requete = "SELECT Article_code FROM articles ORDER BY Article_code;";
								$retours = mysqli_query($liaison, $requete);
								while($retour = mysqli_fetch_array($retours))
								{
									echo "<option value='".$retour["Article_code"]."'>".$retour["Article_code"]."</option>";
								}					
							?>
						</select>
						<input type="text" id="tampon" name="tampon" style="visibility:hidden;" />
					</div>
					<div style="width:10%;height:75px;float:left;"></div>
					<div style="width:35%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Désignation du produit :<br />
						<input type="text" id="des_produit" name="des_produit" disabled />
					</div>
					<div style="width:10%;height:75px;float:left;"></div>
					
					
					<div style="width:10%;height:75px;float:left;"></div>
					<div style="width:20%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Quantité en + ou + :<br />
						<input type="text" id="qte_produit" name="qte_produit" />
					</div>
					<div style="width:10%;height:75px;float:left;"></div>
					<div style="width:20%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Quantité avt MAJ :<br />
						<input type="text" id="qte_produit_avt" name="qte_produit_avt" disabled />
					</div>
					<div style="width:10%;height:75px;float:left;"></div>
					<div style="width:20%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						Quantité aps MAJ :<br />
						<input type="text" id="qte_produit_aps" name="qte_produit_aps"  />
					</div>					
					<div style="width:10%;height:75px;float:left;"></div>					

			<div class="div_saut_ligne" style="height:30px;">
			</div>					
					
					<div style="width:10%;height:75px;float:left;"></div>
					<div style="width:35%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						<input type="button" id="valider" name="valider" value="Valider la mise à jour" onclick="document.getElementById('tampon').value='maj';recolter();" />
					</div>
					<div style="width:10%;height:75px;float:left;"></div>
					<div id="msg_reponse" style="width:35%;height:75px;float:left;font-size:16px;font-weight:bold;text-align:left;">
						<?php 
							echo "Réponse serveur";
						?>
					</div>
					<div style="width:10%;height:75px;float:left;"></div>					
					
				</div>
			</form>
			</div>
			<div style="float:left;width:10%;height:250px;"></div>			
			
			<div class="div_saut_ligne" style="height:50px;">
			</div>				
<?php 
	include("commun/pied-page.php");
?>