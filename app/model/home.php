<?php

require("class/User.php");
require("class/Pic.php");
require("class/Comment.php");

function getRandomCreateButton() {
	$result = rand(1, 6);

	return ("view/create_button_" . $result . ".php");
}

function getUsers() {
	$users = [
		User::withParams(
			0,
			"Hello",
			"temp/pic_example_4.jpg"
		),
		User::withParams(
			1,
			"Hola",
			"temp/pic_example_1.jpg"
		),
		User::withParams(
			2,
			"Halo",
			"temp/pic_example_2.jpg"
		),
		User::withParams(
			3,
			"Salut",
			"temp/pic_example_3.jpg"
		)
	];

	return ($users);
}

function getComments($users) {
	$comments = [
		Comment::withParams(
			0,
			"Very nice !",
			$users[0]
		),
		Comment::withParams(
			1,
			"Lorem ipsum dolor sit amet, consectetur adipiscing
			elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
			ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.
			ssalsalkdsdjhvjhdfghdfkjvdcnvidbkvdfgivfdg",
			$users[1]
		),
		Comment::withParams(
			2,
			"cool",
			$users[2]
		),
		Comment::withParams(
			3,
			"OK",
			$users[3]
		)
	];

	return ($comments);
}

function getPics() {

	$users = getUsers();
	$comments = getComments($users);

	$pics = [
		Pic::withParams(
			0,
			"temp/pic_example_4.jpg",
			$users[0]
		),
		Pic::withParams(
			1,
			"temp/pic_example_1.jpg",
			$users[1]
		),
		Pic::withParams(
			2,
			"temp/pic_example_2.jpg",
			$users[2]
		),
		Pic::withParams(
			3,
			"temp/pic_example_3.jpg",
			$users[3]
		)
	];

	for ($i = 0; $i < count($pics); $i++) {
		for ($j = 0; $j <= $i; $j++) {
			$pics[$i]->addComment($comments[$i]);
		}
	}

	return ($pics);
}