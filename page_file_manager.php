<?php
	include_once "offset.php";

	function pageFileManager() {
		global $database;
		global $message;

		$offset = getOffset();

		echo "<nav>\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
		echo "\t\t\t</nav>\n";

		echo "\t\t\t<div class = \"button\">\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=pictures&offset=" . $offset . "\">Картинки</a><br />\n";
		echo "\t\t\t</div>\n";
		echo "\t\t\t<div class = \"button\">\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=files&offset=" . $offset . "\">Файлы</a>\n";
		echo "\t\t\t</div>\n";
	}
?>
