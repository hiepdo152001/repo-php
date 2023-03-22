<?php 
	//include file model vao day
	include "models/CategoriesModel.php";
	class CategoriesController {
		//ke thua class CategoriesModel
		use CategoriesModel;
		//ham tao duoc khoi tao dau tien
		public function __construct(){
			//kiem tra user dang nhap chua
			if(isset($_SESSION['email']) == false)
				header('location:index.php?controller=login');
		}
		public function index(){
			//quy dinh so ban ghi tren mot tran
			$recordPerPage = 20;
			//tinh so trang
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			return View::make("CategoriesView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		//sua ban ghi
		public function update(){
			//lay id truyen tu url
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//tao bien $action de dua vao thuoc tinh action cua the form
			$action = "index.php?controller=categories&action=updatePost&id=$id";
			//lay mot ban ghi
			$record = $this->modelGetRecord($id);
			//goi View, truyen du lieu ra view
			return View::make('CategoriesFormView.php',["action"=>$action,"record"=>$record]);
		}
		//khi an nut submit(update ban ghi)
		public function updatePost(){
			//lay id truyen tu url
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham modelUpdate de update ban ghi
			$this->modelUpdate($id);
			//quay tro lai trang categories
			header("location:index.php?controller=categories");
		}
		//them ban ghi
		public function create(){
			//tao bien $action de dua vao thuoc tinh action cua the form
			$action = "index.php?controller=categories&action=createPost";
			//goi view, truyen du lieu ra view
			return View::make('CategoriesFormView.php',["action"=>$action]);
		}
		//khi an nut submit (create ban ghi)
		public function createPost(){
			//goi ham modelCreate de update ban ghi
			$this->modelCreate();
			//quay tro lai trang categories
			header("location:index.php?controller=categories");
		}
		//xoa ban ghi
		public function delete(){
			//lay id truyen tu url
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham xoa ban ghi
			$this->modelDelete($id);
			//quay tro lai trang categories
			header("location:index.php?controller=categories");
		}
	}
 ?>