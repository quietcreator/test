<?php 
	$sort = $_POST['sort'];
	$typesort = $_POST['typesort'];
	$getpage2 = $_GET['page'];
	
	if ($sort == 'no') {
		header('Location: /');
	} else {
		header('Location: /?page='.$getpage2.'&id='.$sort.'&typesort='.$typesort);
	}
?>