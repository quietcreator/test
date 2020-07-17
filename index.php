<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=devices-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Список задач</title>

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<style>
		input[type=checkbox], input[type=radio] {
			width: 30px;
		}
		.qwer {
			display: inline-block;
		}
	</style>
</head>
<body>
	<div class="container">

		<a href="<?='/admin_check.php'?>"><button class="mt-2 btn btn-primary">Войти</button></a>

		<?php 
			// текущая страница
			$page = 1;
			if (isset($_GET['page']) && $_GET['page'] > 0) {
			    $page = $_GET['page'];
			}
		?>

		<h1>Список задач</h1>
		<form action="/handler.php?page=<?=$page?>" method="post">
		    <p><input name="sort" type="radio" value="name" checked>Имени пользователя</p>
		    <p><input name="sort" type="radio" value="email">Email</p>
		    <p><input name="sort" type="radio" value="performed">Статус</p>
		    <p><input name="sort" type="radio" value="no">Без сортировки</p>
		    <p><input name="typesort" type="radio" value="up" checked>По возрастанию</p>
		    <p><input name="typesort" type="radio" value="down">По убыванию</p>
		    <p><input type="submit" value="Сортировать"></p>
		</form>
		

		<?php require_once 'index_code.php'; ?>

		<h2 class="mt-5">Создать задачу</h2>
		<?php
			if (isset($_GET['goal'])) {
				?>
				<div class="alert alert-success" role="alert">
					Задание успешно добавлено!
				</div>
				<?php
			}
		?>
		<form action="/add.php?admin=false" method="post" class="form">
			<label for="name">Имя пользователя</label>
			<input type="text" name="name" id="name" placeholder="Введите имя..." class="form-control">
			
			<label for="email" class="mt-3">Email пользователя</label>
			<input type="text" name="email" id="email" placeholder="Введите email..." class="form-control">
			
			<label for="message" class="mt-3">Описание задачи</label>
			<textarea name="task" id="task" placeholder="Введите текст сообщения..." class="form-control"></textarea>
			
			<button type="submit" name="sendTask" class="btn btn-success mt-3">Отправить</button>
		</form>
	</div>
</body>
</html>