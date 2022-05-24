<?php 
	$titre="";
	if(isset($url_en_cours) && $url_en_cours!="")
		$titre=$url_en_cours;
	else
		$titre = "BackOffice pour approvisionner les stocks en PHP";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title><?php echo $titre; ?></title>
<meta name="description" content="Gestion des stocks en base de données MySql par le code Php" />
<meta name="robots" content="index,follow" />
<meta http-equiv="content-language" content="fr" />
<link href='styles/mef.css' rel='stylesheet' type='text/css' />
<script src="js/prototype.js" type="text/javascript"></script>

</head>
<body>
	<div class="div_conteneur_parent">
	
		<div class="div_conteneur_page">
			<a href="." target="_self">
			<img src="images/formation.png" style="width:50px;border:none;" align="left" alt="formateur informatique" />
			</a>		
			<div class="titre_page"><h1><?php echo $titre; ?></h1></div>
			
			<div class="div_int_page">