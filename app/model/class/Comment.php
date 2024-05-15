<?php

class Comment {
	public int		$id;
	public string	$content;
	public User		$user;

	public function __construct() {
		$this->id = -1;
        $this->content = "";
        $this->user = new User();
	}

	public static function withParams($id, $content, $user) {
		$comment = new self();
		$comment->id = $id;
        $comment->content = $content;
		$comment->user = $user;

		return ($comment);
	}
}
