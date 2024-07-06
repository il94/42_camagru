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
			`id`, `userId`, `picId`, `content`
		) VALUES
			(NULL, :userId, :picId, :content);");
		$request->bindParam(':userId', $userId, PDO::PARAM_INT);
		$request->bindParam(':picId', $picId, PDO::PARAM_INT);
		$request->bindParam(':content', $content, PDO::PARAM_STR);
		$request->execute();
	}

	// Recupere les 5 dernieres pics
	public function getLastFivePics() {
		$recPics = $this->database->prepare(
			"SELECT
				pic.*, user.username AS author, user.avatar AS author_avatar
			FROM `pic`
			JOIN user ON pic.userId = user.id
			ORDER BY pic.id DESC
			LIMIT 5
		");
		$recPics->execute();
		$picsDatas = $recPics->fetchAll(PDO::FETCH_OBJ);

		return ($picsDatas);
	}

	// Recupere les 10 derniers comments d'une pic
	public function getLastTenComments($picId) {
		$reqComments = $this->database->prepare(
			"SELECT comment.*, user.username AS author, user.avatar AS author_avatar
			FROM comment
			JOIN user ON comment.userId = user.id
			WHERE picId=$picId
			ORDER BY comment.id DESC
			LIMIT 10
		");
		$reqComments->execute();
		$commentsDatas = $reqComments->fetchAll(PDO::FETCH_OBJ);

		return ($commentsDatas);
	}
}