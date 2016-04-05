<?php
	include_once "offset.php";

	function pageDelete() {
		global $database;
		global $message;

		$offset = getOffset();

		if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
			echo "<nav>\n";
			echo "\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
			echo "\t\t\t</nav>\n";

			echo "\t\t\tТы точно хочешь удалить эту запись?<br />\n";
			echo "\t\t\t<div class = \"button\">\n";
			echo "\t\t\t\t<a class = \"button\" href = \"index.php?action=delete&id=" . $_GET["id"] . "&offset=" . $offset . "\">Да</a>\n";
			echo "\t\t\t</div>\n";
		}
	}
?>
