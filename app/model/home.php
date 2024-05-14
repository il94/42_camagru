<?php

function getRandomCreateButton() {
	$result = rand(1, 6);

	return ("view/create_button_" . $result . ".php");
}

function getPics() {

	require("class/Pic.php");

	$picsTemp = [
		Pic::withParams(
			0,
			"Hello",
			"temp/pic_example_4.jpg",
			"temp/pic_example_4.jpg",
			4242, 
			7
		),
		Pic::withParams(
			0,
			"Hola",
			"temp/pic_example_1.jpg",
			"temp/pic_example_1.jpg",
			386, 
			0
		),
		Pic::withParams(
			0,
			"Halo",
			"temp/pic_example_2.jpg",
			"temp/pic_example_2.jpg",
			4, 
			1
		),
		Pic::withParams(
			0,
			"Salut",
			"temp/pic_example_3.jpg",
			"temp/pic_example_3.jpg",
			0, 
			0
		)
	];

	return ($picsTemp);
}