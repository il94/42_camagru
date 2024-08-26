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
    `notification_like` TINYINT(1) NOT NULL DEFAULT FALSE,
    `notification_comment` TINYINT(1) NOT NULL DEFAULT FALSE,
    `activation_token` VARCHAR(64) NOT NULL,
    `active` TINYINT(1) NOT NULL DEFAULT FALSE,
    `reset_password_token` VARCHAR(64) NOT NULL,
    `update_email_token` VARCHAR(64) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`username`),
    UNIQUE (`email`)
) ENGINE = InnoDB;

-- Insertion du compte 'root' dans la table 'user'
INSERT INTO `user` (`username`, `email`, `password`, `avatar`, `role`, `notification_like`, `notification_comment`, `activation_token`, `active`, `reset_password_token`, `update_email_token`)
VALUES 
(
    'root', 
    'root@outlook.fr', 
    '$2y$10$0va6xXZQjSJrbbR0nd5a..qqgK8wjtGgFQClnhXx0yNx5cdcWYoIa', 
    'uploads/default_avatar.svg', 
    'ADMIN', 
    TRUE, 
    TRUE, 
    '', 
    TRUE, 
    '', 
    ''
);

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
    `content` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX (`userId`),
    INDEX (`picId`),
    CONSTRAINT `fk_picId` FOREIGN KEY (`picId`) REFERENCES `pic`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;
