<?php 
	//load file model
	include "models/HomeModel.php";
	class HomeController{
		//ke thua model
		use HomeModel;
		public function index(){
			//san pham noi bat
			$hotProduct = $this->modelHotProduct();
			//lay cac danh muc
			$categories = $this->modelCategories();
			return View::make("HomeView.php",["hotProduct"=>$hotProduct, "categories"=>$categories]);
		}
	}
 ?>