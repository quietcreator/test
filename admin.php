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
		<a href="<?='/index.php'?>"><button class="mt-2 btn btn-light">Выйти</button></a>
		<?php 
			// текущая страница
			$page = 1;
			if (isset($_GET['page']) && $_GET['page'] > 0) {
			    $page = $_GET['page'];
			}
		?>
		<h1>Список задач</h1>
		<form action="/handler2.php?page=<?=$page?>" method="post">
		    <p><input name="sort" type="radio" value="name" checked>Имени пользователя</p>
		    <p><input name="sort" type="radio" value="email">Email</p>
		    <p><input name="sort" type="radio" value="performed">Статус</p>
		    <p><input name="sort" type="radio" value="no">Без сортировки</p>
		    <p><input name="typesort" type="radio" value="up" checked>По возрастанию</p>
		    <p><input name="typesort" type="radio" value="down">По убыванию</p>
		    <p><input type="submit" value="Сортировать"></p>
		</form>
		<?php 
		// количество записей
			$connect = mysqli_connect('localhost', 'root', '', 'trudoustroistvo');
			if ($connect == false) {echo mysqli_connect_error(); exit();}
			$result = mysqli_query($connect, "SELECT * FROM `tasks`");	
			$col_str = mysqli_num_rows($result); // количество записей
			mysqli_close($connect);		

		// количество страниц
			$col_pages = ceil($col_str / 3);

		// с какой записи нам выводить
			$start = ($page - 1) * 3;


			for ($i=1; $i <= $col_pages; $i++) { 
				echo '<ul class="pagination pagination-md qwer">';
				if ($page == $i) {
					echo '<li class="page-item active mr-2" aria-current="page"><span class="page-link">'.$i.'<span class="sr-only">(current)</span></span></li>';
				} else {
					echo '<li class="page-item mr-2"><a href="?page='.$i.'" class="page-link">'.$i.'</a></li>';
				}
				echo '</ul>';
			}
			 
			require_once 'configDB.php';
			if (isset($_GET['id'])) {
				$getid = $_GET['id'];
				if ($_GET['typesort'] == 'up') {
					$sql = "SELECT * FROM `tasks` ORDER BY `tasks`.$getid ASC LIMIT $start,3";
				}
				if ($_GET['typesort'] == 'down') {
					$sql = "SELECT * FROM `tasks` ORDER BY `tasks`.$getid DESC LIMIT $start,3";
				}
			} else {
				$sql = "SELECT * FROM `tasks` LIMIT $start,3";
			}
			$query = $pdo->query($sql);
			while ($row = $query->fetch(PDO::FETCH_OBJ)) {
				echo '<div class="form mb-3">';
				echo '<div>'.$row->name.'</div>';
				echo '<div>'.$row->email.'</div>';
				echo '<div>'.$row->task.'</div>';
				if ($row->performed) {
					echo '<div class="text-info">Выполнено</div>';
				}
				echo '<div class="text-info">отредактировано администратором</div>';
				echo '<a href="/delete.php?id='.$row->id.'"><button class="mt-2 btn btn-danger">Удалить</button></a>';
				echo '<a href="/updatee.php?id='.$row->id.'"><button class="mt-2 ml-2 btn btn-warning">Изменить</button></a>';
				echo '</div>';
			}
		?>
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
		<form action="/add.php?admin=true" method="post" class="form">
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