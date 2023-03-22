<?php 
	//ket noi csdl
	class Connection{
		//ham ket noi csdl, ket qua tra ve mot bien -> kieu bien nay la bien object
		public static function getInstance(){
			$hostname = "localhost";
			$database = "php60_database";
			$username = "root";
			$password = "1501Hiep1501";
			//ket noi csdl, tra ket qua ve bien object
			$db = new PDO("mysql:host=$hostname;dbname=$database;","$username","$password");
			//lay du lieu theo kieu unicode
			$db->exec("set names utf8");
			//tra ve bien ket noi
			return $db;
		}
	}
 ?>
