<?php

class SettingsService {
	public SettingsRepository $repository;

	public function __construct() {
		$this->repository = new SettingsRepository();
	}

}