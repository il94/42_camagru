<?php

class Pic {
	public int		$id;
	public string	$image;
	public int		$likesCount;
	public bool		$liked;
	public User		$user;
	public array	$comments;
	public int		$commentsCount;

	public function __construct() {
		$this->id = -1;
        $this->image = "";
        $this->likesCount = 0;
        $this->liked = false;
        $this->user = new User();
        $this->comments = [];
        $this->commentsCount = 0;
	}

	public static function withParams($id, $image, $likesCount, $liked, $user, $comments, $commentsCount) {
		$pic = new self();
		$pic->id = $id;
        $pic->image = $image;
        $pic->likesCount = $likesCount;
        $pic->liked = $liked;
		$pic->user = $user;
		$pic->comments = $comments;
        $pic->commentsCount = $commentsCount;

		return ($pic);
	}
}
