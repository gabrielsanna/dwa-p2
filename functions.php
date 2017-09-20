<?php

require 'helpers.php';

var_dump($_GET);

$siteUrl = $_GET['searchUrl'];

# Query the IP address
$dnsRecord = dns_get_record($siteUrl, DNS_A);
$ipAddress = $dnsRecord[0]['ip'];

# Request an HTTP header and store as an array

?>