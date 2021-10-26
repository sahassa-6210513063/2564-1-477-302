<?php
		session_start();
		include_once 'dbconnect.php';
        //check whether login button is clicked
		if (isset($_POST['login'])) {
			$email = $_POST['login-email'];
			$passwd = $_POST['login-password'];

			$sql = "SELECT * FROM users WHERE user_email = '" . $email ."'
			AND user_passwd = '" . $passwd . "'";
            // ถ้า email กับ password ถูกต้องให้ไปหน้าHome
			$result = mysqli_query($con, $sql);
			if ($row = mysqli_fetch_array($result)) {
				$_SESSION['id'] = $row['user_id'];
				$_SESSION['name'] = $row['user_name'];
				header("location: home.php");
			} else {
				$error_msg= "Incorrect e-mail or password.";
			}
		}

        //check if form or submit button is submitted
		if (isset($_POST['signup'])) {
			//get data into variables
			$name = $_POST['user-name'];
			$email = $_POST['user-email'];
			$passwd = $_POST['user-password'];
			$cpasswd = $_POST['user-cpassword'];
		
			//2.2 validate user data
			//set validate error flag as false
			$validate_error = false;
			//validate error message
			$validate_msg = "";

			//validate e-mail format
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$validate_error = true;
				$validate_msg = "E-mail is not correct. ";
			}
			

			//validate length of password
			if (strlen($passwd) < 6) {
				$validate_error = true;
				$validate_msg = "Password must be more than 6 characters.";
			}

			//validate password & confiem password
			if ($passwd != $cpasswd) {
				$validate_error = true;
				$validate_msg = "Password and confirm password do not match.";
			}

			if (!$validate_error) { 
				//insert into users table
				$sql = "INSERT INTO users(user_name, user_email, user_passwd) 
				VALUES('" . $name . "', '". $email . "', '" . $passwd . "')";
 
				if	(mysqli_query($con, $sql)){
					//execute without error
					header("location: index.php");
				} else{
					//error
				}
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>PET COMMUNITY</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="icon" type="image/x-icon" href="loginpage/assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
    <style>
        dialog {
            background-color:whitesmoke;
            color: rgb(0, 0, 0);
            border: 1px solid rgba(0,0,0,0.3) ;
            border-radius: 30px;
            bottom: 0;
            padding: 20px;
            box-shadow: 0 3px 7px rgba(0,0,0,0.3);
            box-sizing: content-box;
            width: 20%;
        }
    </style>
</head>
<body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="#page-top" img="Image/icon.png">PET COMMUNITY</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto ">
                        <!-- แบบฟอร์มกรอกสมัคร Sign Up -->
                        <li class="nav-item"><a class="nav-link" id="show1" href="#!">Sign Up</a></li>
                        <li class="nav-item"><a class="nav-link" id="show2" href="#!">Log in</a></li>
                            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                            <fieldset>
                                <div>
                                    <dialog id="FirstDialog">
                                        <div class="form-row">
                                            <legend>Sign Up</legend>
                                            <hr>
                                            <div class="form-group col-md-15">
                                                <label for="name">ชื่อ-นามสกุล</label>
                                                <input type="name" name="user-name" class="form-control" id="inputname" placeholder="Enter Full Name" required value="">
                                            </div>
                                            <div class="form-group col-md-15">
                                                <label for="Email">Email</label>
                                                <input type="email" name="user-email" class="form-control" id="inputEmail" placeholder="Email" required value="">
                                            </div>
                                        </div>
                                            <div class="form-group col-md-15">
                                                <label for="Password">Password</label>
                                                <input type="password" name="user-password" class="form-control" id="inputPassword" placeholder="รหัสผ่านต้องมีอักขระมากกว่า 6 ตัว" required >
                                            </div>
                                            <div class="form-group col-md-15">
                                                <label for="Password">Confirm Password</label>
                                                <input type="password" name="user-cpassword" class="form-control" id="inputcPassword" placeholder="Confirm Password" required >
                                            </div>
                                        <br>
                                        <div class="form-group">
                                            <button type="submit" name="signup" value="Sign Up" class="btn btn-primary" >Sign Up</button>
                                            <button type="close" id="hide1" class="btn btn-primary">Close</button>
                                        </div>
                                    <!--3.display message -->
                                        <?php
                                            if (isset($validate_error)) {
                                                if ($validate_error) {
                                                    echo $validate_msg;
                                                    
                                                }
                                            }
                                        ?>    
                                    </dialog>
                                </div>
                            <fieldset>
                            </form>
                            <script>
                                (function () {
                                    var dialog = document.getElementById('FirstDialog');
                                    document.getElementById('show1').onclick = function() {
                                        dialog.showModal();
                                    };
                                    document.getElementById('hide1').onclick = function() {
                                        dialog.close();
                                    };
                                })();
                            </script>

                            <!-- Log In เข้าสู่เว็ปไซต์ -->
                            <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
                            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                                <div>
                                    <dialog id="SecondDialog">
                                        <div class="mb-3 row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">
                                                <span class="material-icons">account_circle</span>
                                            </label>
                                            <div class="col-sm-10">
                                            <input type="text" name="login-email" class="form-control" id="staticEmail" placeholder="email@example.com" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label">
                                                <span class="material-icons">vpn_key</span>
                                            </label>
                                            <div class="col-sm-10">
                                            <input type="password" name="login-password" class="form-control" id="inputPassword" placeholder="Password" required>
                                            </div>
                                        </div>
                                        <center>
                                        <button type="submit" name="login" value="Login" class="btn btn-primary">Log in</button>
                                        <button type="close" id="hide2" class="btn btn-primary">Close</button>
                                        </center> 
                                            <!--5.display message -->
                                                <span class = "text-danger">
                                                    <?php
                                                        if (isset($error_msg)) {
                                                            echo $error_msg;
                                                        }
                                                    ?>
                                                </span>
                                    </dialog>
                                </div>
                                    <script>
                                        (function () {
                                            var dialog = document.getElementById('SecondDialog');
                                            document.getElementById('show2').onclick = function() {
                                                dialog.showModal();
                                            };
                                            document.getElementById('hide2').onclick = function() {
                                                dialog.close();
                                            };
                                        })();
                                    </script>                      
                                </form>                    
                    </ul>    
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="masthead text-center text-white">
            <div class="masthead-content">
                <div class="container px-5">
                    <div class="text-center">
                      </div>
                    <h1 class="masthead-heading mb-0">PET</h1>
                    <h2 class="masthead-subheading mb-0">COMMUNITY</h2>
                    <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">Learn More</a>
                </div>
            </div>
            <div class="bg-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
            <div class="bg-circle-4 bg-circle"></div>
        </header>
        <!-- Content section 1-->
        <section id="scroll">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/Hello.png" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Welcome to our website</h2>
                            <p>ยินดีตอนรับเข้าสู่เว็บไซต์ของพวกเรา</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 2-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/wow.png" alt="..." /></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <h2 class="display-4">What is our website about?</h2>
                            <p>เว็บไซต์ของเราทำเกี่ยวกับการให้เกร็ดความรู้เกี่ยวกับสัตว์เลี้ยงของคุณ สามารถตั้งกระทู้เพื่อแชร์เรื่องราวหรือตั้งกระทู้เพื่อถามสิ่งต่างๆ และให้คนอื่นเข้ามาตอบกระทู้หรือแสดงความคิดเห็นได้</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-black">
            <div class="container px-5"><p class="m-0 text-center text-white small">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
</body>
</html>