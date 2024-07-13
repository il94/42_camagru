<?php

// Cree le user root
function createRoot($repository) {
	$rootDatas = new stdClass();
	$rootDatas->email = "root@outlook.fr";
	$rootDatas->username = "root";
	$rootDatas->password = password_hash("password", PASSWORD_DEFAULT);
	$rootDatas->avatar = "temp/root_avatar.svg";
	$rootDatas->role = "ADMIN";
	$rootDatas->activation_token = "";
	$rootDatas->active = true;
	$rootDatas->reset_password_token = "";

	$repository->createUser($rootDatas);
}

// Cree la table user
function createUserTable($client) {
    $request = $client->prepare("CREATE TABLE IF NOT EXISTS `dbcamagru`.`user` (
        `id` INT NOT NULL AUTO_INCREMENT ,
        `username` VARCHAR(128) NOT NULL ,
        `email` VARCHAR(128) NOT NULL ,
        `password` VARCHAR(128) NOT NULL ,
        `avatar` VARCHAR(128) NOT NULL ,
        `role` ENUM('USER','ADMIN','BAN','') NOT NULL DEFAULT 'USER' ,
        `activation_token` VARCHAR(64) NOT NULL ,
        `active` BOOLEAN NOT NULL DEFAULT 0 ,
        `reset_password_token` VARCHAR(64) NOT NULL ,
        PRIMARY KEY (`id`),
        UNIQUE (`username`),
        UNIQUE (`email`)
    )
    ENGINE = InnoDB");
    $request->execute();
}

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
		CONSTRAINT `fk_picId` FOREIGN KEY (`picId`) REFERENCES `pic`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
	) ENGINE = InnoDB");
	$request->execute();
}

// Cree des users test
function createUsersTest($repository) {
	$usersDatas[0] = new stdClass();
	$usersDatas[0]->email = "hello@outlook.fr";
	$usersDatas[0]->username = "hello";
	$usersDatas[0]->password = password_hash("password", PASSWORD_DEFAULT);
	$usersDatas[0]->avatar = "temp/pic_example_4.jpg";
	$usersDatas[0]->role = "USER";
	$usersDatas[0]->activation_token = "";
	$usersDatas[0]->active = true;
	$usersDatas[0]->reset_password_token = "";

	$usersDatas[1] = new stdClass();
	$usersDatas[1]->email = "hola@outlook.fr";
	$usersDatas[1]->username = "hola";
	$usersDatas[1]->password = password_hash("password", PASSWORD_DEFAULT);
	$usersDatas[1]->avatar = "temp/pic_example_1.jpg";
	$usersDatas[1]->role = "USER";
	$usersDatas[1]->activation_token = "";
	$usersDatas[1]->active = true;
	$usersDatas[1]->reset_password_token = "";

	$usersDatas[2] = new stdClass();
	$usersDatas[2]->email = "halo@outlook.fr";
	$usersDatas[2]->username = "halo";
	$usersDatas[2]->password = password_hash("password", PASSWORD_DEFAULT);
	$usersDatas[2]->avatar = "temp/pic_example_2.jpg";
	$usersDatas[2]->role = "USER";
	$usersDatas[2]->activation_token = "";
	$usersDatas[2]->active = true;
	$usersDatas[2]->reset_password_token = "";

	foreach ($usersDatas as $userDatas) {
		$repository->createUser($userDatas);
	}
}

// Cree des pics test
function createPicsTest($client) {
	$request = $client->prepare("INSERT INTO `pic` (
		`id`, `userId`, `image`, `likesCount`
	) VALUES
		(NULL, '2', 'temp/pic_example_2.jpg', '0'),
		(NULL, '3', 'temp/pic_example_1.jpg', '0'),
		(NULL, '4', 'temp/pic_example_4.jpg', '0')");
	$request->execute();
}

// Verifie si les pics test ont deja ete crees
function picTestExist($client) {
	$request = $client->prepare("SELECT id FROM pic WHERE id=1");
	$request->execute();
	$result = $request->fetchAll();

	return ($result);
}

// Cree des comments test
function createCommentsTest($client) {
	$request = $client->prepare("INSERT INTO `comment` (
		`id`, `userId`, `picId`, `content`
	) VALUES
		(NULL, '1', '3', 'ROOT COMMENT'),
		(NULL, '2', '3', 'Very nice !'),
		(NULL, '3', '3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut. ssalsalkdsdjhvjhdfghdfkjvdcnvidbkvdfgivfdg');");
	$request->execute();
}

// Initialise l'app
function initApp() {
	$client = connectDB();

	$authRepository = new AuthRepository();

	try {
		createUserTable($client);
		createRoot($authRepository);

		createUsersTest($authRepository); // TEMPORAIRE
	
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