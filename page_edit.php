<?php
	include_once "offset.php";

	function pageEdit() {
		global $database;

		$offset = getOffset();
		$from = "view";
		if (isset($_GET["from"]) and $_GET["from"] == "post") {
			$from = "post";
		}

		if (isset($_GET["id"]) and is_numeric($_GET["id"]) and isset($database) and $database != 0) {
			$query = sprintf("SELECT * FROM posts WHERE id = %u", $_GET["id"]);
			$query_result = mysql_query($query, $database);
			if ($query_result) {
				$row = mysql_fetch_array($query_result);
				if ($row) {
					echo "<nav>\n";
					if ($from == "view") {
						echo "\t\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
					} else {
						echo "\t\t\t\t\t<a class = \"button\" href = \"index.php?page=post&id=" . $_GET["id"] . "&offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
					}
					echo "\t\t\t\t</nav>\n";

					echo "\t\t\t\t<form action = \"index.php?action=edit&id=" . $_GET["id"] . "&offset=" . $offset . "\" method = \"post\">\n";
					echo "\t\t\t\t\t<label for = \"title\">Заголовок:</label><br />\n";
					echo "\t\t\t\t\t<input name = \"title\" type = \"text\" size = \"36\" maxlength = \"96\" value = \"" . $row["title"] . "\" required = \"required\" /><br />\n";
					echo "\t\t\t\t\t<label for = \"text\">Пост:</label><br />\n";
					echo "\t\t\t\t\t<textarea name = \"text\" cols = \"55\" rows = \"12\" maxlength = \"10000\" required = \"required\" />" . $row["text"] . "</textarea><br />\n";
					echo "\t\t\t\t\t<input type = \"submit\" value = \"Сохранить\" />\n";
					echo "\t\t\t\t</form>\n";
				}
			}
		}
	}
?>
