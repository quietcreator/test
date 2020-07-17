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


	
	/*'<a href="?page='.$i.'" class="mr-2">'.$i.'</a>';
	'<span class="mr-2 text-dark">'.$i.'</span>';*/
	

 
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
		echo '<div class="text-info">Выполнено</div>';
		if ($row->performed) {
			echo '<div class="text-info">отредактировано администратором</div>';
		}
		echo '</div>';
	}
?>