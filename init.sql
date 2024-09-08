-- Crée la base de données si elle n'existe pas déjà
CREATE DATABASE IF NOT EXISTS dbcamagru;
USE dbcamagru;

-- Crée la table 'user'
CREATE TABLE IF NOT EXISTS `user` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(128) NOT NULL,
    `email` VARCHAR(128) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `avatar` VARCHAR(128) NOT NULL,
    `role` ENUM('USER', 'ADMIN', 'BAN', '') NOT NULL DEFAULT 'USER',
    `notification_like` TINYINT(1) NOT NULL DEFAULT TRUE,
    `notification_comment` TINYINT(1) NOT NULL DEFAULT TRUE,
    `activation_token` VARCHAR(64) DEFAULT NULL,
	 `activation_token_expires_at` DATETIME DEFAULT NULL,
    `active` TINYINT(1) NOT NULL DEFAULT FALSE,
    `reset_password_token` VARCHAR(64) DEFAULT NULL,
	 `reset_password_token_expires_at` DATETIME DEFAULT NULL,
    `update_email_token` VARCHAR(64) DEFAULT NULL,
	 `update_email_token_expires_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`username`),
    UNIQUE (`email`)
) ENGINE = InnoDB;

-- Crée la table 'pic'
CREATE TABLE IF NOT EXISTS `pic` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `userId` INT NOT NULL,
    `image` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX (`userId`),
    CONSTRAINT `fk_userId` FOREIGN KEY (`userId`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

-- Crée la table 'user_pic_likes'
CREATE TABLE IF NOT EXISTS `user_pic_likes` (
    `userId` INT NOT NULL,
    `picId` INT NOT NULL,
    PRIMARY KEY (`userId`, `picId`),
    CONSTRAINT `fk_user_pic_user` FOREIGN KEY (`userId`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_user_pic_pic` FOREIGN KEY (`picId`) REFERENCES `pic`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

-- Crée la table 'comment'
CREATE TABLE IF NOT EXISTS `comment` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `userId` INT NOT NULL,
    `picId` INT NOT NULL,
	 `content` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`),
    INDEX (`userId`),
    INDEX (`picId`),
    CONSTRAINT `fk_picId` FOREIGN KEY (`picId`) REFERENCES `pic`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;
