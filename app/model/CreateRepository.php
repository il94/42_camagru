<?php

class CreateRepository {
	public ?PDO $database = null;

	public function __construct() {
		$this->database = connectDB();
	}

	/* ==================== ROUTES ==================== */

	public function createPic($picDatas) {
		$request = $this->database->prepare("INSERT INTO `pic` (
			`userId`, `image`
		) VALUES
			(:userId, :image)");
		
		$request->bindParam(':userId', $picDatas->userId, PDO::PARAM_INT);
		$request->bindParam(':image', $picDatas->image, PDO::PARAM_STR);
		$request->execute();
	}

	public function createPics($picsDatas) {
		$request = $this->database->prepare("INSERT INTO `pic` (
			 `userId`, `image`
		) VALUES
			 (:userId, :image)");
		
		foreach ($picsDatas as $picData) {
			 $request->bindParam(':userId', $picData->userId, PDO::PARAM_INT);
			 $request->bindParam(':image', $picData->image, PDO::PARAM_STR);
			 $request->execute();
		}
  }
}