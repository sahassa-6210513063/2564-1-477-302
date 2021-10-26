<?php
	session_start();
	//13.display old info and update into users table
    include_once 'dbconnect.php';

	if (isset($_GET['user_id'])) {
		$sql = "SELECT * FROM users WHERE user_id = " . $_GET['user_id'];
		$result = mysqli_query($con,$sql);
		$row_update = mysqli_fetch_array($result);
		$user_id = $row_update['user_id'] ;
		$user_name = $row_update['user_name'] ;
		$user_email = $row_update['user_email'] ;

	}

	// check whether update button is clicked
	if (isset($_POST['update'])) {
		$user_id = $_POST['id'];
		$user_name = $_POST['name'];
		$user_email = $_POST['email'];
		$user_passwd = $_POST['password'];
		$user_cpasswd = $_POST['cpassword'];

		//set validate error flag as false
		$validate_error = false;
		//validate error message
		$error_msg = "";
		
		//validate e-mail format
		if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
			$validate_error = true;
			$error_msg = "E-mail is not correct. ";
		}		

		//validate length of password
		if (strlen($user_passwd) < 6) {
			$validate_error = true;
			$error_mgs = "Password must be more than 6 characters.";
		}

		//validate password & confiem password
		if ($user_passwd != $user_cpasswd) {
			$validate_error = true;
			$error_mgs = "Password and confirm password do not match.";
		}

		if (!$validate_error) {
			$sql ="UPDATE users SET user_name = '" . $user_name . "', user_email = '" . $user_email. "', user_passwd 
			= '" . md5($user_passwd) . "'WHERE user_id = " . $user_id;

			if (mysqli_query($con,$sql)) {
				header("location: show_user.php");
			} else {
				$error_mgs = "Error updating record!";

			}
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
                        <!-- Log In เข้าสู่เว็ปไซต์ -->
                        <li class="nav-item"><a class="nav-link" id="show2" href="index.php">Login</a></li>
                        <!--6.if already logged in, change menu items -->
                        <li class="nav-item"><a class="nav-link" href="logout.php">logout</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link ">ผู้ดูแลระบบ <?php echo $_SESSION['name'] ?></a></li>
                </div>
            </div>
        </nav>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="updateform">
				<fieldset>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
					<legend>Update</legend>

					<!--14.display old info in text field -->
					<div class="form-group">
						<input type="hidden" name="id" value="<?php echo $user_id ; ?>" />
						<label for="name">Name</label>
						<input type="text" name="name" placeholder="Enter Full Name" required value="<?php echo $user_name ; ?>" class="form-control" />

					</div>

					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Email" required value="<?php echo $user_email; ?>" class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Password" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">Confirm Password</label>
						<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
					</div>

					<div class="form-group">
                        <br>
						<center><input type="submit" name="update" value="Update" class="btn btn-primary" ></center>
					</div>
				</fieldset>
			</form>
			<!--15.display message -->
			<span class = "text-danger"><?php if(isset($error_mgs)) echo $error_mgs; ?></span>
		</div>
	</div>
</div>
</body>
</html>