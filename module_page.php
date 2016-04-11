<?php
	include "page_add.php";
	include "page_edit.php";
	include "page_delete.php";
	include "page_file_manager.php";
	include "page_pictures.php";
	include "page_files.php";
	include "page_delete_picture.php";
	include "page_delete_file.php";
	include "page_backup.php";
	include "page_view.php";
	include "page_login.php";

	function modulePage() {
		$page = "";
		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		}

		if (isset($_SESSION["login"]) and $_SESSION["login"] == true) {
			if ($page == "add") {
				pageAdd();
			} else if ($page == "edit") {
				pageEdit();
			} else if ($page == "delete") {
				pageDelete();
			} else if ($page == "file_manager") {
				pageFileManager();
			} else if ($page == "pictures") {
				pagePictures();
			} else if ($page == "files") {
				pageFiles();
			} else if ($page == "delete_picture") {
				pageDeletePicture();
			} else if ($page == "delete_file") {
				pageDeleteFile();
			} else if ($page == "backup") {
				pageBackup();
			} else {
				pageView();
			}
		} else {
			if ($page == "login") {
				pageLogin();
			} else {
				pageView();
			}
		}
	}
?>
