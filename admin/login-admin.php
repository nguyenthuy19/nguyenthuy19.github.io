<?php
	ob_start();
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'dathang') or die ('Không thể kết nối tới database');
	if(isset($_SESSION['loginAdmin'])){
		unset($_SESSION['loginAdmin']);
	}
	if(isset($_SESSION['loginNV'])){
		unset($_SESSION['loginNV']);
	}
	if(isset($_POST['login'])){
		$user=$_POST["username"];
		$password = md5($_POST['password']);
		// $password=MD5($_POST["password"]);

		$sql_kt = "select * from nhanvien where msnv='$user'";
		$kt_tk = 0;
		$kq_kt = mysqli_query($conn, $sql_kt);
		while($row= mysqli_fetch_assoc($kq_kt)){
			if($user == $row['msnv']){
				$kt_tk = 1; break;
			}
		}
		if($kt_tk==0){
			$err = "Tài khoản không tồn tại";
		} else if($kt_tk == 1) {
					$sql="select * from nhanvien where msnv='$user' and matkhau = '$password' and chucvu='quản trị';";

					$sql1= "select * from nhanvien where msnv='$user' and matkhau = '$password' and chucvu !='quản trị';";

					$kq1=mysqli_query($conn,$sql1);
					$dem1=0;
					if($row1=mysqli_fetch_array($kq1)){
						$dem1=1;
					}
					
					if($dem1){
						$_SESSION["loginNV"]=$row["msnv"];
						header("location:admin.php");
					} else $err= "Sai mật khẩu! vui lòng kiểm tra lại!";


					$kq=mysqli_query($conn,$sql);
					$dem=0;
					if($row2=mysqli_fetch_array($kq)){
						$dem=1;
					}
					
					if($dem){
						$_SESSION["loginAdmin"]=$row["msnv"];
						header("location:admin.php");
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
	<link rel="stylesheet" href="login-admin.css">
</head>
<body>
	<div class="container">
		<form action="login-admin.php" method="post">
			<div class="login-form">
				<div class="login">
					<h3>LogIn</h3>
				</div>
				<input type="text" name="username" placeholder="Username" required>
				<input type="password" name="password" placeholder="password" required>
				<button  name="login" class="btn">Log In</button>
			<a href="#">quên mật khẩu?</a>
			</div>
		</form>
		
<?php if(isset($err)){ ?>		
		<h3 style="color: white; text-align: center; width: 280px; margin-top: 20%;">
			<?=$err?>
		</h3>
<?php }		
?>		
	</div>	
	
	<video autoplay muted loop >
		<source src="./images/video_login1.mp4" type="audio/mp4">
	</video>

</body>
<?php
mysqli_close($conn);
?>
</html>