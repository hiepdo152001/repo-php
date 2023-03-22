<?php 
	class HomeController{
		//ham tao duoc khoi tao dau tien
		public function __construct(){
			//kiem tra user dang nhap chua
			if(isset($_SESSION['email']) == false)
				header('location:index.php?controller=login');
		}
		public function index(){
			//load view
			return View::make("HomeView.php");
		}
	}
 ?>