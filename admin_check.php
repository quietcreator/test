<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=devices-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Список задач</title>

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<?php 
		if (isset($_GET['id'])) {
			echo "Вы ввели неправильный логин или пароль!";
		}
		?>
		<form action="/logik_admin.php" method="post" class="form mt-5">
			<label for="login">Имя пользователя</label>
			<input type="text" name="login" id="login" placeholder="Введите имя..." class="form-control">
			
			<label for="password" class="mt-3">Email пользователя</label>
			<input type="text" name="password" id="password" placeholder="Введите пароль..." class="form-control">
			
			<button type="submit" name="sendTask" class="btn btn-success mt-3">Отправить</button>
		</form>
	</div>
</body>
</html>