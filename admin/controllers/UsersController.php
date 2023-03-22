<?php 
	//include file model vao day
	include "models/UsersModel.php";
	class UsersController {
		//ke thua class UsersModel
		use UsersModel;
		//ham tao duoc khoi tao dau tien
		public function __construct(){
			//kiem tra user dang nhap chua
			if(isset($_SESSION['email']) == false)
				header('location:index.php?controller=login');
		}
		public function index(){
			//quy dinh so ban ghi tren mot tran
			$recordPerPage = 4;
			//tinh so trang
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			return View::make("UsersView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		//sua ban ghi
		public function update(){
			//lay id truyen tu url
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//tao bien $action de dua vao thuoc tinh action cua the form
			$action = "index.php?controller=users&action=updatePost&id=$id";
			//lay mot ban ghi
			$record = $this->modelGetRecord($id);
			//goi View, truyen du lieu ra view
			return View::make('UsersFormView.php',["action"=>$action,"record"=>$record]);
		}
		//khi an nut submit(update ban ghi)
		public function updatePost(){
			//lay id truyen tu url
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham modelUpdate de update ban ghi
			$this->modelUpdate($id);
			//quay tro lai trang users
			header("location:index.php?controller=users");
		}
		//them ban ghi
		public function create(){
			//tao bien $action de dua vao thuoc tinh action cua the form
			$action = "index.php?controller=users&action=createPost";
			//goi view, truyen du lieu ra view
			return View::make('UsersFormView.php',["action"=>$action]);
		}
		//khi an nut submit (create ban ghi)
		public function createPost(){
			//goi ham modelCreate de update ban ghi
			$this->modelCreate();
			//quay tro lai trang users
			header("location:index.php?controller=users");
		}
		//xoa ban ghi
		public function delete(){
			//lay id truyen tu url
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham xoa ban ghi
			$this->modelDelete($id);
			//quay tro lai trang users
			header("location:index.php?controller=users");
		}
	}
 ?>