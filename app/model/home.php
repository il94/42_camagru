<?php

require("class/User.php");
require("class/Pic.php");
require("class/Comment.php");

function connectDB() {
	try {
		$client = new PDO(
			$_ENV['MYSQL_DSN'],
			$_ENV['MYSQL_ROOT'],
			$_ENV['MYSQL_ROOT_PASSWORD']
		);

		return ($client);
	}
	catch (Exception $error) {
		die($error->getMessage());
	}
}

function getRandomCreateButton() {
	$result = rand(1, 6);

	return ("view/create_button_" . $result . ".php");
}

function getUsers($client, $userIds) {

	$userIdsImplode = "( " . implode(',', $userIds) . " )";
	$userRequest = $client->prepare("SELECT id, username, avatar FROM user WHERE id IN " . $userIdsImplode);

	$userRequest->execute();
	$userDatas = $userRequest->fetchAll();

	$users = [];

	foreach ($userDatas as $userData) {
		$user = User::withParams(
			$userData['id'],
			$userData['username'],
			$userData['avatar']
		);
		$users[] = $user;
	}

	// $usersTemp = [
	// 	User::withParams(
	// 		0,
	// 		"Hello",
	// 		"temp/pic_example_4.jpg"
	// 	),
	// 	User::withParams(
	// 		1,
	// 		"Hola",
	// 		"temp/pic_example_1.jpg"
	// 	),
	// 	User::withParams(
	// 		2,
	// 		"Halo",
	// 		"temp/pic_example_2.jpg"
	// 	),
	// 	User::withParams(
	// 		3,
	// 		"Salut",
	// 		"temp/pic_example_3.jpg"
	// 	)
	// ];

	// var_dump($userDatas[0]);
	// echo "<br />";
	// echo "<br />";
	// var_dump($usersTemp[0]);
	// echo "<br />";
	// echo "<br />";
	// var_dump($users);

	return ($users);
}

function getComments($client, $users) {

	$commentRequest = $client->prepare("SELECT * FROM comment");

	$commentRequest->execute();
	$commentDatas = $commentRequest->fetchAll();

	$comments = [];

	// var_dump($commentDatas[0]);

	// foreach ($commentDatas as $commentData) {

	// 	// $username = $users

	// 	$comment = Comment::withParams(
	// 		$commentData['id'],
	// 		$commentData['username'],
	// 		$commentData['avatar']
	// 	);
	// 	$comments[] = $comment;
	// }


	// $comments = [
	// 	Comment::withParams(
	// 		0,
	// 		"Very nice !",
	// 		$users[0]
	// 	),
	// 	Comment::withParams(
	// 		1,
	// 		"Lorem ipsum dolor sit amet, consectetur adipiscing
	// 		elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
	// 		ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.
	// 		ssalsalkdsdjhvjhdfghdfkjvdcnvidbkvdfgivfdg",
	// 		$users[1]
	// 	),
	// 	Comment::withParams(
	// 		2,
	// 		"cool",
	// 		$users[2]
	// 	),
	// 	Comment::withParams(
	// 		3,
	// 		"OK",
	// 		$users[3]
	// 	)
	// ];

	return ($comments);
}

function getPics() {

	$client = connectDB();

	$picRequest = $client->prepare("SELECT * FROM pic ORDER BY id DESC LIMIT 5");

	$picRequest->execute();
	$picDatas = $picRequest->fetchAll();

	
	$userIds = [];
	foreach ($picDatas as $picData) {
		$userId = $picData['userId'];
		$userIds[] = $userId;
	}
	
	$users = getUsers($client, $userIds);
	// $comments = getComments($client, $users);


	var_dump($users);


	$pics = [];
	foreach ($picDatas as $picData) {
		$user = User::withParams(
			
		);

		$pic = Pic::withParams(
			$picData['id'],
			$picData['image'],
			// $picData['likes'],
			// $picData['commentsCount'],
			// $picData['likes'],
			// [],
			$user
		);
		$pics[] = $pic;
	}

	// $pics = [
	// 	Pic::withParams(
	// 		0,
	// 		"temp/pic_example_4.jpg",
	// 		$users[0]
	// 	),
	// 	Pic::withParams(
	// 		1,
	// 		"temp/pic_example_1.jpg",
	// 		$users[1]
	// 	),
	// 	Pic::withParams(
	// 		2,
	// 		"temp/pic_example_2.jpg",
	// 		$users[2]
	// 	),
	// 	Pic::withParams(
	// 		3,
	// 		"temp/pic_example_3.jpg",
	// 		$users[3]
	// 	)
	// ];

	// for ($i = 0; $i < count($pics); $i++) {
	// 	for ($j = 0; $j <= $i; $j++) {
	// 		$pics[$i]->addComment($comments[$i]);
	// 	}
	// }





	return ($pics);
}