<?php 
	//load noi dung cua file Layout
	self::$fileLayout = "LayoutView.php";
 ?>
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="index.php?controller=categories&action=create" class="btn btn-primary">Add Category</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List Categories</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Name</th>
                    <th style="width:100px;"></th>
                </tr>
                <?php foreach ($data as $rows): ?>
                <tr>
                    <td><?php echo $rows->name; ?></td>
                    
                    <td style="text-align:center;">
                        <a href="index.php?controller=categories&action=update&id=<?php echo $rows->id ?>">Edit</a>&nbsp;
                        <a href="index.php?controller=categories&action=delete&id=<?php echo $rows->id ?>" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                <?php 
                    //lay bien ket noi csdl
                    $conn = Connection::getInstance();
                    $query = $conn->query("select * from categories where parent_id = {$rows->id} order by id desc");
                    //tra ve tat ca cac ket qua lay duoc
                    $categoriesSub =  $query->fetchAll(PDO::FETCH_OBJ);
                 ?>
                 <?php foreach ($categoriesSub as $rowsSub): ?>
                    <tr>
                        <td style="padding-left: 20px;"><?php echo $rowsSub->name; ?></td>
                        
                        <td style="text-align:center;">
                            <a href="index.php?controller=categories&action=update&id=<?php echo $rowsSub->id ?>">Edit</a>&nbsp;
                            <a href="index.php?controller=categories&action=delete&id=<?php echo $rowsSub->id ?>" onclick="return window.confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            	<?php endforeach; ?>
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            <ul class="pagination">
            	<li class="page-itemn"><a href="#" class="page-link">Trang</a></li>
            	<?php for($i= 1; $i <= $numPage; $i++): ?>
            		<li class="page-itemn"><a href="index.php?controller=categories&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            	<?php endfor; ?>
            </ul>
        </div>
    </div>
</div>