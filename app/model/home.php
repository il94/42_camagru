<?php

require("class/User.php");
require("class/Pic.php");
require("class/Comment.php");

// REPOSITORY

// USER

// Cree la table user
function createUserTable($client) {
	$request = $client->prepare("CREATE TABLE IF NOT EXISTS `dbcamagru`.`user` (
		`id` INT NOT NULL AUTO_INCREMENT ,
		`username` VARCHAR(128) NOT NULL ,
		`email` VARCHAR(128) NOT NULL ,
		`password` VARCHAR(128) NOT NULL ,
		`avatar` VARCHAR(128) NOT NULL ,
		`role` ENUM('USER','ADMIN','BAN','') NOT NULL DEFAULT 'USER' ,
		PRIMARY KEY (`id`),
		UNIQUE (`username`),
		UNIQUE (`email`)
	)
	ENGINE = InnoDB");
	$request->execute();
}

// Cree le user root
function createRoot($client) {
	$request = $client->prepare("INSERT INTO `user` (
		`id`, `username`, `email`, `password`, `avatar`, `role`
	)
	VALUES
		(NULL, 'root', 'root@outlook.fr', 'root_password', 'root_avatar', 'ADMIN')");
	$request->execute();
}

// Cree des users test
function createUsersTest($client) {
	$request = $client->prepare("INSERT INTO `user` (
		`id`, `username`, `email`, `password`, `avatar`, `role`
	)
	VALUES
		(NULL, 'Hello', 'hello@osef.com', 'mdp', 'temp/pic_example_4.jpg', 'USER'),
		(NULL, 'Hola', 'hola@osef.com', 'mdp', 'temp/pic_example_1.jpg', 'USER'),
		(NULL, 'Halo', 'halo@osef.com', 'mdp', 'temp/pic_example_2.jpg', 'USER')");
	$request->execute();
}


// PIC

// Cree la table pic
function createPicTable($client) {
	$request = $client->prepare("CREATE TABLE `dbcamagru`.`pic` (
		`id` INT NOT NULL AUTO_INCREMENT,
		`userId` INT NOT NULL,
		`image` VARCHAR(128) NOT NULL,
		`likesCount` INT NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`),
		INDEX (`userId`),
		CONSTRAINT `fk_userId` FOREIGN KEY (`userId`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
	)
	ENGINE = InnoDB;");
	$request->execute();
}

// Cree des pics test
function createPicsTest($client) {
	$request = $client->prepare("INSERT INTO `pic` (
		`id`, `userId`, `image`, `likesCount`, `commentsCount`
	) VALUES
		(NULL, '5', 'temp/pic_example_4.jpg', '0', '0'),
		(NULL, '6', 'temp/pic_example_1.jpg', '0', '0'),
		(NULL, '7', 'temp/pic_example_2.jpg', '0', '0')");
	$request->execute();
}

// Verifie si les pics test ont deja ete crees
function picTestExist($client) {
	$request = $client->prepare("SELECT id FROM pic WHERE id=1");
	$request->execute();
	$result = $request->fetchAll();

	return ($result);
}

// Recupere les 5 dernieres pics
function getLastFivePics($client) {

    $recPics = $client->prepare(
		"SELECT
			pic.*, user.username AS author, user.avatar AS author_avatar
        FROM `pic`
        JOIN user ON pic.userId = user.id
        ORDER BY pic.id DESC
        LIMIT 5
	");
	$recPics->execute();
	$picsDatas = $recPics->fetchAll(PDO::FETCH_OBJ);

	foreach ($picsDatas as &$pic) {
		$pic->comments = getComments($client, $pic->id);
	}

	// prettyPrint($picsDatas);

	return ($picsDatas);
}


// COMMENT

// Cree la table comment
function createCommentTable($client) {
	$request = $client->prepare("CREATE TABLE `dbcamagru`.`comment` (
		`id` INT NOT NULL AUTO_INCREMENT,
		`userId` INT NOT NULL,
		`picId` INT NOT NULL,
		`content` TEXT NOT NULL,
		PRIMARY KEY (`id`),
		INDEX (`userId`),
		INDEX (`picId`),
		CONSTRAINT `fk_userId` FOREIGN KEY (`userId`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
		CONSTRAINT `fk_picId` FOREIGN KEY (`picId`) REFERENCES `pic`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
	) ENGINE = InnoDB");
	$request->execute();
}

// Cree des comments test
function createCommentsTest($client) {
	$request = $client->prepare("INSERT INTO `comment` (
		`id`, `userId`, `picId`, `content`
	) VALUES
		(NULL, '1', '18', 'ROOT COMMENT'),
		(NULL, '5', '18', 'Very nice !'),
		(NULL, '6', '18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut. ssalsalkdsdjhvjhdfghdfkjvdcnvidbkvdfgivfdg');");
	$request->execute();
}

// Recupere les comments d'une pic
function getComments($client, $picId) {
	$reqComments = $client->prepare(
		"SELECT comment.*, user.username AS author, user.avatar AS author_avatar
		FROM comment
		JOIN user ON comment.userId = user.id
		WHERE picId=$picId
		ORDER BY comment.id DESC
        LIMIT 5
	");
	$reqComments->execute();
	$commentsDatas = $reqComments->fetchAll(PDO::FETCH_OBJ);

	return ($commentsDatas);
}


// SERVICES

function prettyPrint($object) {
	echo "<pre>";
		print_r($object);
	echo "</pre>";
}

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

function createDB() {
	try {
		$client = connectDB();

		createUserTable($client);
		createRoot($client);
		createUsersTest($client); // TEMPORAIRE
	
		createPicTable($client);
		createCommentTable($client);
		if (!picTestExist($client)) // TEMPORAIRE
		{
			createPicsTest($client); // TEMPORAIRE
			createCommentsTest($client); // TEMPORAIRE
		}
	}
	catch (Exception $error) {
		die($error->getMessage());
	}
}

function getRandomCreateButton() {
	$result = rand(1, 6);

	return ("view/create_button_" . $result . ".php");
}

function getPics() {

	$client = connectDB();

	$picDatas = getLastFivePics($client);

	$pics = [];
	foreach ($picDatas as $picData) {

		$comments = [];
		foreach ($picData->comments as $commentData) {
			$comments[] = Comment::withParams(
				$commentData->id,
				$commentData->content,
				User::withParams(
					$commentData->userId,
					$commentData->author,
					$commentData->author_avatar
				)
			);
		}

		$pic = Pic::withParams(
			$picData->id,
			$picData->image,
			$picData->likesCount,
			User::withParams(
				$picData->userId,
				$picData->author,
				$picData->author_avatar
			),
			$comments
		);
		$pics[] = $pic;
	}

	return ($pics);
}