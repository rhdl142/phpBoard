<?php 
if($_SERVER['REQUEST_METHOD']=='POST' && $_SESSION['id'] != null) {
	print "<script>alert('".$this->data."');</script>";
}
$data = $this->data;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Board Test</title>
		<style>
			
			body{ 
				padding-top:200px;
			}
			
			#tbl,#ctbl {
				width: 1000px;
				margin: 0px auto 20px auto;
				border : 1px solid black;
			}
			
			#commend {
				width : 1000px;
				height : 50px;
				margin: 0px auto 50px;
			}
			
			#commend > form > input[type="text"] {
				width : 800px;
				height : 60px;
			}
			
			#commend > form > input[type="button"] {
				width : 190px;
				height : 50px;
			}
		
			#tbl th {
				border : 1px solid black;
				width: 200px; 
				text-align: center;
				vertical-align: middle;
				background-color: #eee;
			}
			
			#tbl {	
				height: 250px;
			}
			
			#tbl td{
				border : 1px solid black;
				width: 800px;
			}
			
			#btns {
				width: 1000px;
				margin: 0px auto;
			}
			
			#tbl tr:nth-child(4) td {
				height: 250px;
			}
			
			td > input, textarea {
				width : 800px;
			}
			
			#ctbl th {
				border : 1px solid black;
				text-align: center;
				vertical-align: middle;
				background-color: #eee;
			}
			
			#ctbl td {
				border : 1px solid black;
				text-align: center;
				vertical-align: middle;
			}
			
			#ctbl th:nth-child(1) {width:750px;}
			#ctbl th:nth-child(2) {width:250px;}
			
		</style>
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script>

			function getAllList(seq) {
				$.getJSON("/Board/index.php?action=view&seq="+seq,function() {

					console.log(data);
				}
			}
					
			function commendAdd(seq) {
				
				var formData = $("#formData").serialize();
				
				$.ajax({
					url : "/Board/index.php?action=commend&seq="+seq,
					type : "GET",
					data: formData,
					success : function(result) {
						alert(result);
						if(result == '1') {
							
						}
					} 
				}); 
			}
		</script>
	</head>
	<body>
		<?php include 'inc/header.php'?>
		<div id="contents">
			<table id="tbl">
				<tr>
					<th>번호</th>
					<td id="seq">
						<?php echo $data->getSeq(); ?>
					</td>
				</tr>
				<tr>
					<th>이름</th>
					<td>
						<?php echo $data->getM_id(); ?>
					</td>
				</tr>
				<tr>
					<th>제목</th>
					<td>
						<?php echo $data->getTitle(); ?>
					</td>
				</tr>
				<tr>
					<th>내용</th>
					<td>
						<?php echo $data->getContent(); ?>
					</td>
				</tr>
				<tr>
					<th>날짜</th>
					<td>
						<?php echo $data->getRegdate(); ?>
					</td>
				</tr>
			</table>
			
			<table id="ctbl">
				<thead>
					<tr>
						<th>댓글</th>
						<th>아이디</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$addData = $this->addData; 
						if(sizeof($addData) == 0) {
						
						} else {
							foreach ($addData as $aData) {
								echo "<tr>";
								echo "<td>".$aData->getContent()."</td>";
								echo "<td>".$aData->getU_id()."</td>";
								echo "</tr>";
							}
						}
					?>
				</tbody>
			</table>
			
			<div id="commend">
				<form id="formData">
					<input type="text" name="content">
					<input type="button" value="댓글 달기" class="btn" onclick="commendAdd(<?php echo $data->getSeq();?>)">
				</form>
			</div>
			
			<div id="btns">
				<input type="button" value="뒤로 가기" class="btn" onclick="location.href='/Board/index.php?action=list&page=1';">
				<?php 
					if(strcmp($data->getM_id(),$_SESSION['id'])) {
						echo '<input type="button" value="삭제 하기" class="btn" onclick="location.href=\'/Board/index.php?action=delete&seq='.$data->getSeq().'&page='.$this->pages.'\';">';
					}
				?>
			</div>
			
		</div>
	</body>
</html>