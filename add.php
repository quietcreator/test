<?php 

$name = $_POST['name'];
$email = $_POST['email'];
$task = $_POST['task'];
if ($name == '') {
	echo 'Введите имя';
	exit();
} elseif ($email == '') {
	echo 'Введите email';
	exit();
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false ) {
	echo "E-mail адрес '$email' указан НЕверно!";
	exit();
} elseif ($task == '') {
	echo 'Введите задачу';
	exit();
}

require_once 'configDB.php';

$sql = 'INSERT INTO tasks(name, email, task) VALUE(:name, :email, :task)';
$query = $pdo->prepare($sql);
$query->execute(['name' => $name, 'email' => $email, 'task' => $task]);

$a = $_GET['admin'];

if ($a === 'true') {
	header('Location: /admin.php?goal=1');
} else {
	header('Location: /?goal=1');
}

?>