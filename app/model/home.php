<?php

require_once("lib/utils.php");

require("class/User.php");
require("class/Pic.php");
require("class/Comment.php");

require_once("HomeService.php");
require_once("HomeRepository.php");

// Retourne l'url d'un bouton create aleatoire
function getRandomCreateButton() {
	$result = rand(1, 6);

	return ("view/assets/create_button_" . $result . ".php");
}