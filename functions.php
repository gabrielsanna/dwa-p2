<?php

require 'Form.php';
require 'SiteScanner.php';

use DWA\Form;
use GSANNA\SiteScanner;

$form = new Form($_GET);
$resultArray = array();

if ($form->isSubmitted()) {
	# Get variables from $form
	$searchUrl = $form->get('searchUrl');
	$protocol = $form->get('protocol');
	$dataToPull = $form->get('dataToPull');

	# Validate
	$errors = $form->validate([
		'searchUrl' => 'required|url'
	]);

	if (empty($errors)) {
		$scanner = new SiteScanner($searchUrl, $protocol, $dataToPull);

		$resultArray = $scanner->get_array();
	}
}