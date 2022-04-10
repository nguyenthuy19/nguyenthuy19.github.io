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
	<title>Trang chủ</title>
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
	<link rel="stylesheet" type="text/css" href="footer.css">
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
	
	<div class="container-fluid menu-and-banner">
		<div class="row">
			<div class="col-md-4 col-lg-3 menu">
				<div class="menu-brand">
					<span class="glyphicon glyphicon-list"></span>
					<span>DM sản phẩm</span>
				</div>
				<div class="menu-list">
					<ul>
			<!-- MENU CỐ ĐỊNH -->
<?php
	$select_lh = "select * from loaihanghoa LIMIT 0,4";
	$kq_select_lh = mysqli_query($conn,$select_lh);
	while($row_lh = mysqli_fetch_assoc($kq_select_lh)){
?>						
						<li>
							<a href="index.php?ml=<?=$row_lh['maloaihang']?>"><?=$row_lh['tenloaihang']?></a>
						</li>
<?php
	} 
?>
						<div class="dropdown-admin">
							<div class="dropbtn-admin">
							  	>>Xem thêm...
							</div>
							<ul class="dropdown-admin-content">
				<!-- MENU DROPDOWN -->
<?php
	$select_all_lh = "select * from loaihanghoa";
	$kq_select_all_lh = mysqli_query($conn,$select_all_lh);
	$soluong=0;
	while($row_all_lh=mysqli_fetch_assoc($kq_select_all_lh)){
		$soluong++;
	}
	$select_lh1 = "select * from loaihanghoa LIMIT 4,$soluong";
	$kq_select_lh1 = mysqli_query($conn,$select_lh1);
	while($row_lh1 = mysqli_fetch_assoc($kq_select_lh1)){
?>								
								<li><a href="index.php?ml=<?=$row_lh1['maloaihang']?>"><?=$row_lh1['tenloaihang']?></a></li>
<?php 
	}
?>								
				  			</ul>
						</div>
					</ul>
				</div>
				<div class="menu-brand">
					<span>THÔNG TIN LIÊN HỆ</span>
				</div>
				<div class="menu-list">
					<ul>
						<li>
							<marquee class="tieu-de">Hệ thống cửa hàng phân phối mỹ phẩm DPC</marquee>
						</li>

						<!-- <li class="tieu-de">
							Khu II, Đ. 3/2, Xuân Khánh, Ninh Kiều, Cần Thơ
						</li> -->

						<li class="tieu-de1">
							<span class="glyphicon glyphicon-phone-alt"></span>
							<span>0123456789</span>
						</li>
						<li>
							<a href="#"><span class="glyphicon glyphicon-envelope"></span></a>
							<a href="#"><span>camthuy@gmail.com</span></a>
						</li>
						<li style="border-bottom: none;">
							<a href="#"><span class="fa fa-facebook-official"></span></a>
							<a href="#"><span>facebook</span></a>
						</li>
					</ul>
				</div>
				
			</div>
			<div class="col-md-8 col-lg-9 banner">
				
			  <div class="row advertisement">
					<div class="col-md-3 col-sm-3 ad-gird" style="margin-left: 1%;">
						<div class="ad-icon">
							<i class="fas fa-shipping-fast"></i>
							
						</div>
						<div class="ad-content">
							<h4>Giao hàng cấp tốc</h4>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 ad-gird">
						<div class="ad-content">
							<h4>Quà tặng hấp dẫn</h4>
						</div>
						<div class="ad-icon">
							<i class="fas fa-gifts"></i>
						</div>
						
					</div>
					<div class="col-md-3 col-sm-3 ad-gird">
						<div class="ad-icon">
							<i class="fa fa-headset"></i>
							
						</div>
						<div class="ad-content">
							<h4>Tư vấn nhiệt tình</h4>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 ad-gird">
						<div class="ad-content">
							<h4>yên tâm mua sắm</h4>
						</div>
						<div class="ad-icon">
							<i class="fas fa-thumbs-up"></i>
							
						</div>
						
					</div>
				</div>


				<div id="myCarousel" class="carousel slide" data-ride="carousel">
			    <!-- tag ol -->
				    <ol class="carousel-indicators">
				      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				      <li data-target="#myCarousel" data-slide-to="1"></li>
				      <li data-target="#myCarousel" data-slide-to="2"></li>
				    </ol>
			    <!-- list img -->
				    <div class="carousel-inner">
				      <div class="item active">
				        <img src="./images/banner/img4.jpg" alt="Banner">
				      </div>

				      <div class="item">
				        <img src="./images/banner/img5.jpg" alt="Banner">
				      </div>
				    
				      <div class="item">
				        <img src="./images/banner/img7.jpg" alt="Banner">
				      </div>
				    </div>

			    <!-- next -->
			    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
			      <span class="glyphicon glyphicon-chevron-left"></span>
			      <span class="sr-only">Previous</span>
			    </a>
			    <a class="right carousel-control" href="#myCarousel" data-slide="next">
			      <span class="glyphicon glyphicon-chevron-right"></span>
			      <span class="sr-only">Next</span>
			    </a>
			  </div>
			  <div class="ad-title">
					<h4>-- Lợi ích khách hàng đặt hàng đầu --</h4>
					
			  </div>
			</div>	
		</div>
	</div>
	
	<div class="container-fluid">
		
		<div class="title-sp">
			<div class="title-brand">
				<i class="fa fa-angle-double-right item-brand"></i> SẢN PHẨM
			</div>
