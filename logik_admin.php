<?php 

$login = $_POST['login'];
$password = $_POST['password'];

if ($login == '') {
	echo 'Введите login';
	exit();
} elseif ($password == '') {
	echo 'Введите пароль';
	exit();
}

require_once 'configDB.php';

$sql = 'SELECT * FROM `user` ';
$query = $pdo->query($sql);
while ($row = $query->fetch(PDO::FETCH_OBJ)) {
	if ($row->login === $login && $row->password === $password) {
		header('Location: /admin.php');
	} else {
		header('Location: /admin_check.php?id=error');
	}
	
	
}

//
?>