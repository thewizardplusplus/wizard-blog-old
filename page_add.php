<?php
	include_once "offset.php";

	function pageAdd() {
		global $database;

		$offset = getOffset();

		echo "\t\t\t\t<form action = \"index.php?action=add\" method = \"post\">\n";
		echo "\t\t\t\t\t<label for = \"title\">Заголовок:</label><br />\n";
		echo "\t\t\t\t\t<input name = \"title\" type = \"text\" size = \"36\" maxlength = \"96\" required = \"required\" /><br />\n";
		echo "\t\t\t\t\t<label for = \"text\">Пост:</label><br />\n";
		echo "\t\t\t\t\t<textarea name = \"text\" cols = \"55\" rows = \"12\" maxlength = \"10000\" required = \"required\" /></textarea><br />\n";
		echo "\t\t\t\t\t<input type = \"submit\" value = \"Опубликовать\" />\n";
		echo "\t\t\t\t</form>\n";
	}
?>
