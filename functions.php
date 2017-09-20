<?php

require 'helpers.php';

# Get variables passed from the last page
$siteUrl = sanitize($_GET['searchUrl']);
$webProtocol = $_GET['protocol'];
$pullData = $_GET['dataToPull'];

# Query the IP address; we'll just grab the first A record
$dnsRecord = dns_get_record($siteUrl, DNS_A);
$ipAddress = $dnsRecord[0]['ip'];

# Request an HTTP header and store as an array
$cmdOutput = shell_exec('curl -I '.$webProtocol.'://'.$siteUrl);
$cmdOutput = explode(PHP_EOL, $cmdOutput);

# Loop through the header and pick out information we care about
$cookie = "No";
foreach ($cmdOutput as $value) {
	if (strpos($value, 'Server: ') !== false) {
		$server = str_replace('Server: ', '', $value); 
	}
	if (strpos($value, 'Set-Cookie:') !== false) {
		$cookie = "Yes";
	}
}

# Build a keyed array of data to output
$resultArray = array(
	"URL" => "$siteUrl"	
);
if ($pullData == "all" || $pullData == "webserver") {
	$resultArray["Web server"] = $server;
}
if ($pullData == "all" || $pullData == "ipaddress") {
	$resultArray["IP address"] = $ipAddress;
}
if ($pullData == "all" || $pullData == "setscookie") {
	$resultArray["Sets cookie"] = $cookie;
}
