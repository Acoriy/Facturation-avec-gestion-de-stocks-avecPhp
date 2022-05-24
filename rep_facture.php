<?php 
	$liaison2 = mysqli_connect('127.0.0.1', 'gStock', 'gS123k12');
	mysqli_select_db($liaison2, 'stocks');
	
		if(isset($_POST["param"]))
		{		
			switch($_POST["param"])
			{
				case "recup_client":
					$requete = "SELECT * FROM clients WHERE Client_num = ".$_POST["ref_client"].";";
					$retours = mysqli_query($liaison2, $requete);
					$retour = mysqli_fetch_array($retours);
					$chaine = $retour["Client_civilite"]."|".$retour["Client_nom"]."|".$retour["Client_prenom"];
					print($chaine);					
				break;
				
				case "recup_article":
					$requete = "SELECT * FROM articles WHERE Article_code = '".$_POST["ref_produit"]."';";
					$retours = mysqli_query($liaison2, $requete);
					$retour = mysqli_fetch_array($retours);
					$chaine = $retour["Article_designation"]."|".$retour["Article_PUHT"]."|".$retour["Article_Qte"];	
					print($chaine);					
				break;

				case "creer_client":
					$requete = "SELECT COUNT(Client_num) AS nb FROM clients WHERE Client_nom='".$_POST["nom_client"]."' AND Client_prenom='".$_POST["prenom_client"]."';";
					$retours = mysqli_query($liaison2, $requete);
					$retour = mysqli_fetch_array($retours);
					if($retour["nb"]>0)	
						print("nok");
					else
					{
						$requete = "INSERT INTO clients(Client_civilite, Client_nom, Client_prenom) VALUES ('".$_POST["civilite"]."', '".$_POST["nom_client"]."', '".$_POST["prenom_client"]."');";
						$retours = mysqli_query($liaison2, $requete);
						if($retours==1)
							print(mysqli_insert_id($liaison2));
					}
				break;				
			}
		}
	
	mysqli_close($liaison2);
?>