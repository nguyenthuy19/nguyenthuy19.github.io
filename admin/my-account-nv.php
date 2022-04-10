<?php
	ob_start();
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'dathang') or die ('Không thể kết nối tới database');
	if(!isset($_SESSION['loginAdmin']) && !isset($_SESSION['loginNV'])){
		header("location:login-admin.php");
	}
	
?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Account</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<link rel="stylesheet" href="admin.css">
	<link rel="stylesheet" href="my-account-nv.css">

</head>
<body>
<?php 
	if(isset($_GET['log-out'])){
		if(isset($_SESSION['loginAdmin'])){
			unset($_SESSION['loginAdmin']);
			header("location:login-admin.php");
		}
		if(isset($_SESSION['loginNV'])){
			unset($_SESSION['loginNV']);
			header("location:login-admin.php");
		}
	}

	if(isset($_GET['ms'])){
		$msnv = $_GET['ms'];
		$kq_search = mysqli_query($conn,"select * from nhanvien where msnv='$msnv'");
		$row = mysqli_fetch_assoc($kq_search);
		$ton_tai = 0;
		if(!empty($row['msnv'])){
			$ton_tai =1;
			// echo $row_kq['msnv'];
		}
		if($ton_tai==0){
			echo "<h1>không có thông tin để hiển thị!</h1>";
		} 
		else {
			// $kq = mysqli_query($conn,)

?>
	<div class="main">
		<div class="title-myacc">
			<h1>Xem và cập nhật thông tin của bạn</h1>
			<div class="logout">
				<a href="my-account-nv.php?log-out"><i class="fas fa-sign-out-alt"></i>LogOut</a>
			</div>
		</div>

		<div class="info-nv">
			<div class="img-nv">
				<img src="<?=$row['anhnv']?>" alt="hình ảnh">
			</div>
			<div class="info">
				<table>
					<tr>
						<td class="td-left">
							Mã số:
						</td>
						<td>
							<?=$row['msnv']?>
						</td>
					</tr>
					<tr>
						<td class="td-left">
							Họ Tên:
						</td>
						<td>
							<?=$row['hotennv']?>
						</td>
					</tr>
					<tr>
						<td class="td-left">
							Chức vụ:
						</td>
						<td>
							<?=$row['chucvu']?>
						</td>

					</tr>
					<tr>
						<td class="td-left">
							Địa chỉ:
						</td>
						<td>
							<?=$row['diachi']?>
						</td>

					</tr>
					<tr>
						<td class="td-left">
							SĐT:
						</td>
						<td>
							<?=$row['sodienthoai']?>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<hr class="hr-acc">
				<!-- BUTTON GỬI GET chinh-sua -->
		<div class="title-change-nv">
			<form action="my-account-nv.php?ms=<?=$row['msnv']?>" method="post">
				<button style="margin-left: 15%; cursor: pointer;" class="btn-add-nv" name="btn-add-nv">
					Chỉnh sửa
				</button>
			</form>
		</div>


			<!-- SAU KHI BAM button chinh-sua thi nhap mat khau -->
<?php
	if(isset($_POST['btn-add-nv'])){

?>			
		<div class="mess-mk">
			<h2>Nhập mật khẩu để chỉnh sửa</h2>
			<form action="my-account-nv.php?ms=<?=$row['msnv']?>" method="post">
				<input type="password" name="password">
				<button class="btn-mk" name="btn-mk">ok</button>
			</form>
		</div>
<?php
	}
if(isset($_POST['change-btn-nv'])){
	// $manv= $_POST['manv'];
	$tennv = $_POST['tennv'];
	// $chucvu = $_POST['chuc-vu'];
	$diachi = $_POST['dia-chi'];
	$sdt = $_POST['sdt'];
	$new_pass= MD5($_POST['newpass']);
	$re_pass = MD5($_POST['re-newpass']);

	$sql_in_anh_nv = "select * from nhanvien where msnv = '$msnv'";
	$sql_kq_anh_nv = mysqli_query($conn,$sql_in_anh_nv);
	$row_hinh = mysqli_fetch_assoc($sql_kq_anh_nv);  
	$tmp_hinhnv = $row_hinh['anhnv'];
	if($new_pass!=$re_pass){ ?>
		<div class="tb-xoa-nv" >
			<h2>Xác nhận mật khẩu sai, xin vui lòng kiểm tra lại!
			</h2>
			<a style="font-size: 2em; font-weight: bold; color: white;" href="javascript:history.back()">OK</a>
		</div>


<?php
	} 
	else{
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

		$sql_change = "update nhanvien set hotennv='$tennv',matkhau='$new_pass',anhnv='$file_name',diachi='$diachi',sodienthoai='$sdt' where msnv = '$msnv'";
		if(mysqli_query($conn,$sql_change)){
								$err = "Sửa Thông tin thành công";
		} else $err = "Sửa không thành công, vui lòng kiểm tra lại";

	}
}

	if(isset($_POST['btn-mk'])){
		$pass=MD5($_POST['password']);
		$sql_kt_mk = "select * from nhanvien where msnv = '$msnv' and matkhau = '$pass'";
		$kq_kt_mk = mysqli_query($conn, $sql_kt_mk);
		// var_dump($kq_kt_mk); exit;
		$row_kt_mk = mysqli_fetch_assoc($kq_kt_mk);
		if(empty($row_kt_mk['msnv'])){
			$err = "Mật khẩu không đúng, xin vui lòng thử lại";
			// echo "không đúng mật khẩu";
		} else if(!empty($row_kt_mk['msnv'])){


?> 
				<!-- SAU KHI NHẬP MẬT KHẨU THÌ CHỈNH SỬA -->

		<div class="change-nv">
			<form class="form-add-loai-hang" action="my-account-nv.php?ms=<?=$row['msnv']?>" method="post" enctype="multipart/form-data">
			
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
				<div class="add-ma-loai" style="display: flex;">
					<p>Chức vụ: </p><p class="ttht-nv">&ensp;<?=$row['chucvu']?></p>
				</div>
				<div class="add-ten-loai">
					<p>Địa Chỉ:</p>
					<input type="text" class="ttht-nv" value="<?=$row['diachi']?>" name="dia-chi" required="">
				</div>
				<div class="add-ten-loai">
					<p>Số điện thoại</p>
					<input type="text" class="ttht-nv" value="<?=$row['sodienthoai']?>" name="sdt" required="">
				</div>
				<div class="add-ten-loai">
					<p>Mật khẩu mới:</p>
					<input type="password" class="ttht-nv" name="newpass" required="">
				</div>
				<div class="add-ten-loai">
					<p>Xác nhận mật khẩu:</p>
					<input type="password" class="ttht-nv" name="re-newpass" required="">
				</div>
				<!-- MẬT KHẨU TỰ ĐỘNG -->
				<!-- <div class="add-ten-loai">
					<p>Mật khẩu:</p>
					<input type="password" required="">
				</div> --> 
				

				<button class="btn-add-loai-hang" name="change-btn-nv">Chỉnh Sửa</button>
			</form>
<?php
			}
	} 
?>		


<?php
	if(!empty($err)){?>
			<div class="mess-err">
				<h2><?=$err?></h2>
			</div>
<?php
	} 
?>

		</div>

	</div>
<?php
		}
	} else echo "<h1>Không có thông tin để hiển thị!</h1>"; 

?>
</body>
</html>