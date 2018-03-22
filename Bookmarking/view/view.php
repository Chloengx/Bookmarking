<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $pagetitle ?></title>
		<meta charset="utf-8">
	</head>

	<body>

		<?php

		if (isset($_SESSION['email'])){
			echo '<li><a href="index.php?action=update&controller=utilisateur"> Modifier</a></li>';
			echo '<li><a href="index.php?action=mes_liens&controller=lien">Mes Liens</a></li>';
			echo '<li><a href="index.php?action=deconnect&controller=utilisateur">Déconnexion</a></li>';
		}
		else {
			echo '<li><a href="index.php?action=connect&controller=utilisateur">Connexion</a></li>';
            echo '<li><a href="index.php?action=create&controller=utilisateur">Inscription</a></li>';
		}

		$filepath = file::build_path(array("view", self::$object, "$view.php"));
		require_once $filepath;
		?>

	</body>
</html>