<?php
	include_once "offset.php";

	function pagePost() {
		global $database;

		$offset = getOffset();

		echo "<nav>\n";
		echo "\t\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
		echo "\t\t\t\t</nav>\n";

		if (isset($_GET["id"]) and is_numeric($_GET["id"]) and isset($database) and $database != 0) {
			echo "\t\t\t\t<article>\n";
			$query = sprintf("SELECT * FROM posts WHERE id = %u", $_GET["id"]);
			$query_result = mysql_query($query, $database);
			if ($query_result) {
				$row = mysql_fetch_array($query_result);
				if ($row) {
					echo "\t\t\t\t\t<header>\n";
					echo "\t\t\t\t\t\t<h2>" . $row["title"] . "</h2>\n";
					echo "\t\t\t\t\t\t<div class = \"time\">\n";
					echo "\t\t\t\t\t\t\tОпубликовано: <time>" . $row["create_time"] . "</time>.<br />\n";
					echo "\t\t\t\t\t\t\tИзменено: <time>" . $row["modify_time"] . "</time>.\n";
					echo "\t\t\t\t\t\t</div>\n";
					echo "\t\t\t\t\t</header>\n";
					$text = $row["text"];
					$text = str_replace("\n", "", $text);
					$text = str_replace("\r", "", $text);
					echo "\t\t\t\t\t" . $text . "\n";
					if (isset($_SESSION["login"])) {
						echo "\t\t\t\t\t<footer>\n";
						echo "\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=edit&id=" . $row["id"] . "&offset=" . $offset . "&from=post\">редактировать</a>\n";
						echo "\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=delete&id=" . $row["id"] . "&offset=" . $offset . "&from=post\">удалить</a>\n";
						echo "\t\t\t\t\t</footer>\n";
					}
				}
			}
			echo "\t\t\t\t</article>\n";
		}
	}
?>
