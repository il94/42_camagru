<?php

require_once("lib/HttpException.php");

class AuthService {
	public AuthRepository $repository;

	// CONSTANTES
	const MAX_USERNAMENAME_LENGTH = 20;
	const MIN_PASSWORD_LENGTH = 8;

	const LOGIN_ERROR = "LOGIN";
	const USERNAME_ERROR = "USERNAME";
	const EMAIL_ERROR = "EMAIL";
	const PASSWORD_ERROR = "PASSWORD";
	const RETYPE_PASSWORD_ERROR = "RETYPE_PASSWORD";

	public function __construct() {
		$this->repository = new AuthRepository();
	}

	// Connecte un compte
	public function login($login, $password) {
		$this->parseLogin($login);
		$this->parsePassword($password, null);

		if (filter_var($login, FILTER_VALIDATE_EMAIL))
			$userDatas = $this->repository->findUserByEmail($login);
		else
			$userDatas = $this->repository->findUserByUsername($login);

		if (empty($userDatas))
			throw new HttpException("Incorrect password", 403, self::PASSWORD_ERROR);

		if (!password_verify($password, $userDatas->password))
			throw new HttpException("Incorrect password", 403, self::PASSWORD_ERROR);

		$_SESSION['logged_in'] = true;
	}

	// Crée un compte
	public function signup($email, $username, $password, $reTypePassword) {
		$this->parseEmail($email);
		$this->parseUsername($username);
		$this->parsePassword($password, $reTypePassword);

		$userFound = !!$this->repository->findUserByUsername($username);
		if ($userFound)
			throw new HttpException("Username already taken", 403, self::USERNAME_ERROR);

		$this->repository->createUser($email, $username, password_hash($password, PASSWORD_DEFAULT));

		$_SESSION['logged_in'] = true;
	}

	// Déconnecte un compte
	public function logout() {
		session_destroy();
	}

	// Verifie si la string est un email valide
	private function parseLogin($login) {
		if (empty($login))
			throw new HttpException("Email or username is required", 400, self::LOGIN_ERROR);
	}

	// Verifie si la string est un email valide
	private function parseEmail($email) {
		if (empty($email))
			throw new HttpException("Email is required", 400, self::EMAIL_ERROR);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			throw new HttpException("Invalid email format", 422, self::EMAIL_ERROR);
	}

	// Verifie si la string est un username valide
	private function parseUsername($username) {
		if (empty($username))
			throw new HttpException("Username is required", 400, self::USERNAME_ERROR);
		if (strlen($username) > self::MAX_USERNAMENAME_LENGTH)
			throw new HttpException("Username exceeds maximum length of " . self::USERNAME_ERROR . " characters", 422, self::USERNAME_ERROR);
	}

	// Verifie si la string est un password valide
	private function parsePassword($password, $reTypePassword) {
		if (empty($password))
			throw new HttpException("Password is required", 400, self::PASSWORD_ERROR);
		if ($reTypePassword) {
			if (strlen($password) < self::MIN_PASSWORD_LENGTH)
				throw new HttpException("Password must be at least " . self::MIN_PASSWORD_LENGTH . " characters long", 422, self::PASSWORD_ERROR);
			if (!preg_match("/[A-Z]/", $password))
				throw new HttpException("Password must contain at least one uppercase letter", 422, self::PASSWORD_ERROR);
			if (!preg_match("/[a-z]/", $password))
				throw new HttpException("Password must contain at least one lowercase letter", 422, self::PASSWORD_ERROR);
			if (!preg_match("/[0-9]/", $password))
				throw new HttpException("Password must contain at least one digit", 422, self::PASSWORD_ERROR);
			if (!preg_match("/[\W_]/", $password))
				throw new HttpException("Password must contain at least one special character", 422, self::PASSWORD_ERROR);
		}
	}
}