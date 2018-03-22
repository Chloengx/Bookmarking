<?php
	foreach ($tab_v as $v) {
		$vLien = htmlspecialchars($v->get('urel'));
		$vDescription = htmlspecialchars($v->get('description'));
		$vLike = htmlspecialchars($v->get('nbLike'));

		echo "<p>" . $vDescription .' '."<br>";
		echo $vLien ."<br>";
		echo "Like" . $vLike ."<br></p>";
		echo "<hr>";
	}

?>