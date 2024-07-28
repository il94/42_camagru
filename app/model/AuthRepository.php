<?php

class AuthRepository {
	public ?PDO $database = null;

	public function __construct() {
		$this->database = connectDB();
	}

	// Crée un user
	public function createUser($userDatas) {
		$request = $this->database->prepare("INSERT INTO `user` (
			`email`, `username`, `password`, `avatar`, `role`, `notification_like`, `notification_comment`, `activation_token`, `active`, `reset_password_token`, `update_email_token`
		) VALUES
			(:email, :username, :password, :avatar, :role, :notification_like, :notification_comment, :activation_token, :active, :reset_password_token, :update_email_token)");
		
		$request->bindParam(':email', $userDatas->email, PDO::PARAM_STR);
		$request->bindParam(':username', $userDatas->username, PDO::PARAM_STR);
		$request->bindParam(':password', $userDatas->password, PDO::PARAM_STR);
		$request->bindParam(':avatar', $userDatas->avatar, PDO::PARAM_STR);
  		$request->bindParam(':role', $userDatas->role, PDO::PARAM_STR);
  		$request->bindParam(':notification_like', $userDatas->notification_like, PDO::PARAM_BOOL);
  		$request->bindParam(':notification_comment', $userDatas->notification_comment, PDO::PARAM_BOOL);
  		$request->bindParam(':activation_token', $userDatas->activation_token, PDO::PARAM_STR);
  		$request->bindParam(':active', $userDatas->active, PDO::PARAM_BOOL);
  		$request->bindParam(':reset_password_token', $userDatas->reset_password_token, PDO::PARAM_STR);
  		$request->bindParam(':update_email_token', $userDatas->update_email_token, PDO::PARAM_STR);
		$request->execute();
	}

	// Cherche un user par son id
	public function findUserById($id) {
		$request = $this->database->prepare("SELECT * FROM user WHERE id=:id");
		$request->bindParam(':id', $id, PDO::PARAM_INT);
		$request->execute();

		$userDatas = $request->fetch(PDO::FETCH_OBJ);
		return ($userDatas);
	}

