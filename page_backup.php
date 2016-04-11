<?php
	include_once "offset.php";

	function pageBackup() {
		global $database;
		global $message;

		$offset = getOffset();

		echo "<nav>\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
		echo "\t\t\t</nav>\n";

		echo "\t\t\tСоздание бэкапа может занять продолжительное время.<br />Ты уверен, что хочешь продолжить?<br />\n";
		echo "\t\t\t<div class = \"button\">\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?action=backup&offset=" . $offset . "\">Да</a>\n";
		echo "\t\t\t</div>\n";
	}
?>
