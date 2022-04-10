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
	<title>Khách hàng</title>
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
					<form class="navbar-form pull-left" role="search" action="khach-hang.php" method="post">
			        	<div style="width: 120%; font-family:all" class="input-group" id="search1">
			           		<input id="search-input" name="tim-kiem" type="text" class="form-control" placeholder="Tìm kiếm khách hàng...">
			           		<div  class="input-group-btn">
			              		<button name="search" type="submit" id="search-button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			           		</div>
			            </div>
        			</form>
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
				khách hàng
			</h1>

		</div>
		
		<hr class="hr-loai-hang">
		<div class="add-loai-hang">
			<div class="title-add-loai-hang">
				<h3><i class="fas fa-angle-double-right"></i>&ensp; Thêm Khách Hàng</h3>
			</div>
			<form class="form-add-loai-hang form-hang-hoa" action="khach-hang.php" method="post" enctype="multipart/form-data">
				<div class="add-ma-loai">
					<p>Nhập tên khách hàng(*): </p>
					<input type="text" name="ten" title="nhập tên khách hàng" required="">
				</div>
				<div class="add-ten-loai-hinh">
					<p>Hình ảnh:</p>
					<input type="file" name="hinh-anh" title="chọn ảnh khách hàng">
				</div>
				<!-- MẬT KHẨU TỰ ĐỘNG -->
				<!-- <div class="add-ten-loai">
					<p>Mật khẩu:</p>
					<input type="text" required="">
				</div> -->
				<div class="add-ten-loai">
					<p>Tên công ty:</p>
					<input type="text" title="nhập tên công ty" name="ten-cong-ty">
				</div>
				<div class="add-ten-loai">
					<p>Số Điện Thoại(*):</p>
					<input type="text" name="sdt" title="nhập số điện thoại" required="">
				</div>
				<div class="add-ten-loai">
					<p>Email:</p>
					<input type="Email" name="email" title="nhập email">
				</div>
				<button class="btn-add-loai-hang" name="add">Thêm Vào</button>
			</form>
		</div>
<?php
	if(isset($_POST['add'])){
		$ten = $_POST['ten'];
		$tencty = $_POST['ten-cong-ty'];
		$sdt = $_POST['sdt'];
		$email = $_POST['email'];
//		mật khẩu tự động: dpcshop123

		if(isset($_FILES['hinh-anh'])){
			$file= $_FILES['hinh-anh'];
			$file_name= 'anhkh/'.$file['name'];
			move_uploaded_file($file['tmp_name'],$file_name);
			//tmp_name nơi lưu tạm file up load lên, dùng hàm muf để di chuyển nó ra khỏi thư mục tạm
		} else $file_name='';

		$sql_add = "insert into khachhang(hotenkh, matkhau, anhkh, tencongty, sodienthoai, email) values('$ten','224e86b329a794892bfa2afe7824e681','$file_name','$tencty','$sdt','$email')";
		$sql_select_kh = "select * from khachhang";
		$kq_select_kh = mysqli_query($conn,$sql_select_kh);
		$kt_sdt = 0;
		while($rowkh = mysqli_fetch_assoc($kq_select_kh)){
			if($sdt == $rowkh['sodienthoai']){
				$kt_sdt =1; break;
			}
		}
		if($kt_sdt){
			$mess = "Số điện thoại đã tồn tại, xin vui lòng đăng kí bằng số điện thoại khác";
		} else if(mysqli_query($conn, $sql_add)){
					$mess = "Thêm khách hàng thành công";
				} else $mess = "Thêm không thành công, vui lòng kiểm tra lại";
	}
?>
		<div class="hien-thi-khach-hang">
<?php
	if(!empty($mess)){?>
		<h3 style="font-family: all; color: red; position: absolute; margin-left: 55%; margin-top:-30%"><?=$mess?></h3> 
<?php }
		
?>				
			<table class="table-khach-hang">
				<th class="ms-khach-hang">
					STT
				</th>
				<th>
					Họ tên
				</th>
				<th>
					Tên công ty
				</th>
				<th>
					Số điện thoại
				</th>
				<th>
					Email
				</th>
				<th>
					Địa Chỉ
				</th>
				<th>
					Chi tiết
				</th>
<?php
	if(!isset($_POST['search'])){
		$sql_select_all_kh = "select * from khachhang";
	} else if(isset($_POST['search'])){
		$tenkh = $_POST['tim-kiem'];
		$sql_select_all_kh = "select * from khachhang where hotenkh like '%$tenkh%'";
	}
	$kq_select_all_kh = mysqli_query($conn, $sql_select_all_kh);
	$stt = 1;
	while($rowa_kh= mysqli_fetch_assoc($kq_select_all_kh)){ ?>			
				<tr>
					<td class="xem-khach-hang">
						<?=$stt?>
					</td>
					<td>
						<?=$rowa_kh['hotenkh']?>
					</td>
					<td>
						<?=$rowa_kh['tencongty']?>
					</td>
					<td>
						<?=$rowa_kh['sodienthoai']?>
					</td>
					<td class="format-email">
						<?=$rowa_kh['email']?>
					</td>
					<td class="xem-khach-hang">
						<a href="diachi-kh.php?ms=<?=$rowa_kh['mskh']?>">Xem</a>
					</td>
					<td class="xem-khach-hang">
						<a href="info-khach-hang.php?chitiet=<?=$rowa_kh['mskh']?>"><i class="fas fa-user-edit"></i></a>
					</td>
				</tr>
<?php 
		$stt ++;
	} 
?>	
			</table>
		</div>
	</div>
<?php	
// mysqli_free_result($resutl);
mysqli_close($conn);
?>
</body>
</html>
