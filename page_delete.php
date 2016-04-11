<?php
	include_once "offset.php";

	function pageDelete() {
		global $database;

		$offset = getOffset();
		$from = "view";
		if (isset($_GET["from"]) and $_GET["from"] == "post") {
			$from = "post";
		}

		if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
			echo "<nav>\n";
			if ($from == "view") {
				echo "\t\t\t\t\t<a class = \"button\" href = \"index.php?offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
			} else {
				echo "\t\t\t\t\t<a class = \"button\" href = \"index.php?page=post&id=" . $_GET["id"] . "&offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
			}
			echo "\t\t\t\t</nav>\n";

			$title = "";
			$query = sprintf("SELECT * FROM posts WHERE id = %u", $_GET["id"]);
			$query_result = mysql_query($query, $database);
			if ($query_result) {
				$row = mysql_fetch_array($query_result);
				if ($row) {
					$title = $row["title"];
				}
			}

			if ($title != "") {
				echo "\t\t\t\tТы точно хочешь удалить запись \"" . $title . "\"?<br />\n";
			} else {
				echo "\t\t\t\tТы точно хочешь удалить эту запись?<br />\n";
			}
			echo "\t\t\t\t<a class = \"button\" href = \"index.php?action=delete&id=" . $_GET["id"] . "&offset=" . $offset . "\">Да</a>\n";
		}
	}
?>
