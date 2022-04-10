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
	<title>Hàng hóa</title>
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
					<form class="navbar-form pull-left" role="search" action="hang-hoa.php" method="post">
			        	<div style="width: 120%; font-family:all" class="input-group" id="search1">
			           		<input id="search-input" name="tim-kiem" type="text" class="form-control" placeholder="Tìm kiếm tên hàng...">
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
				Hàng Hóa
			</h1>

		</div>
<?php
		$mess = false;
	if(isset($_GET['edit'])){
		$mssp= $_GET['edit'];
	}
	if(isset($_POST['add'])){
		$ten=$_POST['ten-hang'];
		$quycach=$_POST['quy-cach'];
		$gia=$_POST['gia'];
		$sl=$_POST['so-luong'];
		if(isset($_POST['ma-loai'])){
			$loaihang=$_POST['ma-loai'];
		} else $loaihang ='';
		$ghichu=$_POST['ghi-chu'];
		if(isset($_FILES['hinh-anh'])){
			$file= $_FILES['hinh-anh'];
			$file_name= 'location/'.$file['name'];
			move_uploaded_file($file['tmp_name'],$file_name);
			//tmp_name nơi lưu tạm file up load lên, dùng hàm muf để di chuyển nó ra khỏi thư mục tạm
		}

		$sql_add="insert into hanghoa (tenhh, quycach,gia, soluonghang,maloaihang,location,ghichu) values('$ten','$quycach','$gia',$sl,'$loaihang','$file_name','$ghichu');";
		if(mysqli_query($conn,$sql_add)){
			$mess = "Thêm hàng hóa thành công";
		} else $mess ="Thêm không thành công, vui lòng kiểm tra lại";
	}
	if(isset($_GET['delete'])){
		$ms_hh = $_GET['delete'];
		$sql_delete = "delete from hanghoa where mshh = '$ms_hh'";
		if(mysqli_query($conn, $sql_delete)){
			 $mess = "Xóa thành công";
		} else $mess= "xóa không thành công";
	}
	if(isset($_POST['sua-hh'])){
		// var_dump($_POST); exit;
		$ten_e = $_POST['ten-hang-e'];
		$quycach_e = $_POST['quy-cach-e'];
		$gia_e = $_POST['gia-e'];
		$sl_e = $_POST['so-luong-e'];
		$ml_e = $_POST['ma-loai-e'];
		// var_dump($ml_e); exit;
		$ghichu_e = $_POST['ghi-chu-e'];
		$kq_h = mysqli_query($conn,"select * from hanghoa where mshh = '$mssp'");
		$row_hhh = mysqli_fetch_assoc($kq_h);
		$tmp_hinh_hh = $row_hhh['location'];
		// var_dump($tmp_hinh_hh); exit;
		if(isset($_FILES['hinh-anh'])){
			$file= $_FILES['hinh-anh'];
			$file_name= 'location/'.$file['name'];
			if($file_name=='location/'){
				$file_name= $tmp_hinh_hh;
			}
			move_uploaded_file($file['tmp_name'],$file_name);
			//tmp_name nơi lưu tạm file up load lên, dùng hàm muf để di chuyển nó ra khỏi thư mục tạm
		} else $file_name='';
		// var_dump($file_name); exit;
		$sql_chg_hh = "update hanghoa set tenhh = '$ten_e', quycach = '$quycach_e', gia = '$gia_e', soluonghang = '$sl_e', maloaihang = '$ml_e', location ='$file_name', ghichu ='$ghichu_e' where mshh = '$mssp'";
		// var_dump($mssp); exit;
		if(mysqli_query($conn, $sql_chg_hh)){
			$thongbao = "Sửa hàng hóa thành công";
		} else $thongbao = "Sửa hàng hóa không thành công, kiểm tra lại!";
	}

	if(!isset($_GET['edit'])){ ?>	
		<hr class="hr-loai-hang">
		<div class="add-loai-hang">
			<div class="title-add-loai-hang">
				<h3><i class="fas fa-angle-double-right"></i>&ensp; Thêm hàng hóa</h3>
			</div>
			<form class="form-add-loai-hang form-hang-hoa" action="hang-hoa.php" method="post" enctype="multipart/form-data">
				<div class="add-ma-loai">
					<p>Nhập tên hàng hóa: </p>
					<input type="text" name="ten-hang" required="">
				</div>
				<div class="add-ten-loai">
					<p>Quy cách:</p>
					<input type="text" name="quy-cach" required="">
				</div>
				<div class="add-ten-loai">
					<p>Giá:</p>
					<input type="text" name="gia" required="">
				</div>
				<div class="add-ten-loai-hinh">
					<p>Hình ảnh:</p>
					<input type="file" name="hinh-anh" title="chọn hình ảnh" required="">
				</div>
				<div class="add-ten-loai">
					<p>Số lượng:</p>
					<input type="text" name="so-luong" required="">
				</div>
				<div class="add-ten-loai select-loai-hang">
					<p>Loại hàng:</p>
					<select class="select-1" name="ma-loai">
						<option></option>
<?php
	$select_loai_hang = "select * from loaihanghoa";
	$kq = mysqli_query($conn,$select_loai_hang);
	while($rowlh=mysqli_fetch_assoc($kq)){ ?>
						<option value="<?=$rowlh['maloaihang']?>">
							<?=$rowlh['tenloaihang']?>
						</option>
						
<?php } ?>						
					</select>
				</div>
				<div class="add-ten-loai">
					<p>Ghi chú:</p>
					<textarea class="add-ghi-chu" name="ghi-chu">
						
					</textarea>
				</div>
				<button class="btn-add-loai-hang" name="add">Thêm Vào</button>
			</form>
		</div>
<?php
	}
	if(isset($_GET['edit'])){
		// $mssp= $_GET['edit'];
		$hh_s = mysqli_query($conn, "select * from hanghoa where mshh = '$mssp'");
		$row_sp = mysqli_fetch_assoc($hh_s);
?>		
		<hr class="hr-loai-hang">
		<div class="add-loai-hang">
			<div class="title-add-loai-hang">
				<h3><i class="fas fa-angle-double-right"></i>&ensp; Sửa hàng hóa</h3>
			</div>
			<form class="form-add-loai-hang form-hang-hoa" action="hang-hoa.php?edit=<?=$mssp?>" method="post" enctype="multipart/form-data">
				<div class="add-ma-loai">
					<p>Mã số hàng hóa: <?=$mssp?> </p>
					<!-- <input type="submit" style="display: none;" value="<?=$mssp?>" name="ma-hh-e" required=""> -->
				</div>
				<div class="add-ma-loai">
					<p>Tên hàng: </p>
					<input style="color: red;" type="text" value="<?=$row_sp['tenhh']?>" name="ten-hang-e" required="">
				</div>
				<div class="add-ten-loai">
					<p>Quy cách:</p>
					<input style="color: red;" type="text" value="<?=$row_sp['quycach']?>" name="quy-cach-e" required="">
				</div>
				<div class="add-ten-loai">
					<p>Giá:</p>
					<input style="color: red;" type="text" value="<?=$row_sp['gia']?>" name="gia-e" required="">
				</div>
				<div class="add-ten-loai-hinh">
					<p>Hình ảnh* (vui lòng chọn lại):</p>
					<input type="file" name="hinh-anh" title="chọn hình ảnh" required="">
				</div>
				<div class="add-ten-loai">
					<p>Số lượng:</p>
					<input style="color: red;" type="text" value="<?=$row_sp['soluonghang']?>" name="so-luong-e" required="">
				</div>
				<div class="add-ten-loai select-loai-hang">
					<p>Loại hàng:</p>
					<select class="select-1" name="ma-loai-e">
<?php
	$s_lh_e = "select * from hanghoa as hh, loaihanghoa as lhh where hh.maloaihang=lhh.maloaihang and hh.mshh = '$mssp'";
	$kq_lh_e = mysqli_query($conn,$s_lh_e);
	$rowlh_e=mysqli_fetch_assoc($kq_lh_e);
?>						
						<option value="<?=$rowlh_e['maloaihang']?>"><?=$rowlh_e['tenloaihang']?></option>
<?php
	$select_loai_hang = "select * from loaihanghoa";
	$kq = mysqli_query($conn,$select_loai_hang);
	while($rowlh=mysqli_fetch_assoc($kq)){ ?>
						<option value="<?=$rowlh['maloaihang']?>">
							<?=$rowlh['tenloaihang']?>
						</option>
						
<?php } ?>						
					</select>
				</div>
				<div class="add-ten-loai">
					<p>Ghi chú:</p>
					<textarea style="color: red;" value="<?=$row_sp['tenhh']?>" class="add-ghi-chu" name="ghi-chu-e">
						
					</textarea>
				</div>
				<button type="submit" class="btn-add-loai-hang" name="sua-hh"> Sửa đổi</button>
			</form>
			<a style="font-size: 2em;" href="hang-hoa.php">+ Thêm hàng</a>
		</div>
	

<?php 
	}
