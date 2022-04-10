<?php
	ob_start();
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'dathang') or die ('Không thể kết nối tới database');
	if(!isset($_SESSION['loginAdmin'])	){
		header("location:login-admin.php");
	}
	
?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nhân viên</title>
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
<?php
	if(isset($_POST['add'])){
		$manv= $_POST['manv'];
		$tennv = $_POST['tennv'];
		$chucvu = $_POST['chuc-vu'];
		$diachi = $_POST['dia-chi'];
		$sdt = $_POST['sdt'];
//		mật khẩu tự động: dpcshop123

		if(isset($_FILES['hinh-anh'])){
			$file= $_FILES['hinh-anh'];
			$file_name= 'anhnv/'.$file['name'];
			move_uploaded_file($file['tmp_name'],$file_name);
			//tmp_name nơi lưu tạm file up load lên, dùng hàm muf để di chuyển nó ra khỏi thư mục tạm
		} else $file_name='';

		$sql_add = "insert into nhanvien values('$manv','$tennv','224e86b329a794892bfa2afe7824e681','$chucvu','$file_name','$diachi','$sdt')";
		if(mysqli_query($conn,$sql_add)){
			echo "Thêm nhân viên thành công";
		} else echo "<p style{color:red;}>Thêm không thành công, vui lòng kiểm tra lại</p>";
	}
?>	
	<div class="content">
		<div class="title-loaihanghoa">
			<h1>
				nhân viên
			</h1>

		</div>
		<div class="hien-thi-nhan-vien">
			<table class="table-nhan-vien">
				<th>
					Mã số
				</th>
				<th>
					Họ tên
				</th>
				<th>
					Chức vụ
				</th>
				<th>
					Địa Chỉ
				</th>
				<th>
					Số điện thoại
				</th>
				<th>
					Chi tiết
				</th>
<?php
	$sql_select_nv = "select * from nhanvien where msnv != 'ADMIN'";
	$kq_select_all_nv = mysqli_query($conn, $sql_select_nv);
	while($rownv= mysqli_fetch_assoc($kq_select_all_nv)){ ?>
				<tr>
					<td class="td-nv">
						<?=$rownv['msnv']?>
					</td>
					<td>
						<?=$rownv['hotennv']?>
					</td>
					<td>
						<?=$rownv['chucvu']?>
					</td>
					<td>
						<?=$rownv['diachi']?>
					</td>
					<td>
						<?=$rownv['sodienthoai']?>
					</td>
					<td class="xem-nhan-vien">
						<a href="info-nhan-vien.php?chitiet=<?=$rownv['msnv']?>">Xem</a>
					</td>
				</tr>

<?php }
?>
				
			</table>

		</div>
		<hr class="hr-loai-hang">
		<div class="add-loai-hang">
			<div class="title-add-loai-hang">
				<h3><i class="fas fa-angle-double-right"></i>&ensp; Thêm nhân viên</h3>
			</div>
			<form class="form-add-loai-hang" action="nhan-vien.php" method="post" enctype="multipart/form-data">
				<div class="add-ma-loai">
					<p>Nhập mã nhân viên: </p>
					<input type="text" name="manv" required="">
				</div>
				<div class="add-ten-loai">
					<p>Nhập tên nhân viên:</p>
					<input type="text" name="tennv" required="">
				</div>
				<div class="add-ten-loai-hinh">
					<p>Hình ảnh:</p>
					<input type="file" name="hinh-anh" title="chọn ảnh nhân viên" required="">
				</div>
				<div class="add-ten-loai select-loai-hang">
					<p>Chức vụ:</p>
					<select class="select-1" name="chuc-vu">
						<option value="Quản Lý">
							Quản Lý
						</option>
						<option value="Nhân viên bán hàng">
							Nhân viên bán hàng
						</option>
					</select>
				</div>
				<div class="add-ten-loai">
					<p>Địa Chỉ:</p>
					<input type="text" name="dia-chi" required="">
				</div>
				<!-- MẬT KHẨU TỰ ĐỘNG -->
				<!-- <div class="add-ten-loai">
					<p>Mật khẩu:</p>
					<input type="password" required="">
				</div> --> 
				<div class="add-ten-loai">
					<p>Số điện thoại</p>
					<input type="text" name="sdt" required="">
				</div>

				<button class="btn-add-loai-hang" name="add">Thêm Vào</button>
			</form>
		</div>
	</div>
<?php	
// mysqli_free_result($resutl);
mysqli_close($conn);
?>
</body>
</html>