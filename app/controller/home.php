<?php

require('model/home.php');

$createButton = getRandomCreateButton();

$pics = getPics();

require_once('view/home.php');