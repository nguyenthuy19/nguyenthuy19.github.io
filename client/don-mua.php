<?php
	ob_start();
	session_start(); 
	$conn = mysqli_connect('localhost', 'root', '', 'dathang') or die ('Không thể kết nối tới database');
	if(!isset($_SESSION['loginKH'])){
		header("location:index.php");
	}
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
					<a href="#">Liên hệ</a>
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
	$ms = $_SESSION['loginKH'];
	$ht_don = "select * from dathang where mskh = '$ms' order by sodondh DESC";
	$query_don = mysqli_query($conn, $ht_don);
}
?>
	<div class="main">
		<div class="title-myacc">
			<h1>Đơn hàng của bạn</h1>
			
		</div>
		<h3>Tất cả địa chỉ</h3>
		<table class="table-dia-chi">
			<tr>
				<th class="th-stt">STT</th>
				<th>Ngày đặt hàng</th>
				<!-- <th>Ngày giao hàng</th> -->
				<th>Trạng thái</th>
				<th class="th-xoa">xem</th>
			</tr>
<?php
	$stt = 1;
	while($row_don = mysqli_fetch_assoc($query_don)){ 
?>			
			<tr>
				<td><?=$stt?></td>
				<td><?=$row_don['ngaydh']?></td>
				
				<td>
					
					<?php
						if($row_don['trangthai']==0){
							echo "<p style='color: red'>Chờ duyệt</p>";
						} else {
							echo "Ngày giao: " .$row_don['ngaygh'];
						}
					?>
				</td>
				<td>
					<a href="chi-tiet-don-mua.php?sodon=<?=$row_don['sodondh']?>">Xem</a>
				</td>
			</tr>

<?php
	$stt++;
	}
?>

</body>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>