<?php
	if(isset($_POST['filter-gia'])){
		$opt_gia = $_POST['gia'];
	} else $opt_gia='';
?>	
			<div class="filter">
				<span>Tìm kiếm theo:</span>
				<span class="filter-gia">SP:</span>		
				<span class="option-gia">
					<form action="index.php" method="get">
						<select name="filter-ml">
							<option>sản phẩm</option> //nhãn
<?php
	$select_filter_lh = "select * from loaihanghoa";
	$kq_select_filter_lh = mysqli_query($conn,$select_filter_lh);
	while($filter_lh= mysqli_fetch_assoc($kq_select_filter_lh)){
?>
							<option value="<?=$filter_lh['maloaihang']?>"><?=$filter_lh['tenloaihang']?></option>
<?php
	} 
?>
						</select>
						<select name="gia">
							<option value="all">Tất cả giá</option>
							<option value="gia-thap">Giá thấp đến cao</option>
							<option value="gia-cao">Giá cao đến thấp</option>
							<option value="100-200k">Từ 100k đến 200k</option>
							<option value="200-400k">Từ 200k đến 400k</option>
							<option value="tren-400">Trên 400k</option>
							<option value="duoi-100">Dưới 100k</option>
						</select>
						<button class="btn-option-gia">ok</button>
					</form>
				</span>
				
			</div>
		</div>
		<!-- <hr style="border: 2px solid black;"> -->
				<!-- /--------SẢN PHẨM---------/ -->
		<div class="row">

