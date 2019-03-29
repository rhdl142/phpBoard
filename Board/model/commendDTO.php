<?php
class Commend {
	private $seq;
	private $content;
	private $b_num;
	private $u_id;

	public function setSeq($seq) {
		$this->seq = $seq;
	}

	public function getSeq() {
		return $this->seq;
	}
	
	public function setContent($content) {
		$this->content = $content;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function setB_num($b_num) {
		$this->b_num = $b_num;
	}
	
	public function getB_num() {
		return $this->b_num;
	}
	
	public function setU_id($u_id) {
		$this->u_id = $u_id;
	}
	
	public function getU_id() {
		return $this->u_id;
	}
}