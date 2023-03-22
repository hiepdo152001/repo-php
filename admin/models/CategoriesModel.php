<?php 
	trait CategoriesModel{
		//lay ve danh sach cac ban ghi
		public function modelRead($recordPerPage){
			//lay bien truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from categories where parent_id = 0 order by id desc limit $from,$recordPerPage");
			//tra ve nhieu ban ghi
			//neu $query->fetchAll() thi ket qua tra ve la mot array
			//neu $query->fetchAll(PDO::FETCH_OBJ) thi ket qua tra ve la mot object
			return $query->fetchAll(PDO::FETCH_OBJ);
		}
		//tinh tong so ban ghi
		public function modelTotalRecord(){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select *from categories where parent_id = 0");
			//tra ve so luong ban ghi
			return $query->rowCount();
		}
		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord($id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van -> do co bien truyen tu url vao nen thuc hien prepare de truyen tham so
			$query = $conn->prepare("select * from categories where id = :var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id]);
			//tra ve mot ban ghi
			return $query->fetch(PDO::FETCH_OBJ);
		}	
		public function modelUpdate($id){
			$name = $_POST["name"];
			$parent_id = $_POST["parent_id"];
			//update name
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van -> do co bien truyen tu url vao nen thuc hien prepare de truyen tham so
			$query = $conn->prepare("update categories set name = :var_name, parent_id= :var_parent_id where id = :var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id,"var_name"=>$name,"var_parent_id"=>$parent_id]);
			
		}
		public function modelCreate(){
			$name = $_POST["name"];
			$parent_id = $_POST["parent_id"];
			
			//update name
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into categories set name = :var_name, parent_id = :var_parent_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_name"=>$name,"var_parent_id"=>$parent_id]);		
		}
		public function modelDelete($id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("delete from categories where id = :var_id or parent_id = :var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id]);		
		}
		//liet ke danh muc cap 1 -> su dung o file CategoriesFormView.php
		/*public function modelCategoriesSub($category_id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("select * from categories where parent_id = :var_parent_id order by id desc");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_parent_id"=>$category_id]);	
			//tra ve tat ca cac ket qua lay duoc
			return $query->fetchAll(PDO::FETCH_OBJ);
		}
		//liet ke danh muc cap 0 -> su dung o file CategoriesFormView.php
		public function modelCategories($category_id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("select * from categories where parent_id = 0 and id <> :var_category_id order by id desc");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_category_id"=>$category_id]);	
			//tra ve tat ca cac ket qua lay duoc
			return $query->fetchAll(PDO::FETCH_OBJ);
		}*/
	}
 ?>