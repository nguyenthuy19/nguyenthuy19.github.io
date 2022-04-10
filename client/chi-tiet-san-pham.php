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
	<title>Sản Phẩm</title>

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
	if(!isset($_GET['msp'])){
		echo "<h1>Không có thông tin để hiển thị</h1>";
	} else
	if(isset($_GET['msp'])){ 
		$msp = $_GET['msp'];
		$sql_sp = "select * from hanghoa where mshh = '$msp'";
		$kq_sp = mysqli_query($conn,$sql_sp);
		$row_sp = mysqli_fetch_assoc($kq_sp);
?>
	<div class="content-ct container">
		<div class="row">
			<h1 style="text-align: left;">Thông tin sản phẩm</h1>
			<hr style="width: 100%;" class="hr-ct">
			<div class="chi-tiet-sp">
				<div class="img-chi-tiet col-lg-6 col-md-6">
					<img src="../admin/<?=$row_sp['location']?>" alt="">
				</div>
				<div class="img-content-ct col-lg-6 col-md-6">
					<div class="ten-ct-sp">
						<h2><?=$row_sp['tenhh']?></h2>
					</div>
					<div class="gia-ct-sp">
						<h3>Giá:</h3><h3 class="h3-gia"><?=number_format($row_sp['gia'],0,",",".")?> đ</h3>
					</div>
					<div class="kho">
						<h4>Số lượng trong kho: </h4> <h4 class="sl-kho"><?=$row_sp['soluonghang']?></h4>
					</div>
					<hr class="hr-ct-1" >
					<form action="gio-hang.php?action=add" method="post">
						<div class="oder-sl">
							<h4>Số lượng: </h4>
							<input type="text" size="2" name="sanpham[<?=$msp?>]" class="">
							<button title="đi đến giỏ hàng">Mua ngay</button>
							<!-- submit tạo ra session nếu chưa đăng nhập thì đăng nhập và đi thẳng vào trang giỏ hàng -->
						</div>
					</form>
					
					<div class="ghi-chu-ct">
						<h3>Ghi chú</h3>
						<p>
							<?=$row_sp['ghichu']?>
						</p>

					</div>
				</div>
			</div>
		</div>
		
	</div>
<?php 
	$mlh = $row_sp['maloaihang'];
	$sql_lh = "select * from hanghoa where maloaihang = '$mlh' and mshh != '$msp'";
	$kq_lh = mysqli_query($conn, $sql_lh);
	
?>		
	<div class="container-fluid sp-tuong-tu">
		<hr class="hr-ct-2">
		<h3 class="title-ct">
			<u>>> Sản phẩm tương tự:</u>
		</h3>
					<!-- SẢN PHẨM TƯƠNG TỰ --> <!-- sử dụng hàm rand với mã loại hàng -->
		<div class="row">
<?php
	while($row = mysqli_fetch_assoc($kq_lh)){
?>			
			<div class="col-md-2 col-sm-4">
                <div class="product-grid">
                    <div class="product-image">
                        <a href="chi-tiet-san-pham.php?msp=<?=$row['mshh']?>">
                            <img class="pic-1" src="../admin/<?=$row['location']?>">
                        </a>
                    </div>
                    <div class="product-content">
                    	<?php 
                        	$arr_tenhh = explode(" ", $row['tenhh']);
                        	$sotu = count($arr_tenhh);
                        	$max = 5;
                        	$ar_ten = array();
                        	if($sotu <= 6){
                        		$ful_ten = $row['tenhh'];
                        	} else{
                        		$max = 5;
                        		for($i = 0; $i <= $max; $i++){
                        			$ar_ten[$i] = $arr_tenhh[$i];
                        		}
                        		$ful_ten =implode(" ", $ar_ten). " ...";
                        	}

                        	// var_dump($ful_ten); exit;
                        ?>
                        <h3 class="title"><a href="chi-tiet-san-pham.php?msp=<?=$row['mshh']?>"><?=$ful_ten?></a></h3>
                        <div class="price">
                        	<!-- <span class="discount">$13.00</span> -->
                            <span class="fell"><?=number_format($row['gia'],0,",",".")?> đ</span>
                        </div>
                    </div>
                    <ul class="product-control">
                        <li>
                        	<form action="gio-hang.php?action=add" method="post">
                        		<input style="display: none;" type="text"  name="sanpham[<?=$row['mshh']?>]" value="1">
                        		<input class="add-cart" type="submit" size="2" value="add cart">
                        	</form>
                        	<a href=""></a>
                        </li>
                        <li>
                        	<form action="chi-tiet-san-pham.php" method="get">
                        		<input style="display: none;" type="text" name="msp" value="<?=$row['mshh']?>">
                        		<button>Mua ngay</button>
                        	</form>
                        	
                        </li>
                    </ul>
                </div>
            </div>
<?php
	} 
?>            
		</div>
		<!-- <div class="pagination-page">
			<ul class="pagination">
				<li class="page-item"><a href="#">1</a></li>
				<li class="page-item active"><a href="#">2</a></li>
				<li class="page-item"><a href="#">3</a></li>
				<li class="page-item"><a href="#">4</a></li>
				<li class="page-item"><a href="#">5</a></li>
			</ul>
		</div> -->

	</div>
<?php }
?>
	<!-- <footer>
		<div style="height: 5px; background-color: black;">
				<img src="./images/banner/ad/short.jpg" alt="">	
		</div>
	</footer> -->

</body>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>