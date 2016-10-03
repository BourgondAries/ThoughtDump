<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,maximum-scale=1, minimum-scale=1" />
		<link rel="icon" type="image/png" href="img/musings_symbol_16.png">
		<link rel="icon" type="image/png" href="img/musings_symbol_32.png">
		<link rel="icon" type="image/png" href="img/musings_symbol_64.png">
		<link rel="stylesheet" type="text/css" href="reset.css">
		<link rel="stylesheet" href="highlight/default.css">
		<script src="highlight/highlight.pack.js"></script>
		<script>hljs.initHighlightingOnLoad();</script>
		<style>
			.col-md-5 { width: 20%; }
			@media(max-width: 1200px) {
			.content { margin-left: 15vw; width: 70vw; word-wrap: break-word; } }
			@media(min-width: 1200px) {
			.content { margin-left: 33vw; width: 33vw; word-wrap: break-word; } }
			.prefoot { min-height: 96vh; }
			.vertical.space { height: 1vh; }
			body { background-color: black; color: #4C4C4C; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 24px; width: 100vw; }

			strong { font-weight: bold; }
			h1 { font-size: 200%; font-style: bold; }
			form { display: inline; height: 3vh; width: auto; }
			i { font-style: italic; }
			button { background: #232b30; border: 1px solid #1c252b; color: #9fa8b0; font-weight: bold; height: 3vh; margin: 0; padding: 0; outline: 0; width: 20%; }
			button:hover { color: #fff; background: #4C5A64; }
			select { border: 1px solid #1c252b; display: inline; font-weight: bold; height: 3vh; margin-right: 0; width: 20%; }
			img { width: 100%; }
			p { line-height: 180%; }
			pre { background-color: rgba(235, 236, 228, 0.2); color: #BBBBBB; font-family: monospace; font-size: 0.8em; line-height: 1.2em; margin: 1vh 0 1vh 0; padding: 0; white-space: pre-wrap; word-wrap: break-word; }
		</style>
		<title>Evo's Musings</title>
	</head>
	<body>
		<div class="prefoot">
		<?php
			include_once 'nav/Nav.php';

			$page = $_GET['page'];
			if (!isset($page))
				$page = "0;0";

			$pages = explode(";", $page);
			$page = $pages[0];
			$topic = $pages[1];

			$page = intval($page);
			$topic = intval($topic);
			echo generateNavibar($page, $topic);
		?>
			<div class="content">
			<?php
				if (doesPageExist($page, $topic)) {
					echo getVerticalSpace();
					echo getPage($page, $topic);
				}
				else {
					echo '<pre> This page does not exist! </pre>';
				}
			?>
			</div>
		</div>
		<?php
			echo getVerticalSpace();
			echo generateNavibar($page, $topic);
		?>
	</body>
	<script>
		function setSelects(value) {
			selects = document.getElementsByTagName("select");
			for (i = 0; i < selects.length; ++i) {
				selects[i].selectedIndex = value;
			}
		}
		setSelects(document.getElementById('navivalue').innerHTML);
		function getPage(response, selected) {
			document.open();
			document.write(response);
			document.close();

			setSelects(selected);
		}
		function httpGetAsyncPage(theUrl, selectedIndex, callback) {
			selected = theUrl;
			theUrl = "?page=".concat(theUrl);
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
					callback(xmlHttp.responseText, selectedIndex);
				}
			xmlHttp.open("GET", theUrl, true); // true for asynchronous
			xmlHttp.send(null);
		}

		// Add line numbers to pre (Doesn't work with word-wrap)
		(function() {
			return;
			var pre = document.getElementsByTagName('pre'),
			pl = pre.length;
			for (var i = 0; i < pl; i++) {
				pre[i].innerHTML = '<span class="line-number"></span>' + pre[i].innerHTML + '<span class="cl"></span>';
				var num = pre[i].innerHTML.split(/\n/).length;
				if (num > 0)
					--num;
				for (var j = 0; j < num; j++) {
					var line_num = pre[i].getElementsByTagName('span')[0];
					line_num.innerHTML += '<span>' + (j + 1) + '</span>';
				}
			}
		})();
	</script>
</html>
