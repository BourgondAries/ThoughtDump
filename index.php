<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="reset.css">
		<style>
			.col-md-5 { width: 20%; }
			.content { margin: 1vh 1vw; }
			.prefoot { min-height: 95vh; }
			.vertical.space { height: 1vh; }
			body { background-color: black; color: #BBBBBB; font-family: sans-serif; letter-spacing: 2px; width: 100vw; }

			form { display: inline; width: auto; }
			button { background: #232b30; border: 1px solid #1c252b; color: #9fa8b0; font-weight: bold; height: 3vh; outline: 0; width: 20%; }
			button:hover { color: #fff; background: #4C5A64; }
			select { border: 1px solid #1c252b; display: inline; font-weight: bold; height: 3vh; margin-right: 0; width: 20%; }
			p { line-height: 180%; width: 80vw; }
			pre { background-color: rgba(235, 236, 228, 0.2); font-family: monospace; margin: 1vh 0 1vh 0; padding: 1vh 1vw 1vh 1vw; word-wrap: break-word; }
			pre .line-number { float: left; margin: 0 1em 0 -1em; border-right: 1px solid; text-align: right; }
			pre .line-number span { display: block; padding: 0 .5em 0 1em; }
		</style>
		<title>Cxy: The Fourth Evolution</title>
	</head>
	<body>
		<div class="prefoot">
		<?php
			include_once 'nav/Nav.php';

			$page = $_GET['page'];
			if (!isset($page))
				$page = 0;

			echo "<div id=\"navivalue\" hidden>$page</div>";

			$page = intval($page);
			echo generateNavibar($page);
		?>
			<div class="content">
			<?php
				if (doesPageExist($page)) {
					echo getVerticalSpace();
					echo getPage($page);
				}
				else {
					echo generateNavibar($page);
					echo '<div class="vertical space"></div>';
					echo '<pre> This part of the tutorial is not present </pre>';
				}
			?>
			</div>
		</div>
		<?php
				echo getVerticalSpace();
			echo generateNavibar($page);
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
		function httpGetAsyncPage(theUrl, callback) {
			selected = theUrl;
			theUrl = "?page=".concat(theUrl);
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
					callback(xmlHttp.responseText, selected);
				}
			xmlHttp.open("GET", theUrl, true); // true for asynchronous
			xmlHttp.send(null);
		}
		(function() {
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
