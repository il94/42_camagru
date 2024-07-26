<?php

class HomeService {
	public HomeRepository $repository;
	public AuthService $authService;

	public function __construct() {
		$this->repository = new HomeRepository();
		$this->authService = new AuthService();
	}

	public function createComment($userId, $picId, $content) {
		$this->repository->createComment($userId, $picId, htmlspecialchars($content));
	}

	public function likePic($userId, $picId): int {
		if ($this->repository->hasLikedPic($userId, $picId)) {
			$this->repository->unlikePic($userId, $picId);
			return (200);
		}
		else {
			$this->repository->likePic($userId, $picId);
			return (201);
		}
	}

	// Verifie si un user a like une pic
	public function hasLikedPic($userId, $picId) {
		return $this->repository->hasLikedPic($userId, $picId);
	}

	// Retounr le nombre de commentaires d'une pic
	public function getCountComments($picId) {
		return $this->repository->getCountComments($picId);
	}

	// Retounr le nombre de likes d'une pic
	public function getCountLikes($picId) {
		return $this->repository->getCountLikes($picId);
	}

	// Retourne les 5 dernieres pics
	public function getLastFivePics($userId) {
	
		$picDatas = $this->repository->getLastFivePics();
	
		$pics = [];
		foreach ($picDatas as $picData) {
			$user = User::withParams(
				$picData->userId,
				$picData->author,
				$picData->author_avatar
			);

			$picData->likesCount = $this->getCountLikes($picData->id);
			$picData->liked = !!$this->hasLikedPic($userId, $picData->id);
			$picData->commentsCount = $this->getCountComments($picData->id);
			$comments = $this->getLastTenComments($picData->id);

			$pic = Pic::withParams(
				$picData->id,
				$picData->image,
				$picData->likesCount,
				$picData->liked,
				$user,
				$comments,
				$picData->commentsCount,
			);

			$pics[] = $pic;
		}
	
		return ($pics);
	}

	// Retourne les 10 derniers comments d'une pic
	public function getLastTenComments($picId) {
		$commentsDatas = $this->repository->getLastTenComments($picId);

		$comments = [];
		foreach ($commentsDatas as $commentData) {

			$user = User::withParams(
				$commentData->userId,
				$commentData->author,
				$commentData->author_avatar
			);

			$comments[] = Comment::withParams(
				$commentData->id,
				$commentData->content,
				$user
			);
		}

		return ($comments);
	}
}