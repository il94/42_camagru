<?php

class HomeRepository {
	public ?PDO $database = null;

	public function __construct() {
		$this->database = connectDB();
	}

	/* ==================== ROUTES ==================== */

	// Cree un comment
	public function createComment($userId, $picId, $content) {
		$request = $this->database->prepare("INSERT INTO `comment` (
			`userId`, `picId`, `content`
		) VALUES
			(:userId, :picId, :content);");

		$request->bindParam(':userId', $userId, PDO::PARAM_INT);
		$request->bindParam(':picId', $picId, PDO::PARAM_INT);
		$request->bindParam(':content', $content, PDO::PARAM_STR);
		$request->execute();
	}

	// Like une pic
	function likePic($userId, $picId) {
		$request = $this->database->prepare("INSERT INTO `dbcamagru`.`user_pic_likes` (
			`userId`, `picId`
		) VALUES
			(:userId, :picId)");

		$request->bindParam(':userId', $userId, PDO::PARAM_INT);
		$request->bindParam(':picId', $picId, PDO::PARAM_INT);
		$request->execute();
	}

	// Unlike une pic
	function unlikePic($userId, $picId) {
		$request = $this->database->prepare("DELETE FROM `dbcamagru`.`user_pic_likes`
			WHERE `userId` = :userId 
			AND `picId` = :picId");

		$request->bindParam(':userId', $userId, PDO::PARAM_INT);
		$request->bindParam(':picId', $picId, PDO::PARAM_INT);
		$request->execute();
	}

	// Verifie si un user a like une pic
	public function hasLikedPic($userId, $picId): bool {
		$request = $this->database->prepare("SELECT * FROM `dbcamagru`.`user_pic_likes`
			WHERE `userId` = :userId
			AND `picId` = :picId");
		
		$request->bindParam(':userId', $userId, PDO::PARAM_INT);
		$request->bindParam(':picId', $picId, PDO::PARAM_INT);
		$request->execute();
		
		$result = !!$request->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	// Compte le nombre de commentaires d'une pic
	public function getCountComments($picId) {
		$request = $this->database->prepare(
			"SELECT COUNT(*) as comment_count
			FROM comment
			WHERE picId = :picId"
		);

		$request->bindParam(':picId', $picId, PDO::PARAM_INT);
		$request->execute();
		$result = $request->fetch(PDO::FETCH_OBJ);

		return $result->comment_count;
	}

	// Compte le nombre de likes d'une pic
	public function getCountLikes($picId) {
		$request = $this->database->prepare(
			"SELECT COUNT(*) as like_count
			FROM user_pic_likes
			WHERE picId = :picId"
		);

		$request->bindParam(':picId', $picId, PDO::PARAM_INT);
		$request->execute();
		$result = $request->fetch(PDO::FETCH_OBJ);

		return $result->like_count;
	}

	// Recupere 5 pics à partir d'un cursor
	public function getPicsWithCursor($cursor) {
		$request = $this->database->prepare(
			"SELECT
				pic.*, user.username AS author, user.avatar AS author_avatar
			FROM `pic`
			JOIN user ON pic.userId = user.id
			WHERE pic.id < :cursor
			ORDER BY pic.id DESC
			LIMIT 5
		");

		$request->bindParam(':cursor', $cursor, PDO::PARAM_INT);
		$request->execute();
		$picsDatas = $request->fetchAll(PDO::FETCH_OBJ);

		return ($picsDatas);
	}

	// Recupere les 5 dernieres pics
	public function getLastFivePics() {
		$request = $this->database->prepare(
			"SELECT
				pic.*, user.username AS author, user.avatar AS author_avatar
			FROM `pic`
			JOIN user ON pic.userId = user.id
			ORDER BY pic.id DESC
			LIMIT 5
		");
		$request->execute();
		$picsDatas = $request->fetchAll(PDO::FETCH_OBJ);

		return ($picsDatas);
	}

	// Recupere 10 comments à partir d'un cursor
	public function getCommentsWithCursor($picId, $cursor) {
		$request = $this->database->prepare(
			"SELECT comment.*, user.username AS author, user.avatar AS author_avatar
			FROM comment
			JOIN user ON comment.userId = user.id
			WHERE picId = :picId
			AND comment.id < :cursor
			ORDER BY comment.id DESC
			LIMIT 10
		");

		$request->bindParam(':picId', $picId, PDO::PARAM_INT);
		$request->bindParam(':cursor', $cursor, PDO::PARAM_INT);
		$request->execute();
		$commentsDatas = $request->fetchAll(PDO::FETCH_OBJ);

		return ($commentsDatas);
	}

	// Recupere les 20 derniers comments d'une pic
	public function getLastTwentyComments($picId) {
		$request = $this->database->prepare(
			"SELECT comment.*, user.username AS author, user.avatar AS author_avatar
			FROM comment
			JOIN user ON comment.userId = user.id
			WHERE picId = :picId
			ORDER BY comment.id DESC
			LIMIT 20
		");

		$request->bindParam(':picId', $picId, PDO::PARAM_INT);
		$request->execute();
		$commentsDatas = $request->fetchAll(PDO::FETCH_OBJ);

		return ($commentsDatas);
	}

	// Cherche une pic par son id
	public function findPicById($id) {
		$request = $this->database->prepare("SELECT * FROM pic WHERE id=:id");
		$request->bindParam(':id', $id, PDO::PARAM_INT);
		$request->execute();

		$picDatas = $request->fetch(PDO::FETCH_OBJ);
		return ($picDatas);
	}

}