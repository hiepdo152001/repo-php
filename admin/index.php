<?php 
	//start session
	session_start();
	//load file Connection.php
	//dau ../ se nhay len mot cap
	include "../application/Connection.php";
	//load file View.php
	include "../application/View.php";
 ?>
<?php 
	//load dong mvc dua vao tham so controller truyen len url
	$controller = isset($_GET["controller"]) ? $_GET['controller'] : "Home";
	$action = isset($_GET['action']) ? $_GET['action'] : "index";
	//tao duong dan vat ly cua file controller trong MVC. VD: controllers/PhongBanController.php
	$controllerFile = "controllers/".ucfirst($controller)."Controller.php"; //ucfirst -> viet hoa ky tu dau tien
	//file _exists(duongdan) tra ve true neu duong dan ton tai, nguoc lai tra ve false
	if(file_exists($controllerFile)){
		include $controllerFile;
		$controllerClass = ucfirst($controller)."Controller";
		//khoi tao object cua class
		$obj = new $controllerClass();
		//goi den action, xuat du lieu len trinh duyet
		echo ($obj->$action());
	}else die("file $controllerFile khong ton tai");
 ?>