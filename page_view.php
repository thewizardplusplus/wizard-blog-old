<?php
	include_once "offset.php";

	define("OFFSET_STEP", 5);

	function pageView() {
		global $database;

		$offset = getOffset();

		if (isset($database) and $database != 0) {
			$query = sprintf("SELECT * FROM posts ORDER BY id DESC LIMIT " . OFFSET_STEP . " OFFSET %u", $offset);
			$query_result = mysql_query($query, $database);
			if ($query_result) {
				while ($row = mysql_fetch_array($query_result)) {
					echo "<article>\n";
					echo "\t\t\t\t\t<header>\n";
					echo "\t\t\t\t\t\t<h2><a href = \"index.php?page=post&id=" . $row["id"] . "&offset=" . $offset . "\">" . $row["title"] . "</a></h2>\n";
					echo "\t\t\t\t\t\t<div class = \"time\">\n";
					echo "\t\t\t\t\t\t\tОпубликовано: <time>" . $row["create_time"] . "</time>.<br />\n";
					echo "\t\t\t\t\t\t\tИзменено: <time>" . $row["modify_time"] . "</time>.\n";
					echo "\t\t\t\t\t\t</div>\n";
					echo "\t\t\t\t\t</header>\n";
					$text = $row["text"];
					$text = str_replace("\n", "", $text);
					$text = str_replace("\r", "", $text);
					$index = stripos($text, "<hr class = \"cut\" />");
					if (!($index === FALSE)) {
						$text = substr($text, 0, $index);
						$text .= "\n\t\t\t\t\t<p class = \"read_more\">\n\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=post&id=" . $row["id"] . "&offset=" . $offset . "\">Читать&nbsp;далее&nbsp;&gt;&gt;</a>\n\t\t\t\t\t</p>";
					}
					echo "\t\t\t\t\t" . $text . "\n";
					if (isset($_SESSION["login"])) {
						echo "\t\t\t\t\t<footer>\n";
						echo "\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=edit&id=" . $row["id"] . "&offset=" . $offset . "&from=view\">редактировать</a>\n";
						echo "\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=delete&id=" . $row["id"] . "&offset=" . $offset . "&from=view\">удалить</a>\n";
						echo "\t\t\t\t\t</footer>\n";
					}
					echo "\t\t\t\t</article>\n\t\t\t\t";
				}
			}

			echo "\t\t\t\t<div class = \"pagination\">\n";
			if ($offset - OFFSET_STEP >= 0) {
				echo "\t\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . ($offset - OFFSET_STEP) . "\">&lt;&lt;&nbsp;следующие</a>\n";
			}
			$query = sprintf("SELECT COUNT(*) AS number FROM posts", $offset);
			$query_result = mysql_query($query, $database);
			if ($query_result) {
				$row = mysql_fetch_array($query_result);
				if ($row and $offset + OFFSET_STEP <= $row["number"]) {
					echo "\t\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . ($offset + OFFSET_STEP) . "\">предыдующие&nbsp;&gt;&gt;</a>\n";
				}
			}
			echo "\t\t\t\t</div>\n";
		}
	}
?>
