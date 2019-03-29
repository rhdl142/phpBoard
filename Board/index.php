<?php
require_once 'controller/controller.php';

$controller = new Controller();
switch ($_GET['action']) {
	case "login":
		$id = $_POST['id'];
		$pw = $_POST['pw'];
		$controller->loginCheck($id, $pw);
		break;
	case "add":
		$title = $_POST['title'];
		$content = $_POST['content'];
		$controller->addBoard($title, $content);
		break;
	case "view":
		$seq = $_GET['seq'];
		$page = $_GET['page'];
		$controller->boardView($seq,$page);
		break;
	case "list":
		$page = $_GET['page'];
		$controller->listBoard($page);
		break;
	case "boardCommendView":
		$seq = $_GET['seq'];
		$controller->boardCommendView();
		break;
	case "logout":
		$controller->logout();
		break;
	case "delete":
		$seq = $_GET['seq'];
		$page = $_GET['page'];
		$controller->delete($seq,$page);
		break;
	case "commend":
		$seq = $_GET['seq'];
		$content = $_GET['content'];
		echo $controller->commend($seq,$content);
		break;
}
exit;
