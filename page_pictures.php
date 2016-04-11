<?php
	include_once "offset.php";

	function pagePictures() {
		global $database;

		$offset = getOffset();

		if (is_dir("images/")) {
			echo "\t\t\t\tКартинки:<br />\n";

			echo "\t\t\t\t<form action = \"index.php?page=pictures&action=upload_picture&offset=" . $offset . "\" method = \"post\" enctype = \"multipart/form-data\">\n";
			echo "\t\t\t\t\t<label for = \"picture\">Загрузить новую картинку:</label><br />\n";
			echo "\t\t\t\t\t<input name = \"picture\" type = \"file\" required = \"required\" /><br />\n";
			echo "\t\t\t\t\t<input type = \"submit\" value = \"Загрузить\" />\n";
			echo "\t\t\t\t</form>\n";

			echo "\t\t\t\timages/\n";
			echo "\t\t\t\t<table class = \"list\">\n";
			$pictures = scandir("images/");
			foreach ($pictures as $picture) {
				if ($picture == "." or $picture == "..") {
					continue;
				}

				echo "\t\t\t\t\t<tr>\n";
				echo "\t\t\t\t\t\t<td>\n";
				echo "\t\t\t\t\t\t\t<a href = \"images/" . urlencode($picture) . "\">" . $picture . "</a>\n";
				echo "\t\t\t\t\t\t</td>\n";
				echo "\t\t\t\t\t\t<td>\n";
				echo "\t\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=delete_picture&path=images/" . urlencode($picture) . "&offset=" . $offset . "\">удалить</a>\n";
				echo "\t\t\t\t\t\t</td>\n";
				echo "\t\t\t\t\t</tr>\n";
			}
			echo "\t\t\t\t</table>\n";
		}
	}
?>
