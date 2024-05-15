<?php

class Pic {
	public int		$id;
	public string	$image;
	public int		$likes;
	public int		$commentsCount;
	public array	$comments;
	public User		$user;

	public function __construct() {
		$this->id = -1;
        $this->image = "";
        $this->likes = 0;
        $this->commentsCount = 0;
        $this->comments = [];
        $this->user = new User();
	}

	public static function withParams($id, $image, $user) {
		$pic = new self();
		$pic->id = $id;
        $pic->image = $image;
		$pic->user = $user;

		return ($pic);
	}

	public function addComment($comment) {
		$this->comments[] = $comment;
		$this->commentsCount++;
	}
}
