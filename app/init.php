<?php

// Cree le user root
function createRoot($repository) {
	$rootDatas = new stdClass();
	$rootDatas->username = "root";
	$rootDatas->email = "root@outlook.fr";
	$rootDatas->password = password_hash("password", PASSWORD_DEFAULT);
	$rootDatas->avatar = DEFAULT_AVATAR;
	$rootDatas->role = "ADMIN";
	$rootDatas->notification_like = true;
	$rootDatas->notification_comment = true;
	$rootDatas->activation_token = "";
	$rootDatas->active = true;
	$rootDatas->reset_password_token = "";
	$rootDatas->update_email_token = "";

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
		`notification_like` TINYINT(1) NOT NULL DEFAULT FALSE ,
        `notification_comment` TINYINT(1) NOT NULL DEFAULT FALSE ,
	    `activation_token` VARCHAR(64) NOT NULL ,
        `active` TINYINT(1) NOT NULL DEFAULT FALSE ,
        `reset_password_token` VARCHAR(64) NOT NULL ,
        `update_email_token` VARCHAR(64) NOT NULL ,
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
		PRIMARY KEY (`id`),
		INDEX (`userId`),
		CONSTRAINT `fk_userId` FOREIGN KEY (`userId`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
	)
	ENGINE = InnoDB;");
	$request->execute();
}

// Cree la table user_pic_likes
function createUserPicLikesTable($client) {
    $request = $client->prepare("CREATE TABLE `dbcamagru`.`user_pic_likes` (
        `userId` INT NOT NULL,
        `picId` INT NOT NULL,
        PRIMARY KEY (`userId`, `picId`),
        CONSTRAINT `fk_user_pic_user` FOREIGN KEY (`userId`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `fk_user_pic_pic` FOREIGN KEY (`picId`) REFERENCES `pic`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
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

// Initialise l'app
function initApp() {
	$client = connectDB();

	$authRepository = new AuthRepository();

	try {
		createUserTable($client);
		createRoot($authRepository);

		createPicTable($client);
		createCommentTable($client);

		createUserPicLikesTable($client);
	}
	catch (Exception $error) {
		die($error->getMessage());
	}

}