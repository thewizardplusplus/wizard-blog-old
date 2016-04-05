<?php
	include_once "offset.php";

	function pageAdd() {
		global $database;
		global $message;

		$offset = getOffset();

		echo "<nav>\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
		echo "\t\t\t</nav>\n";

		echo "\t\t\t<form action = \"index.php?action=add\" method = \"post\">\n";
		echo "\t\t\t\t<label for = \"title\">Заголовок:</label><br />\n";
		echo "\t\t\t\t<input name = \"title\" type = \"text\" size = \"36\" required = \"required\" /><br />\n";
		echo "\t\t\t\t<label for = \"text\">Пост:</label><br />\n";
		echo "\t\t\t\t<textarea name = \"text\" cols = \"72\" rows = \"12\" maxlength = \"10000\" required = \"required\" /></textarea><br />\n";
		echo "\t\t\t\t<input type = \"submit\" value = \"Опубликовать\" />\n";
		echo "\t\t\t</form>\n";
	}
?>
