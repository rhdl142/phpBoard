<?php 
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_SESSION['id'])) {
	print "<script>alert('".$this->alertData."');</script>";
	print "<script>location.href='/Board/index.php?action=list&page=1';</script>";
} 
if(!isset($_SESSION['id'])){
	print "<script>alert('로그인을 먼저 해주세욥');</script>";
	print "<script>location.href='/Board/view/login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Board Test</title>
	<style>
		
		body{ 
			padding-top : 200px;
		}
		
		#tbl {
			border : 1px solid black;
			width : 1000px;
			margin : 0px auto 20px auto;
		}
	
		#tbl th:nth-child(1) {width : 100px;}
		#tbl th:nth-child(2) {width : 580px;}
		#tbl th:nth-child(3) {width : 120px;}
		#tbl th:nth-child(4) {width : 200px;}
	
		#btns {
			width : 1000px;
			margin : 0px auto;
			margin-top : 25px;
		}
		
		#tbl th,#tbl td {
			text-align : center;
			border : 1px solid black;
		}
		
		a {
			text-decoration : none;
			color : #000;
		}
	
		#tbl th {
			background-color : #eee;
		}
		
		#page {
			height : 60px;
			width : 1000px;
			margin : 0px auto;
			text-align : center;
		}
		
		#page > ul {
			list-style : none;
			display : inline-block;
		}
		
		#page > ul > li {
			float : left;
		}
		
		#page > ul > li > a {
			float : left;
			padding : 4px;
			margin-right : 3px;
			width : 40px;
			height : 40px;
			color : #000;
			border : 1px solid gray;
			text-align : center;
			text-decoration : none;
			font-size : 25px;
		}
		
	</style>
	<script>
			$(document).ready(function(){
				
			});
	</script>
	</head>
	<body>
		<?php include 'inc/header.php'?>
		<div id="contents">	
			<table id="tbl" class="table">
				<tr>
					<th>번호</th>
					<th>제목</th>
					<th>글쓴이</th>
					<th>날짜</th>
				</tr>
				 
				<?php
					$pages = $this->pages;
					$data = $this->data;
					
					if(sizeof($data) == 0) {
						echo '<tr>';
						echo '<td colspan="4">현재 게시물이 없습니다.</td>';
						echo '</tr>';
					} else {
						foreach ($data as $list) {
							echo '<tr>';
							echo '<td>'.$list->getSeq().'</td>';
							echo "<td><a href='/Board/index.php?action=view&seq=".$list->getSeq()."&page=".$pages."'>".$list->getTitle()."</a></td>";
							echo '<td>'.$list->getM_id().'</td>';
							echo '<td>'.substr($list->getRegdate(),0,10).'</td>';
							echo '</tr>';
						}
					}
				
				?>
				
			</table>
			
			<div id="page">
				<ul>
					<?php 
						for ($i=0; $i<=$this->pages/5; $i++) {
							echo "<li><a href='/Board/index.php?action=list&page=".($i+1)."'>".($i+1)."</a></li>"; 
						}
					?>
				</ul>
			</div>
			<div style="claer:both;"></div>
			<div id="btns">
				<input type="button" value="쓰기" class="btn" onclick="location.href='/Board/view/add.php';">
				<input type="button" value="로그아웃" class="btn" onclick="location.href='/Board/index.php?action=logout';">
			</div>
		</div>
	</body>
</html>















