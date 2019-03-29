<?php
require_once 'model/dao.php';

class Service {
	private $dao;
	
	public function __construct() {
		$this->dao = new Dao();
	}
	
	/**
	 * login Check service
	 * @param unknown $id 아이디
	 * @param unknown $pw 패스워드
	 * 
	 * @return 
	 * 			1->아이디 없음 
	 * 			2->성공 
	 * 			3->패스워드 없음
	 */
	public function loginCheck($id, $pw) {
		$m = $this->dao->loginCheck($id,$pw);
		
		if($m==null) {
			return 1;
		} else {
			if($m->getPw()==$pw) {
				$_SESSION['id']=$id;
				return 2;
			} else {
				return 3;
			}
		}
	}
	
	/**
	 * list 가져오기
	 */
	public function listBoard($page) {
		$lastPage = 5 * $page;
		$firstPage = (int)$lastPage -4;
		return $this->dao->listBoard($firstPage, $lastPage);
	}
	
	/**
	 * list size 가져오기
	 */ 
	 public function listBoardSize() {
	 	return $this->dao->listBoardSize();
	 }
	 
	/**
	 * 글쓰기
	 * @param unknown $title 제목
	 * @param unknown $content 내용
	 */
	public function addBoard($title,$content) {
		return $this->dao->addBoard($title,$content);
	}
	
	/**
	 * 게시글 상세 보기
	 * @param unknown $seq 게시글 고유 번호
	 */
	public function boardView($seq) {
		return $this->dao->boardView($seq);
	}
	
	/**
	 * 게시글 댓글 상세 보기 댓글
	 * @param unknown $seq 게시글 고유 번호
	 */
	public function boardCommendView($seq) {
		return $this->dao->boardCommendView($seq);
	}
	
	/**
	 * 로그아웃
	 */
	public function logout() {
		session_unset();
		session_destroy();
	}
	
	/**
	 * 삭제
	 */
	public function delete($seq) {
		return $this->dao->delete($seq);
	}
	
	/**
	 * 댓글 추가
	 */
	public function commend($seq,$content) {
		return $this->dao->commend($seq,$content);
	}
}













