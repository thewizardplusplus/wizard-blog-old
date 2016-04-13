<?php
	// this is required due to a use of the deprecated extension mysql
	ini_set('display_errors', '0');

	include_once "parameters.php";
	include "module_main_menu.php";
	include "module_message.php";
	include "module_page.php";
	include "action.php";

	$message = "";
	session_start();
	$database = mysql_connect(MYSQL_SERVER, MYSQL_LOGIN, MYSQL_PASSWORD);
	if ($database != 0) {
		mysql_select_db(MYSQL_DATABASE_NAME, $database);
		mysql_query("SET NAMES 'utf8';", $database);

		action();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv = "content-type" content = "text/html; charset = utf-8" />
		<!--[if IE]><script src = "http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<link rel = "stylesheet" type = "text/css" href = "style.css" />
		<link rel = "stylesheet" type = "text/css" href = "article_style.css" />
		<title>Хроники завоевания мира...</title>
	</head>
	<body>
		<section id = "main_section">
			<header>
				<h1>Хроники завоевания мира...</h1>
			</header>
			<?php
				moduleMainMenu();
			?>
			<div id = "page">
				<?php
					moduleMessage();
					modulePage();
				?>
			</div>
			<footer>
				Copyright &copy; 2011-<?= date('Y') ?> thewizardplusplus
			</footer>
		</section>
	</body>
</html>

<?php
	if ($database != 0) {
		mysql_close($database);
	}
?>
