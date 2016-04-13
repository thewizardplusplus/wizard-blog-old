<?php
	function pageLogin() {
		global $database;

		echo "<form action = \"index.php?action=login\" method = \"post\">\n";
		echo "\t\t\t\t\t<label for = \"password\">Пароль:</label><br />\n";
		echo "\t\t\t\t\t<input name = \"password\" type = \"password\" size = \"12\" required = \"required\" /><br />\n";
		echo "\t\t\t\t\t<input type = \"submit\" value = \"Вход\" />\n";
		echo "\t\t\t\t</form>\n";
	}
?>
