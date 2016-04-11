<?php
	include_once "offset.php";

	function pageFiles() {
		global $database;
		global $message;

		$offset = getOffset();

		echo "<nav>\n";
		echo "\t\t\t\t<a class = \"button\" href = \"index.php?page=file_manager&offset=" . $offset . "\">&lt;&lt;&nbsp;Назад</a>\n";
		echo "\t\t\t</nav>\n";

		if (is_dir("files/")) {
			echo "\t\t\tФайлы:<br />\n";
			echo "\t\t\tfiles/\n";
			echo "\t\t\t<table class = \"list\">\n";
			$files = scandir("files/");
			array_shift($files);
			array_shift($files);
			foreach ($files as $file) {
				echo "\t\t\t\t<tr>\n";
				echo "\t\t\t\t\t<td>\n";
				echo "\t\t\t\t\t\t<a href = \"files/" . $file . "\">" . urlencode($file) . "</a>\n";
				echo "\t\t\t\t\t</td>\n";
				echo "\t\t\t\t\t<td>\n";
				echo "\t\t\t\t\t\t<div class = \"button\">\n";
				echo "\t\t\t\t\t\t\t<a class = \"button\" href = \"index.php?page=delete_file&path=files/" . urlencode($file) . "&offset=" . $offset . "\">удалить</a>\n";
				echo "\t\t\t\t\t\t</div>\n";
				echo "\t\t\t\t\t</td>\n";
				echo "\t\t\t\t</tr>\n";
			}
			echo "\t\t\t</table>\n";

			echo "\t\t\t<form action = \"index.php?page=files&action=upload_file&offset=" . $offset . "\" method = \"post\" enctype = \"multipart/form-data\">\n";
			echo "\t\t\t\t<label for = \"file\">Загрузить новый файл:</label><br />\n";
			echo "\t\t\t\t<input name = \"file\" type = \"file\" required = \"required\" /><br />\n";
			echo "\t\t\t\t<input type = \"submit\" value = \"Загрузить\" />\n";
			echo "\t\t\t</form>\n";
		}
	}
?>
