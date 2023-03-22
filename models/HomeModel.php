<?php 
	trait HomeModel{
		//san pham noi bat
		public function modelHotProduct(){
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where hot = 1 order by id desc limit 0,6");
			//tra ve tat ca cac ban ghi
			return $query->fetchAll(PDO::FETCH_OBJ);
		}
		//liet ke danh muc san pham -> chi lay cac danh muc co san pham ben trong
		public function modelCategories(){
			$conn = Connection::getInstance();
			$query = $conn->query("select * from categories where id in (select category_id from products)");
			//tra ve tat ca cac ban ghi truy van duoc
			return $query->fetchAll(PDO::FETCH_OBJ);
		}
		
	}
 ?>