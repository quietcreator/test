<?php 
	$sort = $_POST['sort'];
	$getpage2 = $_GET['page'];
	
	if ($sort == 'no') {
		header('Location: /admin.php');
	} else {
		header('Location: /admin.php?page='.$getpage2.'&id='.$sort.'&typesort='.$typesort);
	}
?>