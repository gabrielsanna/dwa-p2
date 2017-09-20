<?php require 'functions.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title</title>
	<meta charset='utf-8'>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
	<div id="wrapper">

		<h1>Project 2</h1>

		<form method='GET'>

			<div class="form-group">
	    		<label>Enter a web URL:</label>
	        	<input type='text' class="form-control" type="url" name='searchUrl' placeholder="www.example.com">
    		</div>

    		<div class="form-group">
    			<label for='querySelect'>What information would you like to query?</label>
		    	<select class="form-control" id="querySelect">
					<option value="webserver">Type of Web Server</option>
					<option value="ipaddress">IP Address</option>
					<option value="setscookie">Does this page set a cookie?</option>
					<option value="all">All Information</option>
				</select>
			</div>

			<fieldset class="form-group">
				<label class="form-check-label">What protocol should be used?</label>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="protocol" value="http" checked> HTTP
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="protocol" value="https"> HTTPS
					</label>
				</div>
			</fieldset>

    		<input type='submit' class='btn btn-primary btn-small' value='Search'>

		</form>

		<br>
		<div class="data-output">
			<h2><?=$siteUrl?></h2>
			<h3>IP Address: <?=$ipAddress?></h3>
			<h3>Web server software: x</h3>
			<h3>Does page set a cookie? x</h3>
		</div>

	</div>
</body>
</html>
