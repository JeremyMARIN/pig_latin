<?php
include("include/helpers.php");
?>

<html>
	<head>
		<title>Pig Latin</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body>
		<header id="header">
			<div class="panel round">
				<h2 class="text-centered">Translation</h2>
			</div>
		</header>

		<div id="content">
			<div class="panel round">
				<?php
				if (isset($_POST["input"]) && isset($_POST["echo"])) {
					$input = $_POST["input"];
					if ($_POST["echo"] == "on")
						echo "<h2>English echo:</h2><textarea class=\"full-width\" readonly>" . $input . "</textarea><hr />";

					echo "<h2>Pig Latin translation:</h2><textarea class=\"full-width\" readonly>" . processText($input) . "</textarea>";
				} else
					echo "Invalid request...";
				?>

				<br /><br /><br />

				<div class="text-centered">
					<a href="index.html"><button class="round" type="button">Go back</button></a>
				</div>
			</div>
		</div>
	</body>
</html>