<?php
    session_start();

    //9.fetch and delete record
    include_once 'dbconnect.php';

    // fetch records
    $sql = "SELECT * FROM users ORDER BY user_id ASC"; //มากไปน้อย DESC น้อยไปมาก ASC
    $result = mysqli_query($con, $sql);

    $cnt = 1;

    // delete record ลบการบันทึก
    if (isset($_GET['user_id'])) {
        $sql = "DELETE FROM users where user_id = " . $_GET['user_id'];
        mysqli_query($con, $sql);
        header("location: show_user.php");
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
     <div class="row">
         <div class="col-xs-8 col-xs-offset-2">
             <br>
             <br>
             <br>
             <br>
             <center>
             <h2>ข้อมูลผู้เข้าใช้งาน</h2>
             </center>
            <div class="table-responsive">
             <table class="table table-bordered table-hover">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>User Name</th>
                         <th>E-Mail</th>
                         <th>Password</th>
                         <th colspan="2" style="text-align:center">Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                <!--10.show all users in this part of table ใช้วน loop ด้วยคำสั่ง while -->
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $cnt++; ?></td>
                        <td><?php echo $row['user_name']?></td>
                        <td><?php echo $row['user_email']?></td>
                        <td><?php echo $row['user_passwd']?></td>
                        <td>
                            <input type="button" value="แก้ไข" name="btn-edit" class="btn btn-primary" onclick = "update_user (<?php echo $row['user_id']; ?>);">
                        </td>
                        <td>
                            <input type="button" value="ลบ" name="btn-delete" class="btn btn-danger" onclick ="delete_user (<?php echo $row['user_id']; ?>);">
                        </td>
                    </tr>
                <?php } ?>

                 </tbody>
             </table>
            </div>
            <!--12.display number of records -->
            <div><?php echo mysqli_num_rows($result) . " rocord(s) found."; ?></div>

         </div>
     </div>
 </div>
 <!--11.JavaScript for edit and delete actions -->
 <script>
     //delete
     function delete_user(id) {
        if (confirm("Are you sure to delete this record?")) {
            window.location.href = "show_user.php?user_id=" + id;
        }
     }
     //update
     function update_user(id) {
         window.location.href = "update_user.php?user_id=" + id;
     }
 </script>

 </body>
 </html>        