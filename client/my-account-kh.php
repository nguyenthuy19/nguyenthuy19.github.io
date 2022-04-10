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
	<title>account</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
  	<!-- import Font Awesome 5 facebook -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  	<!-- google font -->
  	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Ephesis&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="../admin/my-account-nv.css">
	<link rel="stylesheet" href="my-account-kh.css">
</head>
<body>
	<nav class="navbar  navbar-fixed-top" style="font-weight: bold;">
		<div class="container-fluid">
			<div class="navbar-header" >
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="index.php" class="navbar-brand"><img class="dpcshop-brand" src="./images/logo1.jpg" alt=""></a>
			</div>
			<div class="collapse navbar-collapse" id="mynav">
				<ul class="nav navbar-nav"> 
				<li>
					<a href="index.php"> Trang chủ</a>
				</li>
				<!-- <li>
					<a href="#">Liên hệ</a>
				</li> -->
				<li>
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Sản phẩm  <span class="caret"></span></a>
					<ul class="dropdown-menu">
<?php
	$select_lh_sp = "select * from loaihanghoa";
	$kq_select_lh_sp = mysqli_query($conn,$select_lh_sp);
	while($row_lh_sp=mysqli_fetch_assoc($kq_select_lh_sp)){
?>
						<li><a style="color: black;" href="index.php?ml=<?=$row_lh_sp['maloaihang']?>"><?=$row_lh_sp['tenloaihang']?></a></li>
<?php 
	}
?>
					</ul>
				</li>
				<li>
					<form class="navbar-form pull-left" role="search" action="index.php" method="get">
			            <div class="input-group" id="search1">
			               <input id="search-input" name="tim-kiem" type="text" class="form-control" placeholder="Tìm kiếm...">
			               <div  class="input-group-btn">
			                  <button name="search" type="submit" id="search-button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			               </div>
			            </div>
        			</form>
				</li>
				
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="gio-hang.php"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng</a>
				</li>
				<li>
					<a href="dang-ki.php"><span class="glyphicon glyphicon-user"></span> Đăng kí</a>
				</li>
<?php
	if(!isset($_SESSION['loginKH']) || isset($_GET['log-out-kh']) ){
?> 				
				<li>
					<a href="login-kh.php" ><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a>
				</li>
<?php 				
	} else{	
		$mskh = $_SESSION['loginKH'];
		$kq_mskh = mysqli_query($conn, "select * from khachhang where mskh='$mskh' ");
		$row_mskh = mysqli_fetch_assoc($kq_mskh);
		$arr_tenkh = explode(' ',$row_mskh['hotenkh']);
		$sl_arr = count($arr_tenkh);
		$ten_kh = $arr_tenkh[$sl_arr -1];
		// var_dump($ten_kh); exit;	

?>				<li>
					<a style="color: #fff; background-color: rgb(237, 20, 93);" class="dropdown-toggle" data-toggle="dropdown" href="#" ><?=$ten_kh?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a style="color:black;" href="my-account-kh.php?ms=<?=$row_mskh['mskh']?>"><i class="fas fa-user"></i>Thông tin</a></li>
						<li><a style="color:black;" href="don-mua.php"><i class="fas fa-clipboard-list"></i>Đơn mua</a></li>
						<li><a style="color: red;" href="my-account-kh.php?log-out-kh"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a></li>
					</ul>
				</li>
<?php
		}	
?>			
			</ul>
			</div>
			
			
		</div>
	</nav>

<?php 
	
