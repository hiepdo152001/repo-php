controllers
	UsersController.php
models
	UsersModel.php
views
	UsersView.php
	UsersFormView.php


1		tin tuc 1
2		tin tuc 2
3		tin tuc 3
4		tin tuc 4
5		tin tuc 5
6		tin tuc 6
7		tin tuc 7

index.php?controller=users
	-> lay bien p truyen tu url, neu url khong co bien p thi mac dinh p=0
		-> neu bien p co tren url thi p= $_GET["p"] - 1
	Tu bien p nay co the tinh ra duoc lay tu ban ghi nao
	- quy dinh so ban ghi tren mot trang: $recordPerPage = 3
	- Tinh tong so ban ghi $totalRecord: 7
	- Tinh so trang: ceil($totalRecord/$recordPerPage) = ceil(7/3) = 3

	-Trang 1:index.php?controller=users&p=1
		p = 1-1 = 0
		Lay tu ban ghi: $from = p * $recordPerPage = 0 x 3 = 0
		select * from users order by id desc limit 0 , 3
	- Trang 2: index.php?controller=users&p=2
		p = 2 - 1 = 1
		$from = 1 x 3 = 3
		select * from users order by id desc limit 3 , 3
	- Trang 3: index.php?controller=users&p=3
		p = 3 - 1 = 2
		$from = 2 x 3 = 6
		select * from users order by id desc limit 6 , 3

- Co 2 kieu truy van: 
	- Truy van co truyen tham so
		$query = $conn->prepare("...")
		$query->execute([cac tham so truyen vao sql])
		-> su dung khi co bien truyen tu url hoac form
	- Truy van khong truyen tham so
		$query = $conn->query("... cac tham so cac bien truyen truc tiep vao chuoi sql")
		->su dung khi khong co bien truyen tu url hoac form

O phan view cua MVC -> la phan nguoi dung nhin thay tren web
- Neu khong co bien $fileLayout thi se hien thi noi dung cua MVC len web
- Neu co duong dan cua bien $fileLayout thi
	- Doc toan bo noi dung cua duong dan $fileLayout -> $dataLayout
	- Doc noi dung cua MVC gan vao mot bien $dataMvc
	-> xuat bien $dataMvc vao trong noi dung cua $dataLayout


<form method="post" action="">
-> action update: index.php?controller=users&action=updatePost&id=...
-> action create: index.php?controller=users&action=createPost
	<input type="text" name="txt">
	<input type="submit" value="submit">
</form>