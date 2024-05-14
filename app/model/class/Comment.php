<?php

require("User.php");

class Comment {
	public int		$id;
	public User		$user;
	public string	$content;

	public function __construct() {
		$this->id = 0;
        $this->user = new User();
        $this->content = "";
	}

	public static function withParams($id, $username, $avatar, $content) {
		$comment = new self();
		$comment->id = $id;
		$comment->user->username = $username;
		$comment->user->avatar = $avatar;
        $comment->content = $content;

		return ($comment);
	}
	
}
