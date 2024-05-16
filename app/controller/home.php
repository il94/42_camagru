<?php

require('model/home.php');

createDB();

$createButton = getRandomCreateButton();

$pics = getPics();

require_once('view/home.php');