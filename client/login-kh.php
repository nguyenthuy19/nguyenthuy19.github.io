<?php
	ob_start();
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'dathang') or die ('Không thể kết nối tới database');

	if(isset($_POST['login'])){
		$user=$_POST["username"];
		$password=MD5($_POST["password"]);
		// $password = $_POST['password'];
		$sql_kt = "select * from khachhang where sodienthoai='$user'";
		$kq_kt = mysqli_query($conn,$sql_kt);
		$kt_tk = 0;
		while($row= mysqli_fetch_assoc($kq_kt)){
			if($user == $row['sodienthoai']){
				$kt_tk =1; break;
			}
		}
		if($kt_tk==0){
			$err = "Tài khoản không tồn tại!";
		} else if($kt_tk==1){
					$sql="select * from khachhang where sodienthoai='$user' and matkhau = '$password';";

					$kq=mysqli_query($conn,$sql);
					$dem=0;
					if($row1=mysqli_fetch_array($kq)){
						$dem=1;
					}
					
					if($dem){
						$_SESSION["loginKH"]=$row["mskh"];
						header("location:index.php");
					} else $err= "Sai mật khẩu, vui lòng kiểm tra lại!";
		}
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="login-kh.css">
</head>
<body>
	<div class="brand">
		<marquee><h1>Đăng nhập vào cửa hàng DPC</h1></marquee>
	</div>
	<div class="container">
		<form action="login-kh.php" method="post">
			<div class="login-form">
				<div class="login">
					<h3>Đăng Nhập</h3>
				</div>
				<input type="text" name="username" placeholder="Số điện thoại" required="">
				<input type="password" name="password" placeholder="Mật khẩu" required="">
				<button class="btn" name="login">Đăng Nhập</button>
				
			</div>
		</form>	
<?php if(isset($err)){ ?>		
		<h3 style="color: red; text-align: center; width: 280px; margin-top: 20%;">
			<?=$err?>
		</h3>
<?php }		
?>	
	</div>
	<div>
		
	</div>
	
</body>
<?php
mysqli_close($conn);
?>
</html>