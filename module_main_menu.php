<?php
	include_once "offset.php";

	function moduleMainMenu() {
		$offset = getOffset();

		echo "<nav id = \"main_menu\">\n";
		echo "\t\t\t\t<ul>\n";
		echo "\t\t\t\t\t<li><a href = \"index.php\">Главная</a></li>\n";
		if (isset($_SESSION["login"])) {
			echo "\t\t\t\t\t<li><a href = \"index.php?page=add&offset=" . $offset . "\">Новая&nbsp;запись</a></li>\n";
			echo "\t\t\t\t\t<li><a href = \"index.php?page=file_manager&offset=" . $offset . "\">Менеджер&nbsp;файлов</a></li>\n";
			echo "\t\t\t\t\t<li><a href = \"index.php?page=backup&offset=" . $offset . "\">Бэкап</a></li>\n";
			echo "\t\t\t\t\t<li><a href = \"index.php?action=logout\">Выйти</a></li>\n";
		}
		echo "\t\t\t\t</ul>\n";
		echo "\t\t\t</nav>\n";
	}
?>
