<?php
require_once 'service/service.php';

class Controller {
	private $service;
	private $action;
	private $data;
	private $addData;
	private $alertData;
	private $view;
	private $pages;
	
	public function __construct() {
		$this->service = new Service();
	}
	
	/**
	 * 로그인 체크
	 * @param unknown $id 사용자가 입력한 아이디
	 * @param unknown $pw 사용자가 입력한 비밀번호
	 */
	public function loginCheck($id, $pw) {
		$cnt = $this->service->loginCheck($id,$pw);
		
		if($cnt==1) {
			$this->alertData = '없는 아이디 입니당';
		} else if($cnt==2) {
			$this->alertData = '로그인 성공';
		} else {
			$this->alertData = '비밀번호가 틀렸습니당';
		}
		
		require 'view/login.php';
	}
	
	/**
	 * 게시글 전체
	 */
	public function listBoard($page) {
		$this->data=$this->service->listBoard($page);
		$this->pages = $this->service->listBoardSize();
		require 'view/list.php';
	}
	
	/**
	 * 게시글 추가
	 * @param unknown $title 제목
	 * @param unknown $content 내용
	 */
	public function addBoard($title, $content) {
		$cnt = $this->service->addBoard($title,$content);
		
		if($cnt==1) {
			$this->alertData = '작성 완료';
			$this->listBoard();
		} else {
			$this->alertData = '작성 실패';
			$this->listBoard();
		}
	}
	
	/**
	 * view 한개 보여지기
	 * @param unknown $seq 게시글 고유번호
	 */
	public function boardView($seq,$page) {
		$this->data = $this->service->boardView($seq);
		$this->addData = $this->service->boardCommendView($seq);
		$this->pages = ($page-1)/5;
		require 'view/view.php';
	}
	
	/**
	 * 로그아웃
	 */
	public function logout() {
		$this->service->logout();
		require 'view/login.php';
	}
	
	/**
	 * 삭제
	 */
	public function delete($seq,$page) {
		$cnt = $this->service->delete($seq);
		if($cnt==1) {
			$this->alertData = '삭제 완료';
		} else {
			$this->alertData = '삭제 에러';
		}
		$this->listBoard(($page-1)/5);
	}
	
	/**
	 * 댓글쓰기
	 */
	public function commend($seq,$content){
		return $this->service->commend($seq,$content);
	}
	
	/**
	 * 댓글
	 */
	public function commendView($seq,$content){
		$result = $this->service->boardCommendView($seq);
	}
}








