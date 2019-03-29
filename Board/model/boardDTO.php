<?php
class Board {
	private $seq;
	private $title;
	private $content;
	private $regdate;
	private $m_id;
	
	public function setSeq($seq) {
		$this->seq = $seq;
	}
	
	public function getSeq() {
		return $this->seq;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setContent($content) {
		$this->content = $content;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function setRegdate($regdate) {
		$this->regdate = $regdate;
	}
	
	public function getRegdate() {
		return $this->regdate;
	}
	
	public function setM_id($m_id) {
		$this->m_id = $m_id;
	}
	
	public function getM_id() {
		return $this->m_id;
	}
}