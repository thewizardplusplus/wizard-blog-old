<?php
	include_once "offset.php";

	function pageFileManager() {
		global $database;

		$offset = getOffset();

		echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=pictures&offset=" . $offset . "\">Картинки</a><br />\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=files&offset=" . $offset . "\">Файлы</a>\n";
	}
?>
