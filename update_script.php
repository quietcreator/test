<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$task = $_POST['task'];
	if ( isset($_POST['performed']) ) {
		$performed = true;
	} else {
		$performed = false;
	}
	$id = $_GET['id'];


	require_once 'configDB.php';
	$sql = "UPDATE `tasks` SET name='$name', email='$email', task='$task', performed='$performed' WHERE `tasks`.`id`=?";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);


	header('Location: /admin.php');
?>