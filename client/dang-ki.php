<?php
	ob_start();
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'dathang') or die ('Không thể kết nối tới database');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
  	<!-- import Font Awesome 5 facebook -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  	<!-- google font -->
  	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Ephesis&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="dang-ki.css">
</head>
<body>
<?php 
	if(isset($_POST['dang-ki'])){
		$hoten=$_POST['ho-ten'];
		$tencongty=$_POST['ten-cong-ty'];
		$sdt=$_POST['sdt'];
		$email=$_POST['email'];
		$matkhau1=$_POST['matkhau'];
		$matkhau=MD5($matkhau1);
		$matkhau2=$_POST['xacnhan'];
		$xacnhan=MD5($matkhau2);

		$hh=mysqli_query($conn, "select * from khachhang");
		
		$sql="insert into khachhang(hotenkh,matkhau,tencongty,sodienthoai,email) values('$hoten','$matkhau','$tencongty','$sdt','$email');";
		
		$i=0;
		while($row = mysqli_fetch_assoc($hh)){
				$mang[$i]=$row["sodienthoai"];
				$i++;
		}

		$kt_sdt = 0;
		for($x=0;$x<$i;$x++){
			if($sdt==$mang[$x]){
				$kt_sdt=1;
				break;
			}
		}

		if($kt_sdt){
			$err="Số điện thoại đã được đăng kí, vui lòng kiểm tra lại!";
		} else if(!$kt_sdt){
			if($matkhau!=$xacnhan){
				$err= "Xác nhận mật khẩu sai, vui lòng kiểm tra lại!";
			} else if($matkhau==$xacnhan){
				if(mysqli_query($conn,$sql)){
					$thanhcong = "Đăng kí thành công!";
						}else $err= "Đăng kí không thành công, vui lòng kiểm tra lại!";
				}
			}

	  	$_SESSION['mskh-login'] = $conn-> insert_id;
		// var_dump($maskh); exit;


	}
?>
	<nav class="main">
		<div class="form-dk-1">
			<div class="brand">
			<marquee><h1>Đăng kí thành viên cửa hàng DPC</h1></marquee>
			</div>
			<div class="form-dk">
				<div class="dk">
					<h3>Đăng kí thành viên</h3>
					<a href="login-kh.php"><h5>Đăng nhập</h5></a>
				</div>
				<form action="dang-ki.php" method="post">
					<input type="text" name="ho-ten" placeholder="Nhập họ tên:" required="">
					<input type="text" name="ten-cong-ty" placeholder="Tên công ty:">
					<input type="text" name="sdt" placeholder="Số điện thoại:" required="">
					<input type="Email" name="email" placeholder="Email:">
					<input type="password" name="matkhau" placeholder="Mật khẩu:" required="">
					<input type="password" name="xacnhan" placeholder="Xác nhận mật khẩu" required="">
					<button class="btn-dk" name="dang-ki">Đăng kí</button>
				</form>
				
			</div>	
		</div>
<?php
	if(!empty($err)){ ?>
		<h3 class="thong-bao">
			<?= $err?>. <a href="javascript:history.back()"><i class="fas fa-redo-alt"></i></a>
		</h3>
		
<?php	
	} else if(!empty($thanhcong)){ ?>
		<h3 class="thong-bao">
			<?= $thanhcong?>. &ensp; <a href="dang-ki.php?dang-nhap">Đăng nhập</a>
		</h3>
<?php
	}	
?>		
		<img style="width: 100%; display: block;"  src="./images/img_register8.jpg" alt="">
	</nav>

	<!-- CHỖ NÀY -->
<?php
	if(isset($_GET['dang-nhap'])){
		$_SESSION['loginKH'] = $_SESSION['mskh-login'];
		header("location:index.php");
	}
?>	
<?php
	mysqli_close($conn);
?>
</body>
</html>