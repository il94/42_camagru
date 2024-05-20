<?php

class HomeService {
	public HomeRepository $repository;

	public function __construct() {
		$this->repository = new HomeRepository();
	}

	// Retourne les 5 dernieres pics
	public function getLastFivePics() {
	
		$picDatas = $this->repository->getLastFivePics();
	
		$pics = [];
		foreach ($picDatas as $picData) {
			$user = User::withParams(
				$picData->userId,
				$picData->author,
				$picData->author_avatar
			);

			$comments = $this->getLastTenComments($picData->id);

			$pic = Pic::withParams(
				$picData->id,
				$picData->image,
				$picData->likesCount,
				$user,
				$comments
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