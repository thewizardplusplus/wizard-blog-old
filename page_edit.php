<?php
	include_once "offset.php";

	function pageEdit() {
		global $database;
		global $message;

		$offset = getOffset();

		if (isset($_GET["id"]) and is_numeric($_GET["id"]) and isset($database) and $database != 0) {
			$query = sprintf("SELECT * FROM posts WHERE id = %u", $_GET["id"]);
			$query_result = mysql_query($query, $database);
			if ($query_result) {
				$row = mysql_fetch_array($query_result);
				if ($row) {
					echo "<nav>\n";
					echo "\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
					echo "\t\t\t</nav>\n";

					echo "\t\t\t<form action = \"index.php?action=edit&id=" . $_GET["id"] . "&offset=" . $offset . "\" method = \"post\">\n";
					echo "\t\t\t\t<label for = \"title\">Заголовок:</label><br />\n";
					echo "\t\t\t\t<input name = \"title\" type = \"text\" size = \"36\" value = \"" . $row["title"] . "\" required = \"required\" /><br />\n";
					echo "\t\t\t\t<label for = \"text\">Пост:</label><br />\n";
					echo "\t\t\t\t<textarea name = \"text\" cols = \"72\" rows = \"12\" maxlength = \"10000\" required = \"required\" />" . $row["text"] . "</textarea><br />\n";
					echo "\t\t\t\t<input type = \"submit\" value = \"Сохранить\" />\n";
					echo "\t\t\t</form>\n";
				}
			}
		}
	}
?>
