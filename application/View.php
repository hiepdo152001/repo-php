<?php 
	class View{
		public static $dataLayout = NULL;
		public static $dataMvc = NULL;//du lieu MVC se luu tru o bien nay
		public static $fileLayout = NULL;//duong dan cua file LayoutView.php
		public static $fileViewInMvc = NULL;//duong dan cua file View trong MVC
		/*
			- make(thamso1)
				$fileViewInMvc = thamso1
				$data = NULL
			- make(thamso1,thamso2)
				$fileViewInMvc = thamso1
				$data = thamso2
		*/
		//bien $data neu co phai truyen vao mot array
		public static function make($fileViewInMvc, $data = NULL){
			if($data != NULL)
				extract($data);
			//kiem tra xem duong dan file co ton tai khong
			//file_exists(duongdanfile) tra ve true neu file ton tai, nguoc lai tra ve false
			//file_exists("views/$fileViewInMvc") <=> file_exists("views/$fileViewInMvc") == true
			//!file_exists("views/$fileViewInMvc") <=> file_exists("views/$fileViewInMvc") == false
			if(file_exists("views/$fileViewInMvc")){
				//doc noi dung ben trong duong dan $fileViewInMvc de gan vao mot bien
				ob_start();
					include "views/$fileViewInMvc";
					self::$dataMvc = ob_get_contents();
				ob_get_clean();
				//xuat noi dung len man hinh thong qua bien $dataMvc
				//echo self::$dataMvc;
				//kiem tra neu bien self::$fileLayout khong NULL thi include no, neu khong thi echo self::$dataMvc
				if(self::$fileLayout != NULL){
					ob_start();
						include "views/".self::$fileLayout;
						self::$dataLayout = ob_get_contents();
					ob_get_clean();
					return self::$dataLayout;
				}
				else
					return self::$dataMvc; 
			}else die("Đường dẫn views/$fileViewInMvc không tồn tại");
		}
		public static function renderBody(){
			echo self::$dataMvc;
		}
	}
 ?>