<?php 
if($_SERVER['REQUEST_METHOD']=='POST') {
	print "<script>alert('".$this->alertData."');</script>";
	if(!strcmp($this->alertData,'로그인 성공')) {
		print "<script>location.href='/Board/index.php?action=list&page=1';</script>";
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Board Login</title>
		<style>
			
			body{ 
				padding-top:200px;
			}
			
			#tbl {
				border : 1px solid black;
				width: 500px;
				margin:0px auto 20px auto;
			}
		
			#btns {
				width: 200px;
				margin:0px auto;
			}
			
			#btns > .btn {
				width : 200px;
				height : 50px;
			}
			
			#tbl th,#tbl td {
				border : 1px solid black;
				height : 50px;
			}
		
			#tbl th {
				background-color: #eee;
				width : 380px;
			}
			
			tr > td > input {
				width : 350px;
				height : 50px;
			}
			
		</style>
		<script>
		
		</script>
	</head>
	<body>	
		<header style="border:1px solid black; width:1000px; height:250px; background-color:#eee; margin-bottom:25px; margin: 0px auto 20px auto;">
			<div style="font-size:70px; text-align:center; text-shadow:2px 2px 2px gray; margin-top:70px;">PHP Boarder</div>	
		</header>
		<div id="contents">
			<form action="/Board/index.php?action=login" method="post">
				<table id="tbl" class="table">
					<tr>
						<th>아이디</th>
						<td><input type="text" name="id" required id="id" /></td>
					</tr>
					<tr>
						<th>비밀번호</th>
						<td><input type="text" name="pw" required id="pw" /></td>
					</tr>
				</table>
			
				<div id="btns">
					<input type="submit" value="로그인" class="btn">
				</div>
			</form>
		
		</div>
	</body>
</html>