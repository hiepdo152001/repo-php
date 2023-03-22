<?php 
	include "models/AccountModel.php";
	class AccountController{
		use AccountModel;
		//hien thi form dang ky
		public function register(){
			return View::make("RegisterView.php");
		}
		//khi an nut submit cua form dang ky
		public function registerPost(){
			$this->modelRegister();
		}
		//hien thi form login
		public function login(){
			return View::make("LoginView.php");
		}
		//khi an nut submit cua form login
		public function loginPost(){
			$this->modelLogin();
		}
		//dang xuat tai khoan
		public function logout(){
			$this->modelLogout();
		}
	}
 ?>