<?php

namespace GSANNA;

class SiteScanner
{
	# Properties
    private $queryURL;
    private $queryProtocol;
    private $queryDataType;
    private $httpHeader;

    # Methods
    public function __construct($url, $protocol = "http", $queryData = "all")
    {
        $this->queryURL = $url;
        $this->queryProtocol = $url;
        $this->queryDataType = $queryData;

        if ($queryData == "all" || $queryData == "webserver" || $queryData == "setscookie") {
        	$this->pull_http_header($url, $protocol);
		}
    }

    ###################################################################
	# SET methods, for changing properties. Not needed for p2, but
	#   makes the code more flexible.
	###################################################################

    public function set_url($url)
    {
    	$this->queryURL = $url;
    	pull_http_header($url, $this->queryProtocol);
    }

    public function set_protocol($protocol)
    {
    	$this->queryProtocol = $protocol;
    	pull_http_header($url, $this->queryProtocol);
    }

    public function set_data($data)
    {
    	$this->queryData = $data; 
    }

 	###################################################################
	# Query methods, for querying information about our target URL
	###################################################################

    # Get an http header from the target URL
    private function pull_http_header(string $address, string $webProtocol) {
    	# Request an HTTP header and store as an array
		$cmdOutput = shell_exec('curl -I '.$webProtocol.'://'.$address);
		$cmdOutput = explode(PHP_EOL, $cmdOutput);

		$this->httpHeader = $cmdOutput;
    }

    private function pull_ip_address() {
    	# Query the IP address; we'll just grab the first A record
		$dnsRecord = dns_get_record($this->queryURL, DNS_A);
		$ipAddress = $dnsRecord[0]['ip'];

		return $ipAddress;
    }

    private function pull_webserver() {
    	if (empty($this->httpHeader) == true) {
    		$this->httpHeader = $this->pull_http_header($this->queryURL, $this->queryProtocol);
    	}

    	foreach ($this->httpHeader as $value) {
    		if (strpos($value, 'Server: ') !== false) {
				$server = str_replace('Server: ', '', $value); 
			}
    	}

    	if (isset($server) == false) {
    		$server = "Unknown";
    	}

    	return $server;
    }

    private function pull_sets_cookie() {
    	if (empty($this->httpHeader) == true) {
    		$this->httpHeader = $this->pull_http_header($this->address, $this->queryProtocol);
    	}

    	$cookie = "No";

    	foreach ($this->httpHeader as $value) {
    		if (strpos($value, 'Set-Cookie:') !== false) {
				$cookie = "Yes";
			}
    	}

    	return $cookie;
    }

    ###################################################################
	# GET methods, to pass data back to the logic file
	###################################################################

    public function get_array() {
    	# Build a keyed array of data to output
		$resultArray = array(
			"URL" => "$this->queryURL"
		);

		if ($this->queryDataType == "all" || $this->queryDataType == "webserver") {
			$resultArray["Web server"] = $this->pull_webserver();
		}
		if ($this->queryDataType == "all" || $this->queryDataType == "ipaddress") {
			$resultArray["IP address"] = $this->pull_ip_address();
		}
		if ($this->queryDataType == "all" || $this->queryDataType == "setscookie") {
			$resultArray["Sets cookie"] = $this->pull_sets_cookie();
		}

		return $resultArray;
    }

} #eoc