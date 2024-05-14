<?php

require("User.php");

class Pic {
	public int		$id;
	public User		$user;
	public string	$url;
	public int		$likes;
	public int		$commentsCount;
	// public array	$comments;

	public function __construct() {
		$this->id = 0;
        $this->user = new User();
        $this->url = "";
        $this->likes = 0;
        $this->commentsCount = 0;
        // $this->comments = [new Comment()];
	}

	public static function withParams($id, $username, $avatar, $url, $likes, $commentsCount) {
		$pic = new self();
		$pic->id = $id;
		$pic->user->username = $username;
		$pic->user->avatar = $avatar;
        $pic->url = $url;
        $pic->likes = $likes;
        $pic->commentsCount = $commentsCount;

		return ($pic);
	}
}
