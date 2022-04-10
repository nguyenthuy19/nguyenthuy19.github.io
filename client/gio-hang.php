<?php
	ob_start();
	session_start(); 
	$conn = mysqli_connect('localhost', 'root', '', 'dathang') or die ('Không thể kết nối tới database');
	if(!isset($_SESSION['loginKH'])){
		header("location:login-kh.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Giỏ hàng</title>

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
	<link rel="stylesheet" href="cart.css">

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
	if (isset($_SESSION['loginKH'])){
		if(isset($_GET['log-out-kh'])){
			unset($_SESSION['loginKH']);
		}
	}
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
		$mskh_dh =$row_mskh['mskh'];
		$arr_tenkh = explode(' ',$row_mskh['hotenkh']);
		$sl_arr = count($arr_tenkh);
		$ten_kh = $arr_tenkh[$sl_arr -1];
		// var_dump($ten_kh); exit;	

?>				<li>
					<a style="color: #fff; background-color: rgb(237, 20, 93);" class="dropdown-toggle" data-toggle="dropdown" href="#" ><?=$ten_kh?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a style="color:black;" href="my-account-kh.php?ms=<?=$row_mskh['mskh']?>"><i class="fas fa-user"></i>Thông tin</a></li>
						<li><a style="color:black;" href="don-mua.php"><i class="fas fa-clipboard-list"></i>Đơn mua</a></li>
						<li><a style="color: red;" href="index.php?log-out-kh"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a></li>
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
	//tạo rỗng
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	$err = false;
	$oder_thanhcong = false;
	if(isset($_GET['action'])){
		// if(isset($_POST['dia-chi'])){
		// 	$dia_chi_kh = $_POST['dia-chi'];
		// } else $dia_chi_kh ='';
		// var_dump($dia_chi_kh); exit;
		function update_cart($add=false){
			foreach ($_POST['sanpham'] as $id => $soluong) {
				if($soluong==0){
					unset($_SESSION["cart"][$id]);
				} else{
					if($add){
		 			$_SESSION["cart"][$id]+=$soluong; //sử dụng header tránh báo lỗi php $id trước
					} else {
			 			$_SESSION["cart"][$id]=$soluong;
			 			}
				}
		 	}
		}
		switch($_GET['action']){

			case'add': //trang chi tiết đẩy qua
				update_cart(true);
				header("location:gio-hang.php");
			case 'xoa':
				if(isset($_GET['id'])){
					$id_xoa = $_GET['id'];
					unset($_SESSION['cart'][$id_xoa]);
				}
				// header("location:gio-hang.php");
			break;
			case 'submit':
				if(isset($_POST['update-cart'])){
					update_cart();
					header("location:gio-hang.php");
				}
				// header("location:gio-hang.php");
				else if(isset($_POST['dat-hang'])){ //đặt hàng
					if(!isset($_POST['dia-chi'])){
						$err = "Bạn Chưa có địa chỉ nhận hàng";
					} else if(isset($_POST['dia-chi'])) {
						$dia_chi_kh = $_POST['dia-chi'];
					} 
					if(empty($_POST['sanpham'])){
						$err = "Giỏ hàng rỗng";	
					}
					if($err==false && !empty($_POST['sanpham'])){ //lưu cơ sở dữ liệu
						$string_id = implode(",", array_keys($_POST['sanpham']));
						$sql_ht_id = "select * from hanghoa where mshh in ($string_id)";
						$id_cart = mysqli_query($conn,$sql_ht_id);
						$tong =0;
						while($row_cart = mysqli_fetch_assoc($id_cart)){
							// var_dump($_POST['sanpham'][$row_cart['mshh']]); lấy số lượng sản phẩm có mshh? exit;
							$tong += $_POST['sanpham'][$row_cart['mshh']] * $row_cart['gia'];
							$arr_pro_cart[] = $row_cart;	
						}
						$dat_hang= mysqli_query($conn, "INSERT INTO dathang(mskh,msnv,ngaydh,ngaygh,giadonhang,diachigiaohang,trangthai) VALUES ('$mskh_dh','ADMIN',CURRENT_DATE(),ADDDATE(DATE(NOW()),INTERVAL 7 DAY),$tong,'$dia_chi_kh',0);"); //thêm giá đơn hàng vào trước địa chỉ
						$oderID = $conn -> insert_id;
						// var_dump($arr_pro_cart); exit;
						$string_fetch_chitiet ="";
						foreach ($arr_pro_cart as $id => $sp) {
							if($sp['soluonghang'] < $_POST['sanpham'][$sp['mshh']]){
								$err = "Số lượng hàng <strong>  ".$sp['tenhh']."</strong> không đủ";
								$xoadonhang=mysqli_query($conn,"delete from dathang where sodondh=$oderID;");
								break;
							} else{// đủ số lượng
								$string_fetch_chitiet.="('".$oderID."','".$sp['mshh']."','".$_POST['sanpham'][$sp['mshh']]."','".$sp['gia']."',0)";
								if($id != count($arr_pro_cart)-1){
			 						$string_fetch_chitiet.=","; //ngăn cách bằng dấu phẩy
			 					}
			 					mysqli_query($conn, "UPDATE hanghoa SET soluonghang = (soluonghang - ".$_POST['sanpham'][$sp['mshh']].") where mshh=".$sp['mshh']."");
							}
						}
						$insertchitiet=mysqli_query($conn,"INSERT INTO chitietdathang(sodondh,mshh,soluong,giadathang,giamgia) VALUES ".$string_fetch_chitiet."; ");
						$oder_thanhcong = "Đặt hàng thành công!";
						if(empty($err)){
			 				unset($_SESSION['cart']);
			 			}

					}
				}
				
		}
		
	} 
	if(!empty($_SESSION['cart'])){
		$string_sp = implode(",", array_keys($_SESSION['cart'])); //lấy ra các id sp trong session cart
		$sql_cart = "select * from hanghoa where mshh in($string_sp)";
		$product = mysqli_query($conn,$sql_cart);
		// var_dump(implode(",", array_keys($_SESSION['cart']) )); exit;

	}
	
	if(!empty($err)){	
?>	
	<div style="text-align: center;">		
		<h1><?= $err ?>. <a style="border:none;font-size: 30px; " href="javascript:history.back()">Quay Lại</a> </h1>	
	</div>
<?php
	}
	else if(!empty($oder_thanhcong)){ ?>
	<div style="text-align: center;">		
		<h1><?= $oder_thanhcong ?>. <a style="border:none;font-size: 30px; " href="index.php">Tiếp tục mua hàng</a> </h1>	
	</div>	

<?php 		 
	} else{
?>		
	<div class="container">
		<div class="content-cart">
			<h1>
				Giỏ hàng
			</h1>
			<form action="gio-hang.php?action=submit" method="post">
				<table class="table-cart">
					<tr>
						<th class="th-stt">STT</th>
						<th class="th-ten">Tên Hàng</th>
						<th class="th-hinh">Hình Ảnh</th>
						<th class="th-don-gia">Đơn Giá</th>
						<th class="th-sl">Số Lượng</th>
						<th class="th-thanh-tien">Thành Tiền</th>
						<th class="th-xoa">Xóa</th>
					</tr>
<?php
	if(!empty($product)){
		$stt = 1;
		$sum = 0;
		while($row = mysqli_fetch_assoc($product)) {
	
?>					
					<tr class="tr-sp">
						<td>
							<?=$stt?>
						</td>
						<td class="td-ten">
							<?=$row['tenhh']?>
						</td>
						<td class="td-hinh">
							<img src="../admin/<?=$row['location']?>" alt="hình ảnh">
						</td>
						<td>
							<?=number_format($row['gia'],0,",",".")?>đ
						</td>
						<td class="td-sl">
							<input type="text" name="sanpham[<?=$row['mshh']?>]" id="" value="<?=$_SESSION['cart'][$row['mshh']]?>">
						</td>
						<td>
							<?=number_format($row['gia'] * $_SESSION['cart'][$row['mshh']],0,",",".")?>đ
						</td>
						<td class="td-xoa">
							<a href="gio-hang.php?action=xoa&id=<?=$row['mshh']?>"><i class="fas fa-trash-alt"></i></a>
						</td>
					</tr>
<?php
		$stt++;
		$sum += $row['gia'] * $_SESSION['cart'][$row['mshh']];
		} 
?>
<?php 
		{							
?>			
					<tr class="tr-sp">
						<td>
							&nbsp;
						</td>
						<td class="td-ten" style="font-size: 1.5em; text-align: center;">
							Tổng tiền
						</td>
						<td class="td-hinh">
							&nbsp;
						</td>
						<td>
							&nbsp;
						</td>
						<td class="td-sl">
							&nbsp;
						</td>
						<td style="color:red;">
							<?=number_format($sum,0,",",".")?>đ
						</td>
						<td>
							
						</td>
					</tr>
<?php
		} 	
	}
?>					
					
				</table>
				<button class="btn-update-cart" name="update-cart">Cập nhật giỏ hàng</button>
				<hr style="border-bottom: 0.5px solid grey;">
				<div class="click-dc">
					<h3>Chọn địa chỉ giao hàng:</h3>
					<select name="dia-chi">
<?php
	if(isset($_SESSION['loginKH'])){
		$sql_ht_dc = "select * from diachikh where mskh = '$mskh'";
		$kq_ht_dc = mysqli_query($conn, $sql_ht_dc);
		while($row_dc_kh=mysqli_fetch_assoc($kq_ht_dc)){
?>								
						<option value="<?=$row_dc_kh['diachi']?>" style="text-transform: capitalize;"><?=$row_dc_kh['diachi']?></option>
<?php
		} 
	}
?>						
					</select>			
					<a href="dia-chi-kh.php?ms=<?=$mskh?>">+Thêm địa chỉ</a>
				</div>
				<button class="btn-dat-hang" name="dat-hang">Đặt hàng</button>
			</form>
			
		</div>
		
	</div>
<?php 
	}
?>		


	
</body>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>