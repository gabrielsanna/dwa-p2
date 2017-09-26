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
    public function __construct($jsonPath = null, $queryProtocol = "http", $queryData = "all")
    {
        
    }

    # SET methods, for setting internal properties
    public set_url($url)
    {
    	$this->queryURL = $url;
    	pull_http_header($url, $this->queryProtocol)
    }

    public set_protocol($protocol)
    {
    	$this->queryProtocol = $protocol;
    	pull_http_header($url, $this->queryProtocol)
    }

    public set_data($data)
    {
    	$this->queryData = $data; 
    }

 	###################################################################
	# Query methods, for querying information about our target URL
	###################################################################

    # Get an http header from the target URL
    private pull_http_header(string $address, string $webProtocol) {
    	# Request an HTTP header and store as an array
		$cmdOutput = shell_exec('curl -I '.$webProtocol.'://'.$siteUrl);
		$cmdOutput = explode(PHP_EOL, $cmdOutput);

		$this->httpHeader = $cmdOutput;
    }

    private pull_ip_address(string $address) {

    }

    private pull_webserver() {
    	if (empty($httpHeader) == true) {
    		$httpHeader = pull_http_header($this->address);
    	}

    	foreach ($httpHeader as $value) {
    		if (strpos($value, 'Server: ') !== false) {
				$server = str_replace('Server: ', '', $value); 
			}
    	}

    	return $server;
    }

    private pull_sets_cookie() {
    	if (empty($this->httpHeader) == true) {
    		$this->httpHeader = pull_http_header($this->address);
    	}

    	$cookie = false;

    	foreach ($this->httpHeader as $value) {
    		if (strpos($value, 'Set-Cookie:') !== false) {
				$cookie = true;
			}
    	}

    	return $cookie;
    }		
} #eoc