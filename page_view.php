<?php
	include_once "offset.php";

	function pageView() {
		global $database;
		global $message;

		$offset = getOffset();

		echo "<nav>\n";
		if (isset($_SESSION["login"])) {
			echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=add&offset=" . $offset . "\">Новая запись</a>&nbsp;\n";
			echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=file_manager&offset=" . $offset . "\">Менеджер файлов</a>&nbsp;\n";
			echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=backup&offset=" . $offset . "\">Бэкап</a>&nbsp;\n";
			echo "\t\t\t\t<a class = \"button\" href = \"index.php?action=logout\">Выйти</a>\n";
		} else {
			echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=login&offset=" . $offset . "\">Войти</a>\n";
		}
		echo "\t\t\t</nav>\n";

		if (isset($database) and $database != 0) {
			echo "\t\t\t<div id = \"articles\">\n";
			$query = sprintf("SELECT * FROM posts ORDER BY id DESC LIMIT 12 OFFSET %u", $offset);
			$query_result = mysql_query($query, $database);
			if ($query_result) {
				while ($row = mysql_fetch_array($query_result)) {
					echo "\t\t\t\t<article>\n";
					echo "\t\t\t\t\t<header>\n";
					echo "\t\t\t\t\t\t<h2>" . $row["title"] . "</h2>\n";
					echo "\t\t\t\t\t\t<time class = \"createDate\">\n";
					echo "\t\t\t\t\t\t\tОпубликовано: " . $row["create_time"] . ".\n";
					echo "\t\t\t\t\t\t</time><br />\n";
					echo "\t\t\t\t\t\t<time class = \"modifyDate\">\n";
					echo "\t\t\t\t\t\t\tИзменено: " . $row["modify_time"] . ".\n";
					echo "\t\t\t\t\t\t</time>\n";
					echo "\t\t\t\t\t</header>\n";
					echo "\t\t\t\t\t" . str_replace("\n", "\t\t\t\t\t<br />", $row["text"]) . "\n";
					if (isset($_SESSION["login"])) {
						echo "\t\t\t\t\t<footer>\n";
						echo "\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=edit&id=" . $row["id"] . "&offset=" . $offset . "\">редактировать</a>&nbsp;\n";
						echo "\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=delete&id=" . $row["id"] . "&offset=" . $offset . "\">удалить</a>\n";
						echo "\t\t\t\t\t</footer>\n";
					}
					echo "\t\t\t\t</article>\n";
				}
			}
			echo "\t\t\t</div>\n";

			echo "\t\t\t<table class = \"footer\">\n";
			echo "\t\t\t\t<tr>\n";
			echo "\t\t\t\t\t<td style = \"text-align: left;\">\n";
			if ($offset - 12 >= 0) {
				echo "\t\t\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . ($offset - 12) . "\">&lt;&lt; следующие</a>\n";
			} else {
				echo "\t\t\t\t\t\t&nbsp;\n";
			}
			echo "\t\t\t\t\t</td>\n";
			echo "\t\t\t\t\t<td style = \"text-align: right;\">\n";
			$query = sprintf("SELECT COUNT(*) AS number FROM posts", $offset);
			$query_result = mysql_query($query, $database);
			if ($query_result) {
				$row = mysql_fetch_array($query_result);
				if ($row and $offset + 12 <= $row["number"]) {
					echo "\t\t\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . ($offset + 12) . "\">предыдующие &gt;&gt;</a>\n";
				} else {
					echo "\t\t\t\t\t\t&nbsp;\n";
				}
			} else {
				echo "\t\t\t\t\t\t&nbsp;\n";
			}
			echo "\t\t\t\t\t</td>\n";
			echo "\t\t\t\t</tr>\n";
			echo "\t\t\t</table>\n";
		}
	}
?>
