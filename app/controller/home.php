<?php

require_once('model/home.php');

function home() {
	
	$service = new HomeService();

	$createButton = getRandomCreateButton();
	
	$pics = $service->getLastFivePics();
	
	require_once('view/home.php');
}