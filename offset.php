<?php
	function getOffset() {
		if (isset($_GET["offset"]) and is_numeric($_GET["offset"])) {
			return $_GET["offset"];
		} else {
			return 0;
		}
	}
?>
