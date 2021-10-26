<?php
	//7.check admin username and password, set admin name as "adminpet" and password as "pet1122"
	session_start();

	if (isset($_POST['admin-login'])){
		$admin_name = $_POST['admin-name'];
		$admin_passwd = $_POST['admin-password'];
			
		if ($admin_name == 'adminpet' && $admin_passwd == 'pet1122') {
			$_SESSION['id'] = 0 ;
			$_SESSION['name'] = "Home Pets";
			header("location: show_user.php");
		} else {
			$error_msg = "ชื่อผู้ใช้งาน หรือ รหัสผ่านผิดพลาด";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>PET COMMUNITY</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="icon" type="image/x-icon" href="loginpage/assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Google icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
</head>
<body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="#page-top" img="Image/icon.png">PET COMMUNITY</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <!-- แบบฟอร์มกรอกสมัคร Sign Up -->
                        <li class="nav-item"><a class="nav-link" id="show1" href="index.php">Sign Up</a></li>
                        <!-- Log In เข้าสู่เว็ปไซต์ -->
                        <li class="nav-item"><a class="nav-link" id="show2" href="index.php">Login</a></li>
                        <!--6.if already logged in, change menu items -->
                        <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
                </div>
            </div>
        </nav>

<header class="masthead">
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<br>
					<br>
					<br>
					<center><legend class="text-secondary">เข้าสู่ระบบ</legend></center>
					<br>
					<div class="form-group">
						<label for="name">ชื่อผู้ใช้งาน</label>
						<input type="text" name="admin-name" placeholder="ป้อนชื่อผู้ใช้งาน" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">รหัสผ่าน</label>
						<input type="password" name="admin-password" placeholder="ป้อนรหัสผ่าน" required class="form-control" />
					</div>

					<!--8.display message -->
					<span class="text-danger">
						<?php if (isset($error_msg)) { echo $error_msg; } ?>
					</span>
					<br>
					<center><div class="form-group">
						<input type="submit" name="admin-login" value="Login" class="btn btn-secondary" />
					</center></div>
					<br>
				</fieldset>
				<br>
			</form>
		</div>
	</div>
</div>
</header>
<br>
<br>
<br>
<!-- Copyright Section-->
<section class="copyright py-4 text-center text-white">
<div class="container"><small class="pre-wrap">ผู้จัดทำ นายปกรณ์ ชิตพงษ์ | นางสาว ธันย์ชนก เจริญฟูประเสริฐ | นายธีรภัทร บ่าหมะ | PSU | FMS | BIS </small></div></section>
</body>
</html>