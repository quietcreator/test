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
		<h1>Список задач</h1>
		<?php 
			require_once 'configDB.php';

			$id = $_GET['id'];
			$sql = 'SELECT * FROM `tasks` WHERE `id` = ? ';
			//$query = $pdo->query($sql);
			$query = $pdo->prepare($sql);
			$query->execute([$id]);
			while ($row = $query->fetch(PDO::FETCH_OBJ)) {
		?>
			<form action="update_script.php?id=<?=$id?>" method="post" class="form mt-5">
				<label for="name">Имя пользователя</label>
				<input type="text" name="name" id="name" placeholder="Введите имя..." value="<?=$row->name?>" class="form-control">
				
				<label for="email" class="mt-3">Email пользователя</label>
				<input type="text" name="email" id="email" placeholder="Введите email..." value="<?=$row->email?>" class="form-control">
				
				<label for="message" class="mt-3">Описание задачи</label>
				<textarea name="task" id="task" placeholder="Введите текст сообщения..." class="form-control"><?=$row->task?></textarea>

				<label for="performed" class="mt-3">Выполнено</label>
				<input type="checkbox" name="performed" id="performed" value="a1">
				
				<button type="submit" name="sendTask" class="btn btn-success mt-3">Отправить</button>
			</form>
		<?php } ?>
	</div>

</body>
</html>