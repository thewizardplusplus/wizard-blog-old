<?php
	function moduleMessage() {
		global $message;

		if (isset($message) and $message != "") {
			echo "<div id = \"message\">\n";
			echo "\t\t\t\t" . $message . "\n";
			echo "\t\t\t\t<hr />\n";
			echo "\t\t\t</div>\n\t\t\t";
		}
	}
?>
