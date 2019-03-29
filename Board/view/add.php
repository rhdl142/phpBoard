<?php 
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
			
			#tbl {
				width: 1000px;
				margin: 0px auto 20px auto;
				border : 1px solid black;
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
			
			#tbl tr:nth-child(3) td {
				height: 250px;
			}
			
			td > input, textarea {
				width : 800px;
			}
			
		</style>
		<script>
		
		</script>
	</head>
	<body>
		<?php include '../inc/header.php'?>
		<div id="contents">
			<form action="/Board/index.php?action=add" method="post">
				<table id="tbl">
					<tr>
						<th>이름</th>
						<td>
							<?php echo $_SESSION['id'] ?>
						</td>
					</tr>
					<tr>
						<th>제목</th>
						<td>
							<input type="text" name="title" required id="title" />
						</td>
					</tr>
					<tr>
						<th>내용</th>
						<td><textarea name="content" id="content" rows="12" required></textarea></td>
					</tr>
				</table>
				
				<div id="btns">
					<input type="submit" value="작성 완료" class="btn">
					<input type="button" value="뒤로 가기" class="btn"onclick="history.back();">
				</div>
			</form>

		</div>
	</body>
</html>