<?php
	$lien = $v->get('url');
	$description = $v->get('description');
	$nbLike = $v->get('nbLike');
	echo '<p>' . $description .'<br>';
	echo "<a href='" . $lien . "'>". $lien . '</a><br>';
	echo $nbLike . ' Like <br>';
	echo "Comment";
?>