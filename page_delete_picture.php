<?php
	include_once "offset.php";

	function pageDeletePicture() {
		global $database;
		global $message;

		$offset = getOffset();

		if (isset($_GET["path"])) {
			echo "<nav>\n";
			echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=pictures&offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
			echo "\t\t\t</nav>\n";

			echo "\t\t\tТы точно хочешь удалить картинку " . urldecode($_GET["path"]) . "?<br />\n";
			echo "\t\t\t<div class = \"button\">\n";
			echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=pictures&action=delete_file&path=" . $_GET["path"] . "&offset=" . $offset . "\">Да</a>\n";
			echo "\t\t\t</div>\n";
		}
	}
?>
