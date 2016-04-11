<?php
	include_once "offset.php";

	function pageFiles() {
		global $database;

		$offset = getOffset();

		if (is_dir("files/")) {
			echo "\t\t\t\tФайлы:<br />\n";

			echo "\t\t\t\t<form action = \"index.php?page=files&action=upload_file&offset=" . $offset . "\" method = \"post\" enctype = \"multipart/form-data\">\n";
			echo "\t\t\t\t\t<label for = \"file\">Загрузить новый файл:</label><br />\n";
			echo "\t\t\t\t\t<input name = \"file\" type = \"file\" required = \"required\" /><br />\n";
			echo "\t\t\t\t\t<input type = \"submit\" value = \"Загрузить\" />\n";
			echo "\t\t\t\t</form>\n";

			echo "\t\t\t\tfiles/\n";
			echo "\t\t\t\t<table class = \"list\">\n";
			$files = scandir("files/");
			foreach ($files as $file) {
				if ($file == "." or $file == "..") {
					continue;
				}

				echo "\t\t\t\t\t<tr>\n";
				echo "\t\t\t\t\t\t<td>\n";
				echo "\t\t\t\t\t\t\t<a href = \"files/" . urlencode($file) . "\">" . $file . "</a>\n";
				echo "\t\t\t\t\t\t</td>\n";
				echo "\t\t\t\t\t\t<td>\n";
				echo "\t\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=delete_file&path=files/" . urlencode($file) . "&offset=" . $offset . "\">удалить</a>\n";
				echo "\t\t\t\t\t\t</td>\n";
				echo "\t\t\t\t\t</tr>\n";
			}
			echo "\t\t\t\t</table>\n";
		}
	}
?>
