<?php

require 'helpers.php';
require 'Form.php';
require 'SiteScanner.php';

use DWA\Form;
use GSANNA\SiteScanner;

# Get variables passed from the last page
$siteUrl = sanitize($_GET['searchUrl']);
$webProtocol = $_GET['protocol'];
$pullData = $_GET['dataToPull'];

# Query the IP address; we'll just grab the first A record
$dnsRecord = dns_get_record($siteUrl, DNS_A);
$ipAddress = $dnsRecord[0]['ip'];

# Build a keyed array of data to output
if (empty($siteUrl) == false) {
	$resultArray = array(
		"URL" => "$siteUrl"	
	);
}
if ($pullData == "all" || $pullData == "webserver") {
	$resultArray["Web server"] = $server;
}
if ($pullData == "all" || $pullData == "ipaddress") {
	$resultArray["IP address"] = $ipAddress;
}
if ($pullData == "all" || $pullData == "setscookie") {
	$resultArray["Sets cookie"] = $cookie;
}
