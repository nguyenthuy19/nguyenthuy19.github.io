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
	<title>Thông tin nhân viên</title>
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
	if(isset($_GET['chitiet'])){
		$manv =$_GET['chitiet'];
		$sql_in_anh_nv = "select * from nhanvien where msnv = '$manv'";
		$sql_kq_anh_nv = mysqli_query($conn,$sql_in_anh_nv);
		$row_hinh = mysqli_fetch_assoc($sql_kq_anh_nv);  
		$tmp_hinhnv = $row_hinh['anhnv'];
		if(isset($_POST['change-btn-nv'])){
			// $manv= $_POST['manv'];
			$tennv = $_POST['tennv'];
			$chucvu = $_POST['chuc-vu'];
			$diachi = $_POST['dia-chi'];
			$sdt = $_POST['sdt'];
	//		mật khẩu tự động: dpcshop123

			if(isset($_FILES['hinh-anh'])){
				// echo "Dương Phương Cương"; exit;
				$file= $_FILES['hinh-anh'];
				$file_name= 'anhnv/'.$file['name'];
				if($file_name=='anhnv/'){
					$file_name= $tmp_hinhnv;
				}
				move_uploaded_file($file['tmp_name'],$file_name);
				//tmp_name nơi lưu tạm file up load lên, dùng hàm muf để di chuyển nó ra khỏi thư mục tạm
			} else $file_name='';

			$sql_change = "update nhanvien set hotennv='$tennv',matkhau='224e86b329a794892bfa2afe7824e681',chucvu='$chucvu',anhnv='$file_name',diachi='$diachi',sodienthoai='$sdt' where msnv = '$manv'";
			if(mysqli_query($conn,$sql_change)){
				echo "Sửa nhân viên thành công";
			} else echo "Sửa không thành công, vui lòng kiểm tra lại";
		}

		if(isset($_POST['xoa'])){
			$sql_xoa_nv = "delete from nhanvien where msnv = '$manv'";
			if(mysqli_query($conn,$sql_xoa_nv)){
				echo "Đã xóa thành công";
			}else echo "Xóa không thành công";
		}
	}
?>	
	<div class="content">
		<div class="title-loaihanghoa">
			<h1>
				thông tin nhân viên
			</h1>

		</div>
		<hr class="hr-loai-hang">
		<div class="info-nhan-vien-content">
<?php 
	if(isset($_GET['chitiet'])){
		$msnv = $_GET['chitiet'];
		if($msnv==""){
			echo "Không có thông tin để hiển thị!";
		} else {
			$sql_ht_chg_nv = "select * from nhanvien where msnv='$msnv'";
			$kq_ht_chg_nv = mysqli_query($conn,$sql_ht_chg_nv);
			$row = mysqli_fetch_assoc($kq_ht_chg_nv);
?>	
			<div class="img-info">
				<img src="<?=$row['anhnv']?>" alt="ảnh nhân viên">
			</div>
			<div class="select-info">
				<table class="table-info-nv">
					<tr>
						<td class="td-1-select-info">
							Mã số:
						</td>
						<td class="td-2-select-info">
							<?=$row['msnv']?>
						</td>
					</tr>
					<tr>
						<td class="td-1-select-info">
							Họ Tên:
						</td>	
						<td>
							<?=$row['hotennv']?>
						</td>
					</tr>
					<tr>
						<td class="td-1-select-info">
							Chức vụ: 
						</td>	
						<td>
							<?=$row['chucvu']?>
						</td>
					</tr>
					<tr>
						<td class="td-1-select-info">
							Địa Chỉ:
						</td>	
						<td>
							<?=$row['diachi']?>
						</td>
					</tr>
					<tr>
						<td class="td-1-select-info">
							SĐT:
						</td>	
						<td>
							<?=$row['sodienthoai']?>
						</td>
					</tr>
				
				</table>
			</div>
		</div>
		<hr class="hr-change-nv">
		<div class="title-change-nv">
			<form action="info-nhan-vien.php?chitiet=<?=$row['msnv']?>" method="post">
				<button class="btn-add-nv" name="btn-add-nv">
					Chỉnh Sửa Thông Tin
				</button>
				<button class="btn-add-nv btn-remove-nv" name="btn-remove-nv">
					Xóa Nhân Viên
				</button>
			</form>
		</div>
<?php
			if(isset($_POST['btn-add-nv'])){
?>
		<div class="change-nv">
			<form class="form-add-loai-hang" action="info-nhan-vien.php?chitiet=<?=$row['msnv']?>" method="post" enctype="multipart/form-data">
			
				<div class="add-ma-loai" style="display: flex;">
					<p>Mã nhân viên: </p><p class="ttht-nv">&ensp;<?=$row['msnv']?></p>
				</div>
				<div class="add-ten-loai">
					<p>Tên nhân viên:</p>
					<input type="text" name="tennv" class="ttht-nv" value="<?=$row['hotennv']?>" required="">
				</div>
				<div class="add-ten-loai-hinh">
					<p>Hình ảnh: <span style="color: red;"><small>(xin vui lòng chọn lại)</small></span></p>
					<input type="file" name="hinh-anh" value="<?=$row['anhnv']?>" title="chọn ảnh nhân viên">
				</div>
				<div class="add-ten-loai select-loai-hang">
					<p>Chức vụ:</p>
					<select class="select-1" name="chuc-vu">
						<option value="<?=$row['chucvu']?>">
							<?=$row['chucvu']?>
						</option>
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
					<input type="text" class="ttht-nv" value="<?=$row['diachi']?>" name="dia-chi" required="">
				</div>
				<!-- MẬT KHẨU TỰ ĐỘNG -->
				<!-- <div class="add-ten-loai">
					<p>Mật khẩu:</p>
					<input type="password" required="">
				</div> --> 
				<div class="add-ten-loai">
					<p>Số điện thoại</p>
					<input type="text" class="ttht-nv" value="<?=$row['sodienthoai']?>" name="sdt" required="">
				</div>

				<button class="btn-add-loai-hang" name="change-btn-nv">Chỉnh Sửa</button>
			</form>
<?php 
			}
			if(isset($_POST['btn-remove-nv'])){ ?>

			<div class="tb-xoa-nv">
				<h2>Bạn có chắc muốn xóa nhân viên này?</h2>
				<form method="post" action="info-nhan-vien.php?chitiet=<?=$row['msnv']?>">
					<button name="btn-huyxoa-nv" class="btn-huyxoa-nv">Hủy</button>
					<button name="xoa" class="btn-xoa-nv">Ok</button>
				</form>
			</div>
<?php
			}
		}  
	} else echo "Không có thông tin để hiển thị!";
?>	
			
		</div>
	</div>
<?php	
// mysqli_free_result($resutl);
mysqli_close($conn);
?>
</body>
</html>