<?php
	include_once "offset.php";

	function pageBackup() {
		global $database;

		$offset = getOffset();

		echo "\t\t\t\tСоздание бэкапа может занять продолжительное время.<br />\n";
		echo "\t\t\t\tТы уверен, что хочешь продолжить?<br />\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?action=backup&offset=" . $offset . "\">Да</a>\n";
	}
?>