if(isset($_SESSION['loginKH'])){
	if(isset($_GET['log-out-kh'])){
		unset($_SESSION['loginKH']);
		header("location:index.php");
	}
	if(isset($_GET['ms'])){
		$msnv = $_GET['ms'];
		$kq_search = mysqli_query($conn,"select * from khachhang where mskh='$msnv'");
		$row = mysqli_fetch_assoc($kq_search);
		$ton_tai = 0;
		if(!empty($row['mskh'])){
			$ton_tai =1;
			// echo $row_kq['msnv'];
		}
		if($ton_tai==0 || $msnv!=$_SESSION['loginKH']){
			echo "<h1>không có thông tin để hiển thị!</h1>";
		} 
		else {
			// $kq = mysqli_query($conn,)


?>
	<div class="main">
		<div class="title-myacc">
			<h1>Xem và cập nhật thông tin của bạn</h1>
			
		</div>

		<div class="info-nv">
<?php
	if(isset($_POST['load-anh'])){
		$tmp_hinhkh = $row['anhkh'];
		if(isset($_FILES['hinh-anh'])){
			// echo "Dương Phương Cương"; exit;
			$file= $_FILES['hinh-anh'];
			$file_name= 'anhkh/'.$file['name'];
			if($file_name=='anhkh/'){
				$file_name= $tmp_hinhkh;
			}
			move_uploaded_file($file['tmp_name'],"../admin/".$file_name);
			//tmp_name nơi lưu tạm file up load lên, dùng hàm muf để di chuyển nó ra khỏi thư mục tạm
		} else $file_name='';
		$sql_chg_img_kh = "update khachhang set anhkh='$file_name' where mskh ='$msnv' ";
		if(mysqli_query($conn,$sql_chg_img_kh)){
			$err = "update ảnh thành công!";
		} else $err = "update ảnh không thành công, vui lòng kiểm tra lại!";

	}

	if($row['anhkh']!="" && !isset($_GET['add-img']) ){ 
?>
			<div class="img-nv">
				<img src="../admin/<?=$row['anhkh']?>" alt="hình ảnh">
				<a href="my-account-kh.php?ms=<?=$row['mskh']?>&add-img">Thay đổi ảnh <i class="fas fa-undo"></i></a>
				<br>
				<a style="color: red;" href="dia-chi-kh.php?ms=<?=$row['mskh']?>">Xem (+Thêm) địa chỉ</a>
			</div>
			<br>
			

<?php 
	} else if($row['anhkh']=="" && !isset($_GET['add-img'])){
?>
			<div class="img-nv">
				<i style="font-size: 8em;" class="fas fa-user"></i>
				<a href="my-account-kh.php?ms=<?=$row['mskh']?>&add-img">+ Thêm ảnh</a>
			</div>
<?php 	
			}


	if(isset($_GET['add-img'])){			
?>
			<div class="img-nv">
				<form action="my-account-kh.php?ms=<?=$row['mskh']?>" method="post" enctype="multipart/form-data"  >
					<div class="add-ten-loai-hinh">
						<p>Hình ảnh: <span style="color: red;"><small>(chọn ảnh của bạn)</small></span></p>
						<input type="file" name="hinh-anh" value="<?=$row['anhnv']?>" title="chọn ảnh của bạn">
					</div>
					<button style="margin-top: 5px; background-color: orange;" name="load-anh">Tải lên</button>
				</form>
				
			</div>
<?php 
				}
?>				
			<div class="info">
				<table>
					<tr>
						<td class="td-left">
							Mã số:
						</td>
						<td>
							<?=$row['mskh']?>
						</td>
					</tr>
					<tr>
						<td class="td-left">
							Họ Tên:
						</td>
						<td>
							<?=$row['hotenkh']?>
						</td>
					</tr>
					<tr>
						<td class="td-left" >
							Công Ty:
						</td>
						<td>
							<?=$row['tencongty']?>	
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
					<tr>
						<td class="td-left">
							Email:
						</td>
						<td style="text-transform: lowercase;">
							<?=$row['email']?>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<hr class="hr-acc">
				<!-- BUTTON GỬI GET chinh-sua -->
		<div class="title-change-nv">
			<form action="my-account-kh.php?ms=<?=$row['mskh']?>" method="post">
				<button  class="btn-add-nv" name="btn-add-nv">
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
			<form action="my-account-kh.php?ms=<?=$row['mskh']?>" method="post">
				<input type="password" name="password">
				<button class="btn-mk" name="btn-mk">ok</button>
			</form>
		</div>
<?php
	}
if(isset($_POST['change-btn-nv'])){
	// $manv= $_POST['manv'];
	$tennv = $_POST['tennv'];
	$cong_ty = $_POST['cong-ty'];
	$email_chg = $_POST['email'];
	$new_pass= MD5($_POST['newpass']);
	$re_pass = MD5($_POST['re-newpass']);
	if($new_pass!=$re_pass){ ?>
		<div class="tb-xoa-nv" >
			<h2>Xác nhận mật khẩu sai, xin vui lòng kiểm tra lại!
			</h2>
			<a style="font-size: 2em; font-weight: bold; color: white;" href="javascript:history.back()">OK</a>
		</div>


<?php
	} 
	else{
		$sdt = $row['sodienthoai'];	
		$sql_change = "update khachhang set hotenkh='$tennv',matkhau='$new_pass', tencongty ='$cong_ty', email = '$email_chg' where sodienthoai = '$sdt'";
		if(mysqli_query($conn,$sql_change)){
								$err = "Sửa Thông tin thành công";
		} else $err = "Sửa không thành công, vui lòng kiểm tra lại";

	}
}

	if(isset($_POST['btn-mk'])){
		$pass=MD5($_POST['password']);
		$sql_kt_mk = "select * from khachhang where mskh = '$msnv' and matkhau = '$pass'";
		$kq_kt_mk = mysqli_query($conn, $sql_kt_mk);
		// var_dump($kq_kt_mk); exit;
		$row_kt_mk = mysqli_fetch_assoc($kq_kt_mk);
		if(empty($row_kt_mk['mskh'])){
			$err = "Mật khẩu không đúng, xin vui lòng thử lại";
			// echo "không đúng mật khẩu";
		} else if(!empty($row_kt_mk['mskh'])){


?> 
				<!-- SAU KHI NHẬP MẬT KHẨU THÌ CHỈNH SỬA -->

		<div class="change-nv">
			<form class="form-add-loai-hang" action="my-account-kh.php?ms=<?=$row['mskh']?>" method="post" enctype="multipart/form-data">
			
				<div class="add-ma-loai" style="display: flex;">
					<p>Mã khách hàng: </p> <p class="ttht-nv">&ensp;<?=$row['mskh']?></p>
				</div>
				<div class="add-ten-loai">
					<p>Tên khách hàng:</p>
					<input type="text" name="tennv" class="ttht-nv" value="<?=$row['hotenkh']?>" required="">
				</div>
				
				<div class="add-ten-loai">
					<p>Tên công ty:</p>
					<input type="text" name="cong-ty" class="ttht-nv" value="<?=$row['tencongty']?>" required="">
				</div>
				<div class="add-ma-loai" style="display: flex;">
					<p>Số điện thoại: </p> <p class="ttht-nv">&ensp;<?=$row['sodienthoai']?></p>
				</div>
				<div class="add-ten-loai">
					<p>Email</p>
					<input type="text" class="ttht-nv" value="<?=$row['email']?>" name="email" required="">
				</div>
				<div class="add-ten-loai">
					<p>Mật khẩu mới:</p>
					<input type="password" class="ttht-nv" name="newpass" required="">
				</div>
				<div class="add-ten-loai">
					<p>Xác nhận mật khẩu:</p>
					<input type="password" class="ttht-nv" name="re-newpass" required="">
				</div>
				
				

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
}

?>




</body>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>
