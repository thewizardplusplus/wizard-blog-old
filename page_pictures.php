<?php
	include_once "offset.php";

	function pagePictures() {
		global $database;
		global $message;

		$offset = getOffset();

		echo "<nav>\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=file_manager&offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
		echo "\t\t\t</nav>\n";

		if (is_dir("images/")) {
			echo "\t\t\tКартинки:<br />\n";
			echo "\t\t\timages/\n";
			echo "\t\t\t<table class = \"list\">\n";
			$pictures = scandir("images/");
			array_shift($pictures);
			array_shift($pictures);
			foreach ($pictures as $picture) {
				echo "\t\t\t\t<tr>\n";
				echo "\t\t\t\t\t<td>\n";
				echo "\t\t\t\t\t\t<a href = \"images/" . $picture . "\">" . urlencode($picture) . "</a>\n";
				echo "\t\t\t\t\t</td>\n";
				echo "\t\t\t\t\t<td>\n";
				echo "\t\t\t\t\t\t<div class = \"button\">\n";
				echo "\t\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=delete_picture&path=images/" . urlencode($picture) . "&offset=" . $offset . "\">удалить</a>\n";
				echo "\t\t\t\t\t\t</div>\n";
				echo "\t\t\t\t\t</td>\n";
				echo "\t\t\t\t</tr>\n";
			}
			echo "\t\t\t</table>\n";

			echo "\t\t\t<form action = \"index.php?page=pictures&action=upload_picture&offset=" . $offset . "\" method = \"post\" enctype = \"multipart/form-data\">\n";
			echo "\t\t\t\t<label for = \"picture\">Загрузить новую картинку:</label><br />\n";
			echo "\t\t\t\t<input name = \"picture\" type = \"file\" required = \"required\" /><br />\n";
			echo "\t\t\t\t<input type = \"submit\" value = \"Загрузить\" />\n";
			echo "\t\t\t</form>\n";
		}
	}
?>
