<?php require 'functions.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title</title>
	<meta charset='utf-8'>

	<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
	<div id="wrapper">

		<h1>Project 2</h1>

		<form method='GET' action='search.php'>

    		<label>Enter a web URL:
        		<input type='text' name='searchTerm'>
    		</label>
    		<br>

    		<label>What information would you like to query?
	    		<select>
					<option value="webserver">Type of Web Server</option>
					<option value="ipaddress">IP Address</option>
					<option value="setscookie">Does this page set a cookie?</option>
					<option value="all">All Information</option>
				</select>
			</label>
			<br>

    		<input type='submit' value='Search'>

		</form>



			<div class="data-output">
				<h2>URL</h2>
				<h3>IP Address: x</h3>
				<h3>Web server software: x</h3>
				<h3>Does page set a cookie? x</h3>
			</div>

	</div>
</body>
</html>