<?php
	$limit = !empty($_GET['per-page']) ? $_GET['per-page'] : 18 ;
	$page_hientai = !empty($_GET['page']) ? $_GET['page'] : 1  ;
	$offset = ($page_hientai-1)* $limit;
	if(isset($_GET['filter-ml']) && isset($_GET['gia'])){
		$fil_ml = $_GET['filter-ml'];
		$fil_gia = $_GET['gia'];
		// echo $fil_ml; echo $fil_gia; exit;
		switch ($fil_gia) {
			case 'gia-thap':
				$total_record = mysqli_query($conn,"select * from hanghoa where maloaihang ='$fil_ml' order by gia ASC ");
				$total_record = $total_record->num_rows;
				$total_page = ceil($total_record / $limit);
				$ht_all_hh = "SELECT * FROM hanghoa where maloaihang = '$fil_ml' ORDER BY gia ASC LIMIT ".$limit." OFFSET ".$offset." ";
				break;
			case 'gia-cao': 
				$total_record = mysqli_query($conn,"select * from hanghoa where maloaihang ='$fil_ml' order by gia DESC ");
				$total_record = $total_record->num_rows;
				$total_page = ceil($total_record / $limit);
				$ht_all_hh = "SELECT * FROM hanghoa where maloaihang = '$fil_ml' ORDER BY gia DESC LIMIT ".$limit." OFFSET ".$offset." ";
				break;
			case '100-200k':
				$total_record = mysqli_query($conn,"select * from hanghoa where maloaihang ='$fil_ml' and gia >='100000' and gia <= '200000' order by gia ASC ");
				$total_record = $total_record->num_rows;
				$total_page = ceil($total_record / $limit);
				$ht_all_hh = "SELECT * FROM hanghoa where maloaihang ='$fil_ml' and gia >='100000' and gia <= '200000' order by gia ASC LIMIT ".$limit." OFFSET ".$offset." ";
				break;
			case '200-400k':
				$total_record = mysqli_query($conn,"select * from hanghoa where maloaihang ='$fil_ml' and gia >='200000' and gia <= '400000' order by gia ASC ");
				$total_record = $total_record->num_rows;
				$total_page = ceil($total_record / $limit);
				$ht_all_hh = "SELECT * FROM hanghoa where maloaihang ='$fil_ml' and gia >='200000' and gia <= '400000' order by gia ASC LIMIT ".$limit." OFFSET ".$offset." ";
				break;
			case 'tren-400':
				$total_record = mysqli_query($conn,"select * from hanghoa where maloaihang ='$fil_ml' and gia > '400000' order by gia ASC ");
				$total_record = $total_record->num_rows;
				$total_page = ceil($total_record / $limit);
				$ht_all_hh = "SELECT * FROM hanghoa where maloaihang ='$fil_ml' and gia > '400000' order by gia ASC LIMIT ".$limit." OFFSET ".$offset." ";
				break;
			case 'duoi-100':
				$total_record = mysqli_query($conn,"select * from hanghoa where maloaihang ='$fil_ml' and gia < '100000' order by gia ASC ");
				$total_record = $total_record->num_rows;
				$total_page = ceil($total_record / $limit);
				$ht_all_hh = "SELECT * FROM hanghoa where maloaihang ='$fil_ml' and gia < '100000' order by gia ASC LIMIT ".$limit." OFFSET ".$offset." ";
				break;
			default:
				$total_record = mysqli_query($conn,"select * from hanghoa where maloaihang ='$fil_ml'  order by mshh ASC ");
				$total_record = $total_record->num_rows;
				$total_page = ceil($total_record / $limit);
				$ht_all_hh = "SELECT * FROM hanghoa where maloaihang ='$fil_ml' order by mshh ASC LIMIT ".$limit." OFFSET ".$offset." ";
				break;
		}
	} else

	if(isset($_GET['ml'])){
		$mlh = $_GET['ml'];
		$total_record = mysqli_query($conn,"select * from hanghoa where maloaihang = '$mlh' ");
		$total_record = $total_record->num_rows;
		$total_page = ceil($total_record / $limit);
		$ht_all_hh = "SELECT * FROM hanghoa where maloaihang = '$mlh' ORDER BY mshh ASC LIMIT ".$limit." OFFSET ".$offset." ";
	} else if(isset($_GET['tim-kiem'])){
				$tim_kiem = $_GET['tim-kiem'];
				$total_record = mysqli_query($conn,"select * from hanghoa where tenhh like '%$tim_kiem%'");
				$total_record = $total_record->num_rows;
				$total_page = ceil($total_record / $limit);
				$ht_all_hh = "SELECT * FROM hanghoa where tenhh like '%$tim_kiem%' ORDER BY mshh ASC LIMIT ".$limit." OFFSET ".$offset." ";
			} else if(!isset($_GET['ml']) && !isset($_GET['search'])){
						//hiển thị tất cả hàng
						$total_record = mysqli_query($conn,"select * from hanghoa");
						$total_record = $total_record->num_rows;
						$total_page = ceil($total_record / $limit);
						$ht_all_hh = "SELECT * FROM hanghoa ORDER BY  RAND() LIMIT ".$limit." OFFSET ".$offset." ";
					} //trên đây giống, phân trang chia điều kiện ra
	$kq_ht_all_hh = mysqli_query($conn, $ht_all_hh);
	while($row = mysqli_fetch_assoc($kq_ht_all_hh)){
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
                        	$max = 4;
                        	$ar_ten = array();
                        	if($sotu <= 5){
                        		$ful_ten = $row['tenhh'];
                        	} else{
                        		$max = 4;
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
		</div>
	</div>
<?php
	if(!isset($_GET['tim-kiem']) && !isset($_GET['search']) && !isset($_GET['filter-ml']) && !isset($_GET['gia'])){ 
?>
	<div class="pagination-page">
		<ul class="pagination">
<?php
	if(!isset($_GET['ml'])){
		if($page_hientai > 3){
			$first_page = 1;
?>	
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$first_page?>">First</a></li>			
<?php
		}
	} else if(isset($_GET['ml'])){ 
				if($page_hientai > 3){
					$first_page = 1; 
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$first_page?>&ml=<?=$mlh?>">First</a></li>	
<?php			}
			} // xét điều kiện đầu tiên với phân trang cho danh mục

	if(!isset($_GET['ml'])){
		if($page_hientai > 1){
			$prev_page= $page_hientai -1;
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$prev_page?>">&laquo;</a></li>
<?php 
		}
	} else if(isset($_GET['ml'])){
		if($page_hientai > 1){
			$prev_page= $page_hientai -1;	
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$prev_page?>&ml=<?=$mlh?>">&laquo;</a></li>
<?php
		}
	}
	if(!isset($_GET['ml'])){
		for ($i=1; $i <=$total_page ; $i++) {
			if($i != $page_hientai){
				if($i > $page_hientai-3 && $i <$page_hientai+3){
?>			
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$i?>"><?=$i?></a></li>
<?php 
			}
?>
<?php 
			}else {
?>		
			<li class="page-item active"><a href="?per-page=<?=$limit?>&page=<?=$i?>"><strong><?=$i?></strong></a></li>
<?php 
				}
		}
	} else if(isset($_GET['ml'])){
				for ($i=1; $i <=$total_page ; $i++) {
					if($i != $page_hientai){
						if($i > $page_hientai-3 && $i <$page_hientai+3){ 
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$i?>&ml=<?=$mlh?>"><?=$i?></a></li>
<?php 
						}
?>
<?php 
					}else {
?>		
			<li class="page-item active"><a href="?per-page=<?=$limit?>&page=<?=$i?>ml=<?=$mlh?>"><strong><?=$i?></strong></a></li>
<?php
					}
				}
			}


	if(!isset($_GET['ml'])){
		if($page_hientai <= $total_page -1){
			$next_page = $page_hientai +1;
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$next_page?>">&raquo;</a></li>
<?php
		}
	} else if(isset($_GET['ml'])){
				if($page_hientai <= $total_page -1){
					$next_page = $page_hientai +1;
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$next_page?>&ml=<?=$mlh?>">&raquo;</a></li>
<?php
				}
			}

	if(!isset($_GET['ml'])){		
		if($page_hientai < $total_page -2){
			$end_page = $total_page;
?>			
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$end_page?>">End</a></li>
<?php
		}
	}else if(isset($_GET['ml'])){
				if($page_hientai < $total_page -2){
					$end_page = $total_page;
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$end_page?>&ml=<?=$mlh?>">End</a></li>
<?php
				} 
		}
?>				
		</ul>
	</div>
<?php 
	}
	if(isset($_GET['tim-kiem']) || isset($_GET['search'])){
?>
					<!-- PHÂN TRANG TÌM KIẾM -->
	<div class="pagination-page">
		<ul class="pagination">
<?php
	if(isset($_GET['tim-kiem']) || isset($_GET['search'])){
		if($page_hientai > 3){
			$first_page = 1;
?>	
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$first_page?>&tim-kiem=<?=$tim_kiem?>">First</a></li>			
<?php
		}
	} 

	if(isset($_GET['tim-kiem']) || isset($_GET['search'])){
		if($page_hientai > 1){
			$prev_page= $page_hientai -1;
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$prev_page?>&tim-kiem=<?=$tim_kiem?>">&laquo;</a></li>
<?php 
		}
	} 
	if(isset($_GET['tim-kiem']) || isset($_GET['search'])){
		for ($i=1; $i <=$total_page ; $i++) {
			if($i != $page_hientai){
				if($i > $page_hientai-3 && $i <$page_hientai+3){
?>			
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$i?>&tim-kiem=<?=$tim_kiem?>"><?=$i?></a></li>
<?php 
			}
?>
<?php 
			}else {
?>		
			<li class="page-item active"><a href="?per-page=<?=$limit?>&page=<?=$i?>&tim-kiem=<?=$tim_kiem?>"><strong><?=$i?></strong></a></li>
<?php 
				}
		}
	} 
	if(isset($_GET['tim-kiem']) || isset($_GET['search'])){
		if($page_hientai <= $total_page -1){
			$next_page = $page_hientai +1;
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$next_page?>&tim-kiem=<?=$tim_kiem?>">&raquo;</a></li>
<?php
		}
	} 

	if(isset($_GET['tim-kiem']) || isset($_GET['search'])){		
		if($page_hientai < $total_page -2){
			$end_page = $total_page;
?>			
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$end_page?>&tim-kiem=<?=$tim_kiem?>">End</a></li>
<?php
		}
	}
?>				
		</ul>
	</div>
<?php 
	}
?>

				<!-- PHÂN TRANG LỌC GIÁ -->
<?php 
	if(isset($_GET['filter-ml']) && isset($_GET['gia'])){
?>
	<div class="pagination-page">
		<ul class="pagination">
<?php
	if(isset($_GET['filter-ml']) && isset($_GET['gia'])){
		if($page_hientai > 3){
			$first_page = 1;
?>	
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$first_page?>&filter-ml=<?=$fil_ml?>&gia=<?=$fil_gia?>">First</a></li>			
<?php
		}
	} 

	if(isset($_GET['filter-ml']) && isset($_GET['gia'])){
		if($page_hientai > 1){
			$prev_page= $page_hientai -1;
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$prev_page?>&filter-ml=<?=$fil_ml?>&gia=<?=$fil_gia?>">&laquo;</a></li>
<?php 
		}
	} 
	if(isset($_GET['filter-ml']) && isset($_GET['gia'])){
		for ($i=1; $i <=$total_page ; $i++) {
			if($i != $page_hientai){
				if($i > $page_hientai-3 && $i <$page_hientai+3){
?>			
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$i?>&filter-ml=<?=$fil_ml?>&gia=<?=$fil_gia?>"><?=$i?></a></li>
<?php 
			}
?>
<?php 
			}else {
?>		
			<li class="page-item active"><a href="?per-page=<?=$limit?>&page=<?=$i?>&filter-ml=<?=$fil_ml?>&gia=<?=$fil_gia?>"><strong><?=$i?></strong></a></li>
<?php 
				}
		}
	} 
	if(isset($_GET['filter-ml']) && isset($_GET['gia'])){
		if($page_hientai <= $total_page -1){
			$next_page = $page_hientai +1;
?>
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$next_page?>&filter-ml=<?=$fil_ml?>&gia=<?=$fil_gia?>">&raquo;</a></li>
<?php
		}
	} 

	if(isset($_GET['filter-ml']) && isset($_GET['gia'])){		
		if($page_hientai < $total_page -2){
			$end_page = $total_page;
?>			
			<li class="page-item"><a href="?per-page=<?=$limit?>&page=<?=$end_page?>&filter-ml=<?=$fil_ml?>&gia=<?=$fil_gia?>">End</a></li>
<?php
		}
	}
?>				
		</ul>
	</div>
<?php 
	}
?>




	<footer>
		<div class="container-fluid main">
			<div class="row">
				<div class="col-lg-4 col-md-4 danhmuc">
					<h4>Danh sách các sản phẩm:</h4>
					<ul>
<?php
	$sql_footer = "select * from loaihanghoa ";
	$kq_footer = mysqli_query($conn, $sql_footer);
	while($row_footer=mysqli_fetch_assoc($kq_footer)){ 
?>						
						<li>
							<?=$row_footer['tenloaihang']?>
						</li>
<?php
	} 
?>						
					</ul>
				</div>
				<div class="col-lg-4 col-md-4 diachi">
					<h4>Công Ty TNHH MTV DPCShop</h4>
					<h5>Hệ thống phân phối và bán lẻ mỹ phẩm </h5>
					<h5>Đường 3/2,P. Xuân Khánh,Q. Ninh Kiều,TP. Cần Thơ</h5>
					<h5>TP Cần Thơ Cấp Ngày 10/10/2021</h5>
				</div>
				<div class="lien-he">
					<h4>Liên hệ:</h4>
					<h5>SĐT: 0987654321</h5>
					<div class="fb">
						<a href="#" style="height: 40px;"><img style="height: 40px;" src="./images/facebook.jpg" alt=""></a>
						<a href="#" style="height: 40px;"><img style="height: 40px;" class="ins" src="./images/instagram.jpg" alt=""></a>
					</div>
				</div>
			</div>
			
		</div>
	</footer>
	<nav class="chantrang">	
		<marquee><p style="color: #fff; font-weight: bold; padding-top: 10px;">Dpc shop hân hạnh được phục vụ quý khách hàng</p></marquee>
	</nav>
<?php	
// mysqli_free_result($resutl);
mysqli_close($conn);
?>
</body>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>