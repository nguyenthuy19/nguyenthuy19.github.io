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
	<title>Document</title>

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
	<link rel="stylesheet" href="dia-chi-kh.css">
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
			<h1>Cập Nhật Địa Chỉ Của Bạn</h1>
			
		</div>
		<h3>Tất cả địa chỉ</h3>
		<table class="table-dia-chi">
			<tr>
				<th class="th-stt">STT</th>
				<th class="th-dc">Địa chỉ</th>
				<th class="th-xoa">Xóa</th>
			</tr>
<?php
	if(isset($_GET['xoa'])){
		$madc = $_GET['xoa'];
		$sql_xoa_dc = "delete from diachikh where madc = '$madc'";
		if(mysqli_query($conn, $sql_xoa_dc)){
			$err = "Xóa địa chỉ thành công!";
		} else $err = "Xóa thất bại, vui lòng kiểm tra lại!";
		// $kq_xoa_dc = ;
	}
	if(isset($_POST['btn-add'])){
		$dia_chi=$_POST['dia-chi'];
		$sql_add_dc = "insert into diachikh value('','$dia_chi','$msnv')";
		if(mysqli_query($conn, $sql_add_dc)){
			$err= "Thêm địa chỉ thành công!";
		} else $err = "Thêm Thất bại, vui lòng kiểm tra lại!";
	}

	$sql_dc = "select * from diachikh where mskh = '$msnv'";
	$kq_dc = mysqli_query($conn, $sql_dc);
	$stt = 1;
	while($row_dc = mysqli_fetch_assoc($kq_dc)){
?>				
			<tr>
				<td><?=$stt?></td>
				<td class="td-dc">
					<?=$row_dc['diachi']?>
				</td>
				<td>
					<a href="dia-chi-kh.php?ms=<?=$msnv?>&xoa=<?=$row_dc['madc']?>">Xóa</a>
				</td>
			</tr>
<?php
	$stt++; 
	}
?>			
		</table>
		<a class="a-add-dc" href="dia-chi-kh.php?ms=<?=$msnv?>&add-dc">+Thêm địa chỉ</a>
<?php
	if(isset($_GET['add-dc'])){
?>	
		<div class="ad-dia-chi">
			<form action="dia-chi-kh.php?ms=<?=$msnv?>" method="post">
				<input type="text" name="dia-chi" id="" placeholder="Nhập Địa Chỉ">
				<button name="btn-add" class="btn-add">Thêm Vào</button>
			</form>
		</div>
<?php
	}
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
