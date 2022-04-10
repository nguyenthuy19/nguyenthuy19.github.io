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
	<title>Đơn hàng</title>
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
			<ul class="nav navbar-nav">
				<li>
					<form class="navbar-form pull-left" role="search" action="dat-hang.php" method="post">
			        	<div style="width: 100%; font-family:all" class="input-group" id="search1">
			           		<input id="search-input" name="tim-kiem" type="date" class="form-control" placeholder="Tìm kiếm ()...">
			           		<div  class="input-group-btn">
			              		<button name="search" type="submit" id="search-button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			           		</div>
			            </div>
        			</form>
				</li>
				<li>
					<a style="font-family: all; text-transform: uppercase;" href="dat-hang.php?da-duyet">Đã duyệt</a>
				</li>
				<li>
					<a style="font-family: all; text-transform: uppercase;" href="dat-hang.php?chua-duyet">Chưa duyệt</a>
				</li>
			</ul>
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
				đơn hàng
			</h1>

		</div>
		<hr class="hr-loai-hang">
	
		<div class="hien-thi-don-hang">
			<table class="table-don-hang">
				<tr>
					<th>STT</th>
					<th> Số Đơn</th>
					<th>Mã KH</th>
					<th>Mã Nhân Viên</th>
					<th>Ngày Đặt Hàng</th>
					<th>Ngày Giao Hàng</th>
					<th>Trạng Thái</th>
					<th>Chi Tiết</th>
					<th>Xóa</th>
				</tr>
<?php
	if(isset($_SESSION['loginAdmin']) || isset($_SESSION['loginNV'])){
		if(isset($_SESSION['loginAdmin'])){
			$msnv = $_SESSION['loginAdmin'];
		}
		if(isset($_SESSION['loginNV'])){
			$msnv = $_SESSION['loginNV'];
		}
		if(isset($_GET['duyet'])){
			$ms_duyet = $_GET['duyet'];
			$kq_duyet = mysqli_query($conn, "update dathang set trangthai = 1, msnv ='$msnv' where sodondh='$ms_duyet'");
			if($kq_duyet){
				echo "<h3 style = 'color: red; text-align: center;'>Duyệt thành công đơn hàng</h3>";
			} else echo "<h3 style = 'color: red; text-align: center;'>Duyệt không thành công, vui lòng kiểm tra lại</h3>";
		}
		if(isset($_GET['xoa'])){
			$xoadon = $_GET['xoa'];
			$sql_xoa = "delete from dathang where sodondh = '$xoadon'";
			if(mysqli_query($conn,$sql_xoa)){
				echo "<h3 style = 'color: red; text-align: center;'>Xóa thành công đơn hàng</h3>";
			} else  echo  "<h3 style = 'color: red; text-align: center;'>Xóa không thành công, vui lòng kiểm tra lại!</h3>";
		}
	}
	if(isset($_POST['search'])){
		$ful_ngay = $_POST['tim-kiem'];
		// var_dump($ful_ngay); exit;
		$slq_ht_don = "SELECT * FROM dathang where ngaydh ='$ful_ngay' ORDER BY sodondh DESC";  
	} else
	if(!isset($_POST['search']) && !isset($_GET['chua-duyet']) && !isset($_GET['da-duyet']) ){
		$slq_ht_don = "SELECT * FROM dathang ORDER BY sodondh DESC";  
	}else if(isset($_GET['chua-duyet']) && !isset($_GET['da-duyet'])){
		$slq_ht_don = "SELECT * FROM dathang where trangthai = 0 ORDER BY sodondh DESC"; 
	}else if(isset($_GET['da-duyet'])){
		$slq_ht_don = "SELECT * FROM dathang where trangthai = 1 ORDER BY sodondh DESC"; 
	} 
	$kq_ht_don = mysqli_query($conn,$slq_ht_don);
	$stt = 1;
	while($row = mysqli_fetch_assoc($kq_ht_don)){
?>				
				<tr>
					<td>
						<?=$stt?>
					</td>
					<td>
						<?=$row['sodondh']?>
					</td>
					<td>
						<?=$row['mskh']?>
					</td>
					<td>
						<?php 
							if($row['trangthai']==1){
								echo $row['msnv'];
							} else {
								echo "";
							}
						?>
					</td>
					<td>
						<?=$row['ngaydh']?>
					</td>
					<td>
						<?=$row['ngaygh']?>
					</td>
					<td class="td-center">
						<?php 
							if($row['trangthai']==1){
								echo "Đã duyệt";
							} else { ?>
								<a href="dat-hang.php?duyet=<?=$row['sodondh']?>">Duyệt đơn</a>
						<?php 		
							}
						?>
						
					</td>
					<td class="td-center">
						<a href="chi-tiet-don.php?ms=<?=$row['sodondh']?>&mkh=<?=$row['mskh']?>&diachi=<?=$row['diachigiaohang']?>"><i class="fas fa-edit"></i></a>
					</td>
					<td class="td-xoa">
						<?php 
							if($row['trangthai']==0){ ?>
						<a href="dat-hang.php?xoa=<?=$row['sodondh']?>"><i class="fas fa-trash-alt"></i></a>
						<?php
							} else echo " ";
						?>
					</td>
				</tr>
<?php
	$stt++;
	} 
?>				
			</table>
		</div>
	</div>
</body>
</html>
