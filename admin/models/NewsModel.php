<?php 
	trait NewsModel{
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
			$query = $conn->query("select * from news order by id desc limit $from,$recordPerPage");
			//tra ve nhieu ban ghi
			//neu $query->fetchAll() thi ket qua tra ve la mot array
			//neu $query->fetchAll(PDO::FETCH_OBJ) thi ket qua tra ve la mot object
			return $query->fetchAll(PDO::FETCH_OBJ);
		}
		//tinh tong so ban ghi
		public function modelTotalRecord(){
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from news");
			//tra ve so luong ban ghi
			return $query->rowCount();
		}
		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord($id){
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			//thuc hien truy van -> do co bien truyen tu url vao nen thuc hien prepare de truyen tham so
			$query = $conn->prepare("select * from news where id=:var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id]);
			//tra ve mot ban ghi
			return $query->fetch(PDO::FETCH_OBJ);
		}
		public function modelUpdate($id){
			$name = $_POST["name"];
			$description = $_POST["description"];
			$content = $_POST["content"];
			$hot = isset($_POST["hot"]) ? 1 : 0;
			//echo $price;	
			//update name
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("update news set name =:var_name, description=:var_description, content=:var_content,hot=:var_hot where id=:var_id");
			$query->execute(["var_id"=>$id,"var_name"=>$name,"var_description"=>$description,"var_content"=>$content,"var_hot"=>$hot]);
			//---
			//neu user upload anh thi thuc hien upload
			$photo = "";
			if($_FILES['photo']['name'] != ""){
				//---
				//lay anh cu de xoa
				$oldPhoto = $conn->query("select photo from news where id=$id");
				if($oldPhoto->rowCount() > 0){
					$record = $oldPhoto->fetch(PDO::FETCH_OBJ);
					//xoa anh
					if($record->photo != "" && file_exists("../assets/upload/news/".$record->photo))
						unlink("../assets/upload/news/".$record->photo);
				}
				//---
				$photo = time()."_".$_FILES['photo']['name'];
				//upload file vao thu muc assets/upload/news
				move_uploaded_file($_FILES['photo']['tmp_name'], "../assets/upload/news/$photo");
				$query = $conn->prepare("update news set photo = :var_photo where id = :var_id");
				$query->execute(["var_photo"=>$photo,"var_id"=>$id]);
			}
			//---
		}
		public function modelCreate(){
			$name = $_POST["name"];
			$category_id = $_POST["category_id"];
			$description = $_POST["description"];
			$content = $_POST["content"];
			$hot = isset($_POST["hot"]) ? 1 : 0;
			$price = $_POST['price'];
			$discount = $_POST['discount'];	
			$photo = "";
			//---
			//neu user upload anh thi thuc hien upload
			$photo = "";
			//$_FILES['photo']['name'] -> lay ten anh
			//$_FILES['photo']['tmp_name'] -> khi an nut submit thi file duoc upload len thu muc tmp cua bo cai php (ten file se co duoi .tmp)
			//move_uploaded_file(duong dan thu muc tam, duong dan file se upload vao)
			if($_FILES['photo']['name'] != ""){
				$photo = time()."_".$_FILES['photo']['name'];
				//upload file vao thu muc assets/upload/news
				move_uploaded_file($_FILES['photo']['tmp_name'], "../assets/upload/news/$photo");
			}
			//---	
			//echo $price;	
			//update name
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into news set name =:var_name, description=:var_description, content=:var_content,hot=:var_hot,photo = :var_photo");
			$query->execute(["var_name"=>$name,"var_description"=>$description,"var_content"=>$content,"var_hot"=>$hot,"var_photo"=>$photo]);	
		}
		public function modelDelete($id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//---
			//lay anh cu de xoa
			$oldPhoto = $conn->query("select photo from news where id=$id");
			if($oldPhoto->rowCount() > 0){
				$record = $oldPhoto->fetch(PDO::FETCH_OBJ);
				//xoa anh
				if($record->photo != "" && file_exists("../assets/upload/news/".$record->photo))
					unlink("../assets/upload/news/".$record->photo);
			}
			//---
			$query = $conn->prepare("delete from news where id = :var_id ");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id]);	
		}
	}
 ?>