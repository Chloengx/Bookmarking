<?php
	$IdU = $_SESSION['IdU'];
	$compteur = 0;
	foreach ($tab_v as $v){ // lien de ce utilisateur
		$vIdL = htmlspecialchars($v['IdL']);
		foreach ($tab_lien as $l){
			$lIdL = htmlspecialchars($l->get('IdL'));
			$lUrl = htmlspecialchars($l->get('url'));
			$lDescription = htmlspecialchars($l->get('description'));
			$lLike = htmlspecialchars($l->get('nbLike'));
			if ($vIdL == $lIdL){
				$compteur = $compteur + 1;
				echo "<p>" . $lLike ." ". " <input type='button' value ='Like' onclick=window.location.href='#'><br>";
				echo "<a href='index.php?action=read&controller=lien&IdL=" . $lIdL . "'>" .$lDescription ."</a><br>";
				echo "<a href= '" . $lUrl ."'> " . $lUrl . "</a><br>";
				echo "<li><input type= 'button' value='Supprimer' onclick=window.location.href='index.php?action=supprimerLien&controller=lien&IdL=" . $lIdL . "'></li>";
				echo "<li><input type= 'button' value='Modifier' onclick=window.location.href='index.php?action=update&controller=lien&IdL=" . $lIdL . "'></li>";
				echo "</p><hr>";
			}
		}
	}

	if ($compteur == 0){
		echo '<div class= "alert alert-warning text-center"> ';
    	echo 'Vous n\'avez pas de lien partagé X__X';
   	 	echo '</div>';
	}

?>

<p class="text-center">
	<input type="button" value="Ajouter un lien" onclick="window.location.href='index.php?action=create&controller=lien'"/>
</p>