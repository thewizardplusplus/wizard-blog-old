<?php
	// this is required due to a use of the deprecated extension mysql
	ini_set('display_errors', '0');

	include_once "parameters.php";
	include "module_message.php";
	include "module_page.php";
	include "action.php";

	$message = "";
	session_start();
	$database = mysql_connect($mysql_server, $mysql_login, $mysql_password);
	if ($database != 0) {
		mysql_select_db($mysql_database_name, $database);
		mysql_query("SET NAMES utf8", $database);

		action();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Хроники завоевания мира...</title>
		<meta http-equiv = "content-type" content = "text/html; charset = utf-8" />
		<link rel = "stylesheet" type = "text/css" href = "style.css" />
		<!--[if IE]><script src = "http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<header>
			<h1>Хроники завоевания мира...</h1>
		</header>
		<hr />
		<div id = "page">
			<?php
				moduleMessage();
				modulePage();
			?>
		</div>
		<hr />
		<footer>
			&copy; волшебник Мерлин, 2011 год; e-mail для связи: <a href = "mailto://thewizardmerlin@yandex.ru">thewizardmerlin@yandex.ru</a>.
		</footer>
	</body>
</html>

<?php
	if ($database != 0) {
		mysql_close($database);
	}
?>
