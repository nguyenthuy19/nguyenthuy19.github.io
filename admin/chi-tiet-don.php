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
	<title>Chi tiết đơn hàng</title>
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
	<link rel="stylesheet" href="chi-tiet-don.css">
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
<?php
	if(!isset($_GET['ms']) || !isset($_GET['diachi']) || !isset($_GET['mkh']) ){
		echo "<h1>Không có thông tin để hiển thị</h1>";
	} else if(isset($_GET['ms']) && isset($_GET['mkh']) && isset($_GET['diachi']) ){
		$msdon = $_GET['ms'];
		$diachi = $_GET['diachi'];
		$mkh = $_GET['mkh'];
		$ht_kh = mysqli_query($conn, "select * from khachhang where mskh = '$mkh'");
		$row_kh = mysqli_fetch_assoc($ht_kh);

		$sql_kt_don = "select * from chitietdathang";
		$kq_kt = mysqli_query($conn,$sql_kt_don);
		$kt = 0;
		while($row_kt=mysqli_fetch_assoc($kq_kt)){
			if($row_kt['sodondh']==$msdon){
				$kt =1;
				break;
			}
		}
		if($kt == 0){
			echo "<h1>Đơn hàng không tồn tại</h1>";
		} else if($kt == 1){
?>		
		<div class="title-loaihanghoa">
			<h1>
				chi tiết đơn hàng
			</h1>

		</div>
		<hr class="hr-loai-hang">
		<h3 style=" font-family: all; font-weight: bold; text-transform: capitalize; ">Tên khách hàng: <?=$row_kh['hotenkh']?></h3>
		<h4 style=" font-family: all; font-weight: bold; text-transform: capitalize; ">Địa chỉ: <?=$diachi?></h4>
		<div class="hien-thi-don-hang">
			<table class="table-don-hang">
				<tr>
					<th style="width: 5%;"> STT</th>
					<th>Tên hàng</th>
					<th class="th-anh">Ảnh</th>
					<th>Giá</th>
					<th>Số Lượng</th>
					<th>Thành Tiền</th>
				</tr>
<?php
 	$sql = "select * from chitietdathang as ct, hanghoa as hh where ct.mshh = hh.mshh and sodondh = '$msdon'";
 	$kq = mysqli_query($conn, $sql);
 	$stt= 1;
 	$tong = 0;
 	while($row = mysqli_fetch_assoc($kq)){ 
?>				
				<tr>
					<td>
						<?=$stt?>
					</td>
					<td class="td-ten">
						<?=$row['tenhh']?>
					</td>
					<td class="td-anh" style="align-items: center;">
						<img src="<?=$row['location']?>" alt="">
					</td>
					<td class="td-gia">
						<?=number_format($row['giadathang'],0,",",".")?> VNĐ
					</td>
					<td class="td-sl">
						<?=$row['soluong']?>
					</td>
					<td class="td-thanh-tien">
						<?=number_format($row['soluong'] * $row['giadathang'],0,",",".") ?> VNĐ
					</td>
					
				</tr>
<?php
	$tong += $row['soluong'] * $row['giadathang'];
	$stt++;
	} 
?>				<tr>
					<td>&nbsp;</td>
					<td style="font-size: 1.2em; font-weight: bold;">Tổng tiền</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td style="font-weight:bold;"><?=number_format($tong,0,",",".")?> VNĐ</td>
				</tr>
			</table>
			<form action="dat-hang.php" method="post">
				<button style="margin-top: 2%;">Quay lại đơn hàng</button>
			</form>
		</div>
<?php
			}
	} 
?>		
	</div>
</body>
</html>
