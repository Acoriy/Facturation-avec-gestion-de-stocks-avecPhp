<?php 
	$liaison2 = mysqli_connect('127.0.0.1', 'gStock', 'gS123k12');
	mysqli_select_db($liaison2, 'stocks');
	
	if(isset($_POST["tampon"]) && $_POST["tampon"]=="recup")
	{
		$requete = "SELECT * FROM articles WHERE Article_code = '".$_POST["ref_produit"]."';";
		$retours = mysqli_query($liaison2, $requete);
		$retour = mysqli_fetch_array($retours);
		$chaine = $retour["Article_designation"]."|".$retour["Article_Qte"];
		print($chaine);
	}
	else
	{
		$requete = "UPDATE articles SET Article_Qte = Article_Qte + ".$_POST['qte_produit']." WHERE Article_code = '".$_POST["ref_produit"]."';";
		$retours = mysqli_query($liaison2, $requete);
		if($retours==1)
			print("ok");
		else
			print("nok");
	}
	
	mysqli_close($liaison2);
?>