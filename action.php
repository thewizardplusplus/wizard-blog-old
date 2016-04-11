<?php
	include_once "parameters.php";
	include "backup.php";

	function action() {
		global $database;
		global $message;

		if (isset($_GET["action"])) {
			$action = $_GET["action"];
			if (isset($_SESSION["login"]) and $_SESSION["login"] == true) {
				if ($action == "logout") {
					session_unset();
					session_destroy();
					$message = "До свидания, " . BLOG_USER_NAME . ".";
				} else if ($action == "add") {
					if (isset($_POST["title"]) and isset($_POST["text"])) {
						$time_and_date = date("H:i:s d.m.Y");
						$query = sprintf("INSERT INTO posts VALUES (0, \"%s\", \"%s\", \"%s\", \"%s\")", $_POST["title"], $_POST["text"], $time_and_date, $time_and_date);
						mysql_query($query, $database);
						$message = "Запись добавлена.";
					}
				} else if ($action == "edit") {
					if (isset($_POST["title"]) and isset($_POST["text"]) and isset($_GET["id"]) and is_numeric($_GET["id"])) {
						$time_and_date = date("H:i:s d.m.Y");
						$query = sprintf("UPDATE posts SET title = \"%s\", text = \"%s\", modify_time = \"%s\" WHERE id = %u", $_POST["title"], $_POST["text"], $time_and_date, $_GET["id"]);
						mysql_query($query, $database);
						$message = "Запись обновлена.";
					}
				} else if ($action == "delete") {
					if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
						$query = sprintf("DELETE FROM posts WHERE id = %u", $_GET["id"]);
						mysql_query($query, $database);
						$message = "Запись удалена.";
					}
				} else if ($action == "delete_file") {
					if (isset($_GET["path"])) {
						$result = unlink(urldecode($_GET["path"]));
						if ($result) {
							if (strpos($_GET["path"], "images/") === 0) {
								$message = "Картинка успешно удалёна.";
							} else {
								$message = "Файл успешно удалён.";
							}
						}
					}
				} else if ($action == "upload_picture") {
					if (is_uploaded_file($_FILES["picture"]["tmp_name"])) {
						move_uploaded_file($_FILES["picture"]["tmp_name"], "images/" . $_FILES["picture"]["name"]);
						$message = "Картинка успешно загружена.";
					}
				} else if ($action == "upload_file") {
					if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
						move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $_FILES["file"]["name"]);
						$message = "Файл успешно загружен.";
					}
				} else if ($action == "backup") {
					backup();
				}
			} else if ($action == "login") {
				if (isset($_POST["password"]) and md5($_POST["password"]) == BLOG_PASSWORD_MD5_HASH) {
					$_SESSION["login"] = true;
					$message = "Здравствуй, " . BLOG_USER_NAME . ".";
				} else {
					session_unset();
					session_destroy();
					$message = "Ошибочный пароль.";
				}
			}
		}
	}
?>
