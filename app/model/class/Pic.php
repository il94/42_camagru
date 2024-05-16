<?php

class Pic {
	public int		$id;
	public string	$image;
	public int		$likesCount;
	public User		$user;
	public array	$comments;
	public int		$commentsCount;

	public function __construct() {
		$this->id = -1;
        $this->image = "";
        $this->likesCount = 0;
        $this->user = new User();
        $this->comments = [];
        $this->commentsCount = 0;
	}

	public static function withParams($id, $image, $likesCount, $user, $comments) {
		$pic = new self();
		$pic->id = $id;
        $pic->image = $image;
        $pic->likesCount = $likesCount;
		$pic->user = $user;
		$pic->comments = $comments;
        $pic->commentsCount = sizeof($comments);

		return ($pic);
	}

	public function addComment($comment) {
		$this->comments[] = $comment;
		$this->commentsCount++;
	}
}