?>
		<div class="hien-thi-hang-hoa">
<?php
	if(!empty($mess)){?>
		<h3 style="font-family: all; color: red; position: absolute; margin-left: 55%; margin-top:-50%"><?=$mess?></h3> 
<?php }
	if(!empty($thongbao)){ ?>
		<h3 style="font-family: all; color: red; position: absolute; margin-left: 55%; margin-top:-50%"><?=$thongbao?></h3>
<?php 
	}		
?>			
			<table class="table-hang-hoa">
				<th class="ten-hang">
					Tên hàng
				</th>
				<th class="quy-cach">
					Quy cách
				</th>
				<th>
					Giá
				</th>
				<th class="so-luong-hang">
					Số lượng
				</th>
				<th class="th-select-hinh">
					Ảnh
				</th>
				<th>
					Ghi chú
				</th>
				<th>
					Sửa
				</th>
				<th>
					Xóa
				</th>
<?php
	if(!isset($_POST['search'])){
		$sql_select_hh = "select * from hanghoa";
	}else if(isset($_POST['search'])){
		$ten_hang = $_POST['tim-kiem'];
		// echo $ten_hang; exit;	
		$sql_select_hh = "select * from hanghoa where tenhh like '%$ten_hang%'";
	}
	$kq_hang = mysqli_query($conn, $sql_select_hh); 
	while($rowhh= mysqli_fetch_assoc($kq_hang)){?>
				<tr>
					<td>
						<?=$rowhh['tenhh']?>
					</td>
					<td>
						<?=$rowhh['quycach']?>
					</td>
					<td>
						<?=number_format($rowhh['gia'],0,",",".")?> VNĐ
					</td>
					<td>
						<?=$rowhh['soluonghang']?>
					</td>
					<td class="td-anh-hh">
						<img src="<?=$rowhh['location']?>" alt="no image">
					</td>
					<td>
						<?=$rowhh['ghichu']?>
					</td>
					<td class="edit-hang-hoa">
						<a href="hang-hoa.php?edit=<?=$rowhh['mshh']?>"><i class="glyphicon glyphicon-edit"></i></a>
					</td>
					<td class="icon-remove-loai-hang remove_hang_hoa">
						<a href="?delete=<?=$rowhh['mshh']?>" ><i class="glyphicon glyphicon-remove-sign"></i></a>
					</td>
				</tr>
<?php } ?>
			</table>
		</div>

	</div>
</body>
</html>