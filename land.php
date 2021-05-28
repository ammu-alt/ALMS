<?php
include('dBConfig.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Card</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<center>
<div class="container">
  <h2>Land Reservation</h2>
<div class="container">
  <h3>Book Your Land Here</h3>
</div>
</center>
<center>
<div class="row">
    <div class="col s12 m7">
      <div class="card">
        <div class="card-image">

          <?php

          $LANDID = $_GET['LANDID'];
          //echo "Land id is: " . $landid;
          $data = [
            //'STATUS' => "Approved",
            'LANDID' => $LANDID
          ];

            $sql = 'SELECT * FROM landsoil WHERE LANDID = :LANDID';
            $stmt = $pdo -> prepare($sql);
            $stmt -> execute();
            while ( $rows = $stmt -> fetch(PDO::FETCH_ASSOC)) {
              echo '
            <div class="tm-recommended-place">
                <img src="../uploads/'.$rows['LAND_PICTURE'].'" alt="Image" class="img-fluid tm-recommended-img">
                <div class="tm-recommended-description-box">
                    <h1 class="tm-recommended-title">'.$rows['LAND_AREA'].'  cent</h1>
                    <h2><p class="tm-text-highlight">'.$rows['DISTRICT'].'</p></h2>
                      <h3><p class="tm-text-highlight">'.$rows['TALUK'].'</p></h3>
                      <h4><p class="tm-text-highlight">'.$rows['PLACE'].'</p></h4>
                </div>
                <a href="./landdetails.php/landid?'.$rows['LANDID'].'" class="tm-recommended-price-box">
                    <p class="tm-recommended-price">'.$rows['EXPECTING_LEASE_RATE'].' /-</p>
                     <p class="tm-recommended-price-link">per cent</p>
                    <p class="tm-recommended-price-link">More Details</p>
                </a>
            </div>

            ';
            }

            ?>

          <!--<img src="images/sample-1.jpg">
          <span class="card-title">Card Title</span>-->
        </div>
        <div class="card-content">
          <p>I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.</p>
        </div>
        <div class="card-action">
          <a href="#">This is a link</a>
        </div>
      </div>
    </div>
  </div>
</center>
</body>
</html>
