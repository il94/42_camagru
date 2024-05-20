<?php

require('model/home.php');

function home() {

	createDB();
	
	$createButton = getRandomCreateButton();
	
	$pics = getPics();
	
	require_once('view/home.php');
}