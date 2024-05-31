<?php

class AuthRepository {
	public ?PDO $database = null;

	public function __construct() {
		$this->database = connectDB();
	}

	public function createUser($email, $username, $password) {
		$request = $this->database->prepare("INSERT INTO `user` (
			`email`, `username`, `password`, `avatar`, `role`
		) VALUES
			(:email, :username, :password, :avatar, :role)");
		
		$avatar = DEFAULT_AVATAR;
		$role = DEFAULT_ROLE;

		$request->bindParam(':email', $email, PDO::PARAM_STR);
		$request->bindParam(':username', $username, PDO::PARAM_STR);
		$request->bindParam(':password', $password, PDO::PARAM_STR);
		$request->bindParam(':avatar', $avatar, PDO::PARAM_STR);
  		$request->bindParam(':role', $role, PDO::PARAM_STR);
		$request->execute();
	}

	// Cherche un user par son username
	public function findUserByUsername($username) {
		$request = $this->database->prepare("SELECT id, username, avatar, role FROM user WHERE username=:username");
		$request->bindParam(':username', $username, PDO::PARAM_STR);
		$request->execute();

		$userDatas = $request->fetchAll(PDO::FETCH_OBJ);
		return ($userDatas);
	}
}