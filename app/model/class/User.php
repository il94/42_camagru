<?php

class User {
	public int		$id;
	public string	$username;
	public string	$avatar;

	public function __construct() {
		$this->id = 0;
        $this->username = "";
        $this->avatar = "";
	}

	public static function withParams($id, $username, $avatar) {
		$user = new self();
		$user->id = $id;
		$user->username = $username;
        $user->avatar = $avatar;

		return ($user);
	}
}
