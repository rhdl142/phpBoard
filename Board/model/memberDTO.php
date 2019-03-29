<?php
class Member {
	private $id;
	private $pw;
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setPw($pw) {
		$this->pw = $pw;
	}
	
	public function getPw() {
		return $this->pw;
	}
}