	// Cherche un user par son id
	public function findUserByIdSecure($id) {
		$request = $this->database->prepare("
			SELECT
				id, username, email, avatar, notification_like, notification_comment
			FROM user WHERE id=:id");
		$request->bindParam(':id', $id, PDO::PARAM_INT);
		$request->execute();

		$userDatas = $request->fetch(PDO::FETCH_OBJ);
		return ($userDatas);
	}

	// Cherche un user par l'id d'une pic
	public function findUserByPicIdSecure($id) {
		$request = $this->database->prepare("
			SELECT
				user.id, user.username, user.email, user.avatar, user.notification_like, user.notification_comment
			FROM pic
			JOIN user ON pic.userId = user.id
			WHERE pic.id=:id");
	
		$request->bindParam(':id', $id, PDO::PARAM_INT);
		$request->execute();

		$userDatas = $request->fetch(PDO::FETCH_OBJ);
		return ($userDatas);
	}

	// Cherche un user par son email
	public function findUserByEmail($email) {
		$request = $this->database->prepare("SELECT * FROM user WHERE email=:email");
		$request->bindParam(':email', $email, PDO::PARAM_STR);
		$request->execute();

		$userDatas = $request->fetch(PDO::FETCH_OBJ);
		return ($userDatas);
	}

	// Cherche un user par son username
	public function findUserByUsername($username) {
		$request = $this->database->prepare("SELECT * FROM user WHERE username=:username");
		$request->bindParam(':username', $username, PDO::PARAM_STR);
		$request->execute();

		$userDatas = $request->fetch(PDO::FETCH_OBJ);
		return ($userDatas);
	}

	// Cherche un user par son token d'activation
	public function findUserByActivationToken($token) {
		$request = $this->database->prepare("SELECT * FROM user WHERE activation_token=:activation_token");
		$request->bindParam(':activation_token', $token, PDO::PARAM_STR);
		$request->execute();

		$userDatas = $request->fetch(PDO::FETCH_OBJ);
		return ($userDatas);
	}

	// Cherche un user par son token de reinitialization de mot de passe
	public function findUserByResetPasswordToken($token) {
		$request = $this->database->prepare("SELECT * FROM user WHERE reset_password_token=:reset_password_token");
		$request->bindParam(':reset_password_token', $token, PDO::PARAM_STR);
		$request->execute();

		$userDatas = $request->fetch(PDO::FETCH_OBJ);
		return ($userDatas);
	}

	// Cherche un user par son token de reinitialization de mot de passe
	public function findUserByUpdateEmailToken($token) {
		$request = $this->database->prepare("SELECT * FROM user WHERE update_email_token=:update_email_token");
		$request->bindParam(':update_email_token', $token, PDO::PARAM_STR);
		$request->execute();

		$userDatas = $request->fetch(PDO::FETCH_OBJ);
		return ($userDatas);
	}

	// Update l'email d'un user
	public function updateUserEmail($userDatas) {
		$request = $this->database->prepare("UPDATE user SET email = :email WHERE id=:id");
		$request->bindParam(':id', $userDatas->id, PDO::PARAM_INT);
		$request->bindParam(':email', $userDatas->email, PDO::PARAM_STR);
		$request->execute();
	}

	// Update le username d'un user
	public function updateUserUsername($userDatas) {
		$request = $this->database->prepare("UPDATE user SET username = :username WHERE id=:id");
		$request->bindParam(':id', $userDatas->id, PDO::PARAM_INT);
		$request->bindParam(':username', $userDatas->username, PDO::PARAM_STR);
		$request->execute();
	}

	// Update le password d'un user
	public function updateUserPassword($userDatas) {
		$request = $this->database->prepare("UPDATE user SET password = :password WHERE id=:id");
		$request->bindParam(':id', $userDatas->id, PDO::PARAM_INT);
		$request->bindParam(':password', $userDatas->password, PDO::PARAM_STR);
		$request->execute();
	}

	// Update l'avatar d'un user
	public function updateUserAvatar($userDatas) {
		$request = $this->database->prepare("UPDATE user SET avatar = :avatar WHERE id=:id");
		$request->bindParam(':id', $userDatas->id, PDO::PARAM_INT);
		$request->bindParam(':avatar', $userDatas->avatar, PDO::PARAM_STR);
		$request->execute();
	}

	// Update les notification like d'un user
	public function updateUserNotificationLike($userDatas) {
		$request = $this->database->prepare("UPDATE user SET notification_like = :notification_like WHERE id=:id");
		$request->bindParam(':id', $userDatas->id, PDO::PARAM_INT);
		$request->bindParam(':notification_like', $userDatas->notification_like, PDO::PARAM_INT);
		$request->execute();
	}

	// Update les notification comment d'un user
	public function updateUserNotificationComment($userDatas) {
		$request = $this->database->prepare("UPDATE user SET notification_comment = :notification_comment WHERE id=:id");
		$request->bindParam(':id', $userDatas->id, PDO::PARAM_INT);
		$request->bindParam(':notification_comment', $userDatas->notification_comment, PDO::PARAM_INT);
		$request->execute();
	}

	// Update le active d'un user
	public function updateUserActive($userDatas) {
		$request = $this->database->prepare("UPDATE user SET active = :active WHERE id=:id");
		$request->bindParam(':id', $userDatas->id, PDO::PARAM_INT);
		$request->bindParam(':active', $userDatas->active, PDO::PARAM_BOOL);
		$request->execute();
	}

	// Update l'email d'un user
	public function updateUserUpdateEmailToken($userDatas) {
		$request = $this->database->prepare("UPDATE user SET update_email_token = :update_email_token WHERE id=:id");
		$request->bindParam(':id', $userDatas->id, PDO::PARAM_INT);
		$request->bindParam(':update_email_token', $userDatas->update_email_token, PDO::PARAM_STR);
		$request->execute();
	}

	// Supprime une pic
	function deletePic($id) {
		$request = $this->database->prepare("DELETE FROM `pic` WHERE `id` = :id");

		$request->bindParam(':id', $id, PDO::PARAM_INT);
		$request->execute();
	}
}