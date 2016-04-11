<?php
	define("NUMBER_OF_BACKUPS", 2);

	function archiveDirectory($path, $archive, $archive_name) {
		$files = scandir($path);
		foreach ($files as $file) {
			if ($file == "." or $file == "..") {
				continue;
			}

			$file_path = $file;
			if ($path != ".") {
				$file_path = $path . $file_path;
			}
			if (is_file($file_path)) {
				$archive->addFile($file_path, $archive_name . "/" . $file_path);
			} else if ($file_path != "backup") {
				$file_path .= "/";
				archiveDirectory($file_path, $archive, $archive_name);
			}
		}
	}

	function backup() {
		global $database;
		global $message;

		$archive = new ZipArchive();
		$archive_name = "backup-" . date("Ymd-His");
		$archive_file_name = "backup/" . $archive_name . ".zip";
		$result = $archive->open($archive_file_name, ZIPARCHIVE::CREATE);
		if ($result) {
			$database_dump = "SET NAMES 'utf8';\n" .
				"SET collation_connection = 'utf8_general_ci';\n" .
				"SET collation_server = 'utf8_general_ci';\n" .
				"SET character_set_client = 'utf8';\n" .
				"SET character_set_connection = 'utf8';\n" .
				"SET character_set_results = 'utf8';\n" .
				"SET character_set_server = 'utf8';\n" .
				"\n" .
				"DROP TABLE IF EXISTS `posts`;\n" .
				"CREATE TABLE `posts` (\n" .
				"\t`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,\n" .
				"\t`title` VARCHAR(96) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,\n" .
				"\t`text` VARCHAR(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,\n" .
				"\t`create_time` VARCHAR(19) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,\n" .
				"\t`modify_time` VARCHAR(19) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL\n" .
				") ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;\n" .
				"\n";
			$query_result = mysql_query("SELECT * FROM posts", $database);
			if ($query_result) {
				while ($row = mysql_fetch_array($query_result)) {
					$title = addslashes($row["title"]);
					$title = str_replace("\n", "", $title);
					$title = str_replace("\r", "", $title);
					$text = addslashes($row["text"]);
					$text = str_replace("\n", "", $text);
					$text = str_replace("\r", "", $text);
					$database_dump = $database_dump . sprintf("INSERT INTO `posts` (`id`, `title`, `text`, `create_time`, `modify_time`) VALUES (NULL, \"%s\", \"%s\", \"%s\", \"%s\");\n", $title, $text, $row["create_time"], $row["modify_time"]);
				}

				$file = fopen("backup/database_dump.sql", "w");
				if ($file) {
					fwrite($file, $database_dump);
				}
				fclose($file);
			}
			$archive->addFile("backup/database_dump.sql", $archive_name . "/database_dump.sql");

			archiveDirectory(".", $archive, $archive_name);

			$archive->close();

			unlink("backup/database_dump.sql");

			$backups = scandir("backup/");
			array_shift($backups);
			array_shift($backups);
			$backups = array_reverse($backups);
			for ($i = 0; $i < NUMBER_OF_BACKUPS; $i++) {
				array_shift($backups);
			}
			$deleted = False;
			foreach ($backups as $backup) {
				$result = unlink("backup/" . $backup);
				if ($result) {
					$deleted = True;
				}
			}

			$message = "Бэкап успешно создан: <a href = \"" . $archive_file_name . "\">" . $archive_name . ".zip</a>.";
			if ($deleted) {
				$message = $message . "<br />\n\t\t\t\t\tУстаревшие бэкапы успешно удалены.";
			}
		}
	}
?>
