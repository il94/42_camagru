<?php

class AuthRepository {
	public ?PDO $database = null;

	public function __construct() {
		$this->database = connectDB();
	}

	// Crée un user
	public function createUser($userDatas) {
		$request = $this->database->prepare("INSERT INTO `user` (
			`email`, `username`, `password`, `avatar`, `role`, `activation_token`, `active`
		) VALUES
			(:email, :username, :password, :avatar, :role, :activation_token, :active)");
		
		$request->bindParam(':email', $userDatas['email'], PDO::PARAM_STR);
		$request->bindParam(':username', $userDatas['username'], PDO::PARAM_STR);
		$request->bindParam(':password', $userDatas['password'], PDO::PARAM_STR);
		$request->bindParam(':avatar', $userDatas['avatar'], PDO::PARAM_STR);
  		$request->bindParam(':role', $userDatas['role'], PDO::PARAM_STR);
  		$request->bindParam(':activation_token', $userDatas['activation_token'], PDO::PARAM_STR);
  		$request->bindParam(':active', $userDatas['active'], PDO::PARAM_BOOL);
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

	// Cherche un user par son token d'activation
	public function findUserByActivationToken($token) {
		$request = $this->database->prepare("SELECT * FROM user WHERE activation_token=:activation_token");
		$request->bindParam(':activation_token', $token, PDO::PARAM_STR);
		$request->execute();

		$userDatas = $request->fetch(PDO::FETCH_OBJ);
		return ($userDatas);
	}

	// Active un utilisateur
	public function activateUser($id) {
		$request = $this->database->prepare("UPDATE user SET active = TRUE WHERE id=:id");
		$request->bindParam(':id', $id, PDO::PARAM_INT);
		$request->execute();
	}
}