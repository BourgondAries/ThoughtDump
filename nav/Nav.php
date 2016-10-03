<?php
	function getNext($page, $jump=1) {
		return $page + $jump;
	}
	function getPrev($page, $jump=1) {
		$prev = $page - $jump;
		return $prev;
	}
	function createButton($page, $topic, $disabled, $text) {
		if ($disabled == true)
			$disabled = " disabled";
		else
			$disabled = "";
		return "<button name=\"page\" type=\"submit\" value=\"$page;$topic\"$disabled>$text</button>";
	}
	function getFileCountInDirectory($dir) {
		$result = array();
		exec("ls pages/ | wc -l", $result);
		return $result[0];
	}
	function createDropDownMenu($page, $to) {
		return rtrim(file_get_contents('autogen/navigation'));
	}
	function doesPageExist($page, $topic) {
		return file_exists("pages/$topic/$page");
	}
	function getPage($page, $topic) {
		return file_get_contents("pages/$topic/$page");
	}
	function getVerticalSpace() {
		return '<div class="vertical space"></div>';
	}
	function generateNavibar($page, $topic) {
		$prev = getPrev($page);
		$next = getNext($page);
		$prev5 = getPrev($page, 5);
		$next5 = getNext($page, 5);

		$page = intval($page);
		$html = '';
		$html .=  '<form>';
		$html .=  createButton($prev5, $topic, !doesPageExist("$prev5", $topic), '&lt;&lt;');
		$html .=  createButton($prev, $topic, !doesPageExist("$prev", $topic), '&lt;');
		$html .=  "</form>";
		$html .=  createDropDownMenu($page, getFileCountInDirectory('pages/'));
		$html .=  '<form>';
		$html .=  createButton($next, $topic, !doesPageExist("$next", $topic), '&gt;');
		$html .=  createButton($next5, $topic, !doesPageExist("$next5", $topic), '&gt;&gt;');
		$html .=  "</form>";
		return $html;
	}

?>
