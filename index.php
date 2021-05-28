<?php
  session_start();
  include('dBConfig.php');
   if (isset($_POST["login"]) && !empty($_POST)) {
     //Get all the values from the form
     echo "ALMS";
        $EMAIL = $_POST['id'];
        $PASSWORD = md5($_POST['pswd']);
        echo $PASSWORD;
        //Checks whether the user with giver id, password and status =1 exists
        $data = [
            'EMAIL' => $EMAIL,
            'PASSWORD' => $PASSWORD,
            'STATUS' => 1
        ];
        $sql = 'SELECT * FROM userlogin WHERE EMAIL = :EMAIL AND PASSWORD = :PASSWORD AND STATUS = :STATUS';
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute($data);
        $count = $stmt -> rowCount();
      //  if($count == 0){echo "No Data";}
        $row = $stmt -> fetch();
        //$username1 = $row['username'];
        //echo $password;
        $ACCTYPE = $row['acctype'];
        //echo "TEST";
        //echo $acctype;
        if ($count > 0) {
          //Set SESSION Variables
            $_SESSION['username'] = $EMAIL;
            $_SESSION['acctype'] = $ACCTYPE;
            $_SESSION['logged_in'] = true;
            if ($ACCTYPE == 0){
                    //Re-Direct: Adminpanel
                    header("location: http://localhost/ALMS/index.php");
                } else {
                    //Re-Direct: member panel
                    header("location: http://localhost/ALMS/loginform.php");
                }
        } else {
          $_SESSION['errmsg'] = 'Enter valid Account';
        }
   }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ALMS</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Siimple - v2.1.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-landing-page/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <!--<header id="header">
    <div class="container-fluid">

      <div class="logo float-left">
        <h1 class="text-light"><a href="index.html"><span>ALMS</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    <!--  </div>

      <button type="button" class="nav-toggle"><i class="bx bx-menu"></i></button>
      <nav class="nav-menu">
        <ul>
          <li class="active"><a href="#header">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#why-us">Why Us</a></li>
          <li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Drop Down 2</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact Us</a></li>
        </ul>
      </nav><!-- .nav-menu -->

  <!--  </div>
  </header><!-- End #header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <h1>AGRICULTURAL LAND MANAGEMENT SYSTEM</h1>
      <div>
        <br>
        <br>
        <br>
        <button type="button" class="btn btn-success" onclick="location.href='loginform.php'">LOGIN </button>
        <button type="button" class="btn btn-success" onclick="location.href='registrationForm/index.php'">REGISTER</button>
        <button type="button" class="btn btn-success" onclick="location.href='VOreg/index.php'">VO REGISTER</button>
      </div>
<!-- <h2>Please, fill out the for below to be notified for the latest updates!</h2> -->
    <!--  <form align="left" action="forms/notify.php" method="post" role="form" class="php-email-form">

        <div class="row no-gutters">
          <div class="col-md-6 form-group pr-md-1">

            <input type="text" name="id" class="form-control" id="id" placeholder="Email" data-msg="Please enter a valid id" />
            <div class="validate"></div>
          </div>
          <div class="col-md-6 form-group pl-md-1">

            <input type="email" class="form-control" name="pswd" id="pswd" placeholder="Password" data-msg="Please enter a valid password" />
            <div class="validate"></div>
          </div>
        </div>

        <div class="mb-1">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your notification request was sent. Thank you!</div>
        </div>
        <div class="text-center"><button type="submit" name= "login">LOG IN</button><br>
         <button type="button" onclick="location.href='registrationForm/index.php'">Click here for SIGN UP</button>
        </div>
        </form>
      </form> -->
  <!--  </div>
  </section><!-- #hero -->

  <!--<main id="main">

    <!-- ======= About Section ======= -->
<!--    <section id="about" class="about">

    </section><!-- End Contact Us Section -->

<!--  </main><!-- End #main -->


  <!-- Vendor JS Files -->
<!--  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <!-- <script src="assets/js/main.js"></script>
-->
</body>

</html>
