<?php

class AuthRepository {
	public ?PDO $database = null;

	public function __construct() {
		$this->database = connectDB();
	}

	// Crée un user
	public function createUser($userDatas) {
		$request = $this->database->prepare("INSERT INTO `user` (
			`email`, `username`, `password`, `avatar`, `role`, `activation_token`, `active`, `reset_password_token`
		) VALUES
			(:email, :username, :password, :avatar, :role, :activation_token, :active, :reset_password_token)");
		
		$request->bindParam(':email', $userDatas->email, PDO::PARAM_STR);
		$request->bindParam(':username', $userDatas->username, PDO::PARAM_STR);
		$request->bindParam(':password', $userDatas->password, PDO::PARAM_STR);
		$request->bindParam(':avatar', $userDatas->avatar, PDO::PARAM_STR);
  		$request->bindParam(':role', $userDatas->role, PDO::PARAM_STR);
  		$request->bindParam(':activation_token', $userDatas->activation_token, PDO::PARAM_STR);
  		$request->bindParam(':active', $userDatas->active, PDO::PARAM_BOOL);
  		$request->bindParam(':reset_password_token', $userDatas->reset_password_token, PDO::PARAM_STR);
		$request->execute();
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

	// Cherche un user par son token de reinitialization de mot de passe
	public function findUserByResetPasswordToken($token) {
		$request = $this->database->prepare("SELECT * FROM user WHERE reset_password_token=:reset_password_token");
		$request->bindParam(':reset_password_token', $token, PDO::PARAM_STR);
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

	// Update le password d'un user
	public function updateUserPassword($userDatas) {
		$request = $this->database->prepare("UPDATE user SET password = :password WHERE id=:id");
		$request->bindParam(':id', $userDatas->id, PDO::PARAM_INT);
		$request->bindParam(':password', $userDatas->password, PDO::PARAM_STR);
		$request->execute();
	}

	// Update le active d'un user
	public function updateUserActive($userDatas) {
		$request = $this->database->prepare("UPDATE user SET active = :active WHERE id=:id");
		$request->bindParam(':id', $userDatas->id, PDO::PARAM_INT);
		$request->bindParam(':active', $userDatas->active, PDO::PARAM_BOOL);
		$request->execute();
	}
}