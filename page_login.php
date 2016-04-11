<?php
	include_once "offset.php";

	function pageLogin() {
		global $database;
		global $message;

		$offset = getOffset();

		echo "<nav>\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
		echo "\t\t\t</nav>\n";

		echo "\t\t\t<form action = \"index.php?action=login&offset=" . $offset . "\" method = \"post\">\n";
		echo "\t\t\t\t<label for = \"password\">Пароль:</label><br />\n";
		echo "\t\t\t\t<input name = \"password\" type = \"password\" size = \"12\" required = \"required\" /><br />\n";
		echo "\t\t\t\t<input type = \"submit\" value = \"Вход\" />\n";
		echo "\t\t\t</form>\n";
	}
?>
