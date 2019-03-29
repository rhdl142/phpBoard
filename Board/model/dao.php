<?php
require_once 'memberDTO.php';
require_once 'boardDTO.php';
require_once 'commendDTO.php';

class Dao {
	private $conn = null;
	private $dsn = 'mysql:host=localhost;dbname=phpdb';
	private $userid = 'root';
	private $passwd = 'autoset';
	
	/**
	 * db connect
	 */
	public function connect() {
		try {
			$this->conn = new PDO($this->dsn,$this->userid,$this->passwd);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		} catch (PDOException $e) {
			print $e->getMessage();
		}
	}
	
	/**
	 * db disconnect
	 */
	public function disconnect() {
		$this->conn = null;
	}
	
	/**
	 * id pw check
	 * @param unknown $id 아이디
	 * @return NULL|Member|NULL 멤버 dto
	 */
	public function loginCheck($id) {
		
		$m = null;
		
		$this->connect();
		
		try {
			
			$sql = 'SELECT * FROM member WHERE id = ?';
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(1, $id);
			$stmt->execute();
			$cnt = $stmt->rowCount();
			
			if($cnt > 0) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$m = new Member();
				$m->setId($row['id']);
				$m->setPw($row['pw']);
			}
			return $m;
		} catch (PDOException $e) {
			print $e->getMessage();
		} finally {
			$this->disconnect();
		}
		
		return null;
	}
	
	/**
	 * 게시글 list페이지
	 */
	public function listBoard($firstPage, $lastPage) {
		
		$arr = array();
		$this->connect();
		
		try {
			$sql = 'SELECT
						A.*
					FROM
					(
					    SELECT
					        @ROWNUM := @ROWNUM + 1 AS ROWNUM,
					        b.* 
					    FROM
					        board b,
					        (SELECT @ROWNUM := 0) R
					) A
					WHERE
						A.ROWNUM BETWEEN ? AND ?';
			
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(1, $firstPage);
			$stmt->bindValue(2, $lastPage);
			$stmt->execute();
			
			$cnt = $stmt->rowCount();
			
			if($cnt > 0) {
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$b = new Board();
					$b->setSeq($row['seq']);
					$b->setTitle($row['title']);
					$b->setContent($row['content']);
					$b->setRegdate($row['regdate']);
					$b->setM_id($row['m_id']);
					
					$arr[] = $b;
				}
				
				return $arr;
			}
		} catch (PDOException $e) {
			print $e->getMessage();
		} finally {
			$this->disconnect();
		}
		
		return null;
	} 
	
	/**
	 * 게시글 list페이지
	 */
	public function listBoardSize() {
	
		$arr = array();
		$this->connect();
	
		try {
			$sql = 'SELECT * FROM board';
				
			$stmt = $this->conn->query($sql);
			$stmt->execute();
				
			return $stmt->rowCount();
		} catch (PDOException $e) {
			print $e->getMessage();
		} finally {
			$this->disconnect();
		}	
		return null;
	}
	
	/**
	 * 글쓰기
	 * @param unknown $title 제목
	 * @param unknown $content 내용
	 */
	public function addBoard($title,$content) {
		
		$this->connect();
		
		try {
			$sql = 'INSERT INTO board (title, content, m_id) VALUES(?,?,?)';
			$stmt = $this->conn->prepare($sql);
			
			$stmt->bindValue(1, $title);
			$stmt->bindValue(2, $content);
			$stmt->bindValue(3, $_SESSION['id']);
			
			return $stmt->execute();
		} catch (PDOException $e) {
			print $e->getMessage();
		} finally {
			$this->disconnect();
		}
		
		return null;
	}
	
	/**
	 * 게시글 상세보기
	 * @param unknown $seq 게시글 고유번호
	 */
	public function boardView($seq) {
		
		$b = new Board();
		$this->connect();
		
		try {
			$sql = 'SELECT * FROM board WHERE seq = ?';
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(1, $seq);
			$stmt->execute();
			$cnt = $stmt->rowCount();
			
			if($cnt > 0) {
				if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$b->setSeq($row['seq']);
					$b->setTitle($row['title']);
					$b->setContent($row['content']);
					$b->setRegdate($row['regdate']);
					$b->setM_id($row['m_id']);
				}
				
				return $b;
			}
		} catch (PDOException $e) {
			print $e->getMessage();
		} finally {
			$this->disconnect();
		}
		
		return null;
	}
	
	/**
	 * 게시글 상세보기 댓글
	 * @param unknown $seq 게시글 고유번호
	 */
	public function boardCommendView($seq) {
		
		$arr = array();
		$this->connect();
	
		try {
			$sql = 'SELECT * FROM commend WHERE b_num = ?';
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(1, $seq);
			$stmt->execute();
			$cnt = $stmt->rowCount();
				
			if($cnt > 0) {
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$c = new Commend();
					$c->setSeq($row['seq']);
					$c->setContent($row['content']);
					$c->setB_num($row['b_num']);
					$c->setU_id($row['u_id']);
					
					$arr[] = $c;
				}
	
				return $arr;
			}
		} catch (PDOException $e) {
			print $e->getMessage();
		} finally {
			$this->disconnect();
		}
	
		return null;
	}
	
	/**
	 * 게시글 삭제
	 */
	public function delete($seq) {

		$this->connect();
		
		try {
			
			$this->conn->beginTransaction();
			
			$sql = 'DELETE FROM commend WHERE b_num = ?';
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(1, $seq);
			$stmt->execute();
			
			$sql = 'DELETE FROM board WHERE seq = ?';
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(1, $seq);
			$stmt->execute();
			
			$this->conn->commit();
			
			return 1;
		} catch (PDOException $e) {
			print $e->getMessage();
			$this->conn->rollBack();
		} finally {
			$this->disconnect();
		}
		
		return 0;
	}
	
	/**
	 * 댓글 추가
	 */
	public function commend($seq, $content) {
		
		$this->connect();
		
		try {
		
			$sql = 'INSERT INTO commend (content,b_num,u_id) values (?,?,?)';
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(1, $content);
			$stmt->bindValue(2, $seq);
			$stmt->bindValue(3, $_SESSION['id']);
			$stmt->execute();
				
			return 1;
		} catch (PDOException $e) {
			print $e->getMessage();
		} finally {
			$this->disconnect();
		}
		
		return 0;
	}
}












