<?php
	function backup() {
		global $database;
		global $message;

		$zip = new ZipArchive();
		$archive_name = "backup/backup__" . date("H_i_s__d_m_Y") . ".zip";
		$result = $zip->open($archive_name, ZIPARCHIVE::CREATE);
		if ($result) {
			$database_dump = "";
			$query_result = mysql_query("SELECT * FROM posts", $database);
			if ($query_result) {
				while ($row = mysql_fetch_array($query_result)) {
					$database_dump = $database_dump . sprintf("INSERT INTO posts VALUES (0, \"%s\", \"%s\", \"%s\", \"%s\");\n", $row["title"], $row["text"], $row["create_time"], $row["modify_time"]);
				}

				$file = fopen("backup/database_dump.sql", "w");
				if ($file) {
					fwrite($file, $database_dump);
				}
				fclose($file);
			}

			$files = scandir(".");
			array_shift($files);
			array_shift($files);
			foreach ($files as $file) {
				if (!is_dir($file)) {
					$zip->addFile($file, $file);
				} else if ($file == "images" or $file == "files") {
					$subfiles = scandir($file . "/");
					array_shift($subfiles);
					array_shift($subfiles);
					foreach ($subfiles as $subfile) {
						if (!is_dir($subfile)) {
							$zip->addFile($file . "/" . $subfile, $file . "/" . $subfile);
						}
					}
				}
			}
			$zip->addFile("backup/database_dump.sql", "database_dump/database_dump.sql");
			$zip->close();

			unlink("backup/database_dump.sql");

			$backups = scandir("backup/");
			array_shift($backups);
			array_shift($backups);
			$backups = array_reverse($backups);
			for ($i = 0; $i < 6; $i++) {
				array_shift($backups);
			}
			$deleted = False;
			foreach ($backups as $backup) {
				$result = unlink("backup/" . $backup);
				if ($result) {
					$deleted = True;
				}
			}

			$message = "Бэкап успешно создан:<br />\n\t\t\t\t<a href = \"" . $archive_name . "\">" . $archive_name . "</a>.";
			if ($deleted) {
				$message = $message . "<br />\n\t\t\t\tУстаревшие бэкапы успешно удалены.";
			}
		}
	}
?>
