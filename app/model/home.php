<?php

function getRandomCreateButton() {
	$result = rand(1, 6);

	return ("view/create_button_" . $result . ".php");
}