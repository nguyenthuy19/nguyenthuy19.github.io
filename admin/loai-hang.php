<?php
	ob_start();
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'dathang') or die ('Không thể kết nối tới database');
	if(!isset($_SESSION['loginAdmin'])&& !isset($_SESSION['loginNV'])){
		header("location:login-admin.php");
	}
	
?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Loại hàng</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
  	<!-- import Font Awesome 5 facebook -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  	<!-- google font -->
  	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="admin.css">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-brand">
				<i class="fas fa-cogs"></i> <span>quản trị website DPC</span>
			</div>

			<div class="navbar-right">
				<div class="dropdown-admin">
				  <div class="dropbtn-admin">
				  	<i class="fas fa-user"></i> <span>my account</span> <span class="caret"></span>
				  </div>
<?php
	if(isset($_SESSION['loginAdmin']) || isset($_SESSION['loginNV'])){
		if(isset($_SESSION['loginAdmin'])){
			$msadmin = $_SESSION['loginAdmin'];
		} else if(isset($_SESSION['loginNV'])){
			$msadmin = $_SESSION['loginNV'];
		}
		$sql_ad = "select * from nhanvien where msnv = '$msadmin' ";
		$kq = mysqli_query($conn,$sql_ad);
		$row_ad = mysqli_fetch_assoc($kq);
		// tách tên
		$name_ad = $row_ad['hotennv'];
		$arr_name = explode(" ",$name_ad);
		$chiso_arr = count($arr_name);
		$name = $arr_name[$chiso_arr -1];
	}
	if(isset($_GET['log-out-ad'])){
		if(isset($_SESSION['loginAdmin'])){
			unset($_SESSION['loginAdmin']);
		}
		if(isset($_SESSION['loginNV'])){
			unset($_SESSION['loginNV']);
		}
		header("location:login-admin.php");
	}
?> 				  
				  <div class="dropdown-admin-content">
				    <a href="my-account-nv.php?ms=<?=$row_ad['msnv']?>"><?=$row_ad['hotennv']?></a>
				    <a href="my-account-nv.php?ms=<?=$row_ad['msnv']?>">Đổi thông tin</a>
				    <a href="admin.php?log-out-ad" class="dropdown-logout"><i class="fas fa-sign-out-alt"></i> Log out</a>
				  </div>
				</div>
			</div>
		</div>
	</nav>
	<div class="container-fluid menu">

		<div class="avatar">
			<a href="my-account-nv.php?ms=<?=$row_ad['msnv']?>"><img src="<?=$row_ad['anhnv']?>" alt=""></a>
			<a class="name" href="my-account-nv.php?ms=<?=$row_ad['msnv']?>"><?php if(isset($_SESSION['loginAdmin']) || isset($_SESSION['loginNV'])){echo $name;}?> <br> <p style="font-size: 0.8em; text-transform: lowercase;"><?php if(isset($_SESSION['loginAdmin'])){echo $row_ad['msnv'];}?></p></a>
		</div>
		<ul class="list-menu">
			<li>
				<a href="admin.php"> <i class="fa fa-home"></i> Home</a>
			</li>
<?php
	if(isset($_SESSION['loginAdmin'])){ 
?>			
			<li>
				<a href="nhan-vien.php"><i class="fas fa-users-cog"></i> Nhân Viên</a>
			</li>
<?php 
	}
?>			
			<li>
				<a href="dat-hang.php"><i class="fas fa-clipboard-list"></i> Đơn Hàng</a>
			</li>
			<li>
				<a href="hang-hoa.php"> <i class="fas fa-box-open"></i> Hàng Hóa</a>
			</li>
			<li>
				<a href="khach-hang.php"> <i class="fas fa-users"></i> Khách Hàng</a>
			</li>
			<li>
				<a href="loai-hang.php"> <i class="fas fa-stream"></i> Loại Hàng</a>
			</li>
			<li>
				<a href="../client/index.php"> <i class="fas fa-exchange-alt"></i> Trang Bán Hàng</a>
			</li>
			<li class="li-logout">
				<a href="admin.php?log-out-ad"> <i class="fas fa-sign-out-alt"></i> 	Log out</a>
			</li>


		</ul>
	</div>
	<div class="content">
		<div class="title-loaihanghoa">
			<h1>
				loại hàng hóa
			</h1>
<?php
	if(isset($_POST['add'])){
		$ma=$_POST['ma-loai'];
		$ten=$_POST['ten-loai'];
		$sql_add = "insert into loaihanghoa values('$ma','$ten')";
		// mysqli_query($conn,$sql_add);
		if(mysqli_query($conn,$sql_add)){
			$mess = "Thêm loại hàng thành công";
		} else
			$mess = "Thêm không thành công, vui lòng kiểm tra lại";
	}
	if(isset($_GET['delete'])){
		$mlh = $_GET['delete'];
		$sql_delete = "delete from loaihanghoa where maloaihang='$mlh'";
		if(mysqli_query($conn,$sql_delete)){
			$mess="Xóa thành công";
		} else $mess = "Xóa không thành công";
	}
	$thongbao =false;
	if(isset($_POST['ml-edit'])){
		$ma_e=$_POST['ma-loai-edit'];
		$ten_e=$_POST['ten-loai-edit'];
		$sql_edit = "update loaihanghoa set tenloaihang = '$ten_e' where maloaihang = '$ma_e' ";
		// mysqli_query($conn,$sql_add);
		if(mysqli_query($conn,$sql_edit)){
			$thongbao = "Sửa thành công";
		} else
			$thongbao = "Sửa không thành công, vui lòng kiểm tra lại";
	}
?>	
		</div>
		<div class="hien-thi-loai-hang">
			<table class="table-loai-hang">
				<th class="stt-loai-hang">
					STT
				</th>
				<th>
					Mã loại hàng
				</th>
				<th>
					Tên loại hàng
				</th>
				<th class="edit-loai-hang">
					Sửa
				</th>
				<th class="icon-remove-loai-hang">
					Xóa
				</th>
<?php
	$sql_select = "select * from loaihanghoa";
	$resutl= mysqli_query($conn, $sql_select);
	$stt=1;
	while ($row=mysqli_fetch_assoc($resutl)) {?>
			<tr>
					<td class="stt-loai-hang">
						<?=$stt?>
					</td>
					<td class="th-ma-loai">
						<?=$row['maloaihang']?>
					</td>
					<td class="th-ten-loai">
						<?=$row['tenloaihang']?>
					</td>
					<td class="edit-loai-hang">
						<a href="?edit=<?=$row['maloaihang']?>"><i class="glyphicon glyphicon-edit"></i></a>
					</td>
					<td class="icon-remove-loai-hang">
						<a href="?delete=<?=$row['maloaihang']?>"><i class="glyphicon glyphicon-remove-sign"></i></a>
					</td>
				</tr>
<?php 	$stt++;
	} ?>			
			</table>

		</div>
		<hr class="hr-loai-hang">
<?php
	if(!isset($_GET['edit'])){ 
?>		
		<div class="add-loai-hang">
			<div class="title-add-loai-hang">
				<h3 class="h3-them-loai-hang"><i class="fas fa-angle-double-right"></i>&ensp; Thêm loại hàng</h3>
				
			</div>
			<h3 class="mess-loai-hang" style="color: red; float: right; margin-right: 2%; width: 35%; text-transform: capitalize;">
<?php
					if(isset($_GET['delete']) || isset($_POST['add'])){
						echo $mess; 
				}
			
?>			
			</h3>
			<form class="form-add-loai-hang" action="loai-hang.php" method="post">
				<div class="add-ma-loai">
					<p>Nhập mã loại hàng: </p>
					<input type="text" name="ma-loai" required="">
				</div>
				<div class="add-ten-loai">
					<p>Nhập tên loại hàng</p>
					<input type="text" name="ten-loai" required="">
				</div>
				<button class="btn-add-loai-hang" name="add">Thêm Vào</button>
			</form>
		</div>
<?php 
	} //Không có biến edit
	if(isset($_GET['edit'])){
		$maloai_e = $_GET['edit'];
?>	
		<div class="add-loai-hang">
			<div class="title-add-loai-hang">
				<h3 class="h3-them-loai-hang"><i class="fas fa-angle-double-right"></i>&ensp; Sửa loại hàng</h3>
				
			</div>
			<h3 class="mess-loai-hang" style="color: red; float: right; margin-right: 2%; width: 35%; text-transform: capitalize;">
<?php
					if(isset($_GET['delete']) || isset($_POST['add'])){
						echo $mess; 
				}
			
?>			
			</h3>
			<form class="form-add-loai-hang" action="loai-hang.php" method="post">
				<div class="add-ma-loai">

					<p>Mã loại: <?=$maloai_e?> </p>
					<input style="display:none;" type="text" name="ma-loai-edit" value="<?=$maloai_e?>">
				</div>
				<div class="add-ten-loai">	
					<p>Nhập tên loại hàng</p>
					<input type="text" name="ten-loai-edit" required="">
				</div>
				<button class="btn-add-loai-hang" name="ml-edit">Sửa</button>
			</form>
		</div>

<?php 
	}
	if(!empty($thongbao)){?>
		<h3 style="font-family: all; color: red; position: absolute; margin-left: 60%; margin-top:-15%"><?=$thongbao?></h3>
<?php		
	}
?>	
	</div>
<?php	
// mysqli_free_result($resutl);
mysqli_close($conn);
?>
</body>
</html>