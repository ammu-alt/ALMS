<?php
    session_start();
    include('dBConfig.php');
    if (!$_SESSION['logged_in'])
    {
        header('Location: http://localhost/ALMS/loginform.php');
    }
    if (isset($_POST["submit"]) && !empty($_POST)) {

        //Get all the values from the form

        $NAME = $_POST['name'];
	      $CONTACT = $_POST['phone'];
        $LANDID = $_POST['landid'];
        $SERVICE_YOU_NEED = $_POST['syn'];

        $data = [
                'NAME' => $NAME,
		            'CONTACT' => $CONTACT,
                'LANDID' =>  $LANDID,
                'SERVICE_YOU_NEED' => $SERVICE_YOU_NEED
                ] ;
        //Insert data into the members table
        	$sql = 'INSERT INTO customercare (NAME, CONTACT, LANDID, SERVICE_YOU_NEED) VALUES (:NAME, :CONTACT, :LANDID, :SERVICE_YOU_NEED);';
        	$stmt = $pdo -> prepare($sql);
        	$stmt -> execute($data);
        	$count = $stmt -> rowCount();
        	if($count > 0)  {
        	    //Data Successfully Inserted.
              $_SESSION['succmsg'] = 'Your application is being processed. We will contact you shortly.';
            } else {
                  //Failed to Insert data
                  $_SESSION['errmsg'] = 'Oops..Something Happened! Please try again Later!';
            }
                header('Location:submitservice.php');
        }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Contact form</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
      html, body {
      min-height: 100%;
      padding: 0;
      margin: 0;
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      font-size: 16px;
      color: #666;
      }
      h1 {
      margin: 0 0 20px;
      font-weight: 400;
      color: #074710;
      }
      p {
      margin: 0 0 5px;
      }
      .main-block {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #078317;
      }
       /*.left-part {
        background-image: url("photo_2020-10-09_21-45-37.jpg");
        background-position: center;
        background-size: contain;
        background-clip: padding-box;

      }*/
      form {
      padding: 25px;
      margin: 25px;
      box-shadow: 0 2px 5px #f5f5f5;
      background: #f5f5f5;
      }
      .fas {
      margin: 25px 10px 0;
      font-size: 72px;
      color: #fff;
      }
      .fa-envelope {
      transform: rotate(-20deg);
      }
      .fa-at , .fa-mail-bulk{
      transform: rotate(10deg);
      }
      input, textarea {
      width: calc(100% - 18px);
      padding: 8px;
      margin-bottom: 20px;
      border: 1px solid #074710;
      outline: none;
      }
      input::placeholder {
      color: #666;
      }
      button {
      width: 50%;
      padding: 10px;
      border: none;
      background: #074710;
      font-size: 16px;
      font-weight: 400;
      color: #fff;
      }
      button:hover {
      background: #074702;
      }
      @media (min-width: 568px) {
      .main-block {
      flex-direction: row;
      }
      .left-part, form {
      width: 50%;
      }
      .fa-envelope {
      margin-top: 0;
      margin-left: 20%;
      }
      .fa-at {
      margin-top: -10%;
      margin-left: 65%;
      }
      .fa-mail-bulk {
      margin-top: 2%;
      margin-left: 28%;
      }
      input[type=checkbox]  {
      display: none;
      }
      label.check {
      position: relative;
      display: inline-block;
      margin: 5px 20px 15px 0;
      cursor: pointer;
      }
      .question span {
      margin-left: 30px;
      }
      span.required {
      margin-left: 0;
      color: red;
      }
      .checkbox-item label {
      margin: 5px 20px 10px 0;
      }
     label.check:before {
      content: "";
      position: absolute;
      left: 0;
      }
      label.check:before {
      top: 2px;
      width: 16px;
      height: 16px;
      border-radius: 2px;
      border: 1px solid #074710;
      }
      input[type=checkbox]:checked + .check:before {
      background: #074710;
      }
      label.check:after {
      left: 4px;
      border: 3px solid #fff;
      }
      label.check:after {
      content: "";
      position: absolute;
      top: 6px;
      width: 8px;
      height: 4px;
      background: transparent;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after, input[type=checkbox]:checked + label:after {
      opacity: 1;
      }
      }
    </style>
  </head>
  <body>
    <div class="main-block">
      <div class="left-part">
        <i class="fas fa-envelope"></i>
        <i class="fas fa-at"></i>
        <i class="fas fa-mail-bulk"></i>
      </div>
      <form method="post">
        <center><h1><B>Contact Us</B></h1></center>
        <div>
                      <?php
                          if (!empty($_SESSION['errmsg'])) {
                              echo '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                              echo $_SESSION['errmsg'];
                              echo '</div>';
                              unset($_SESSION['errmsg']);
                          }
                          if (!empty($_SESSION['succmsg'])) {
                              echo '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                              echo $_SESSION['succmsg'];
                              echo '</div>';
                              unset($_SESSION['succmsg']);
                          }
                      ?>
                    </div>
        <br>
        <div class="info">
          <b>Your Name</b>
          <input class="fname" type="text" name="name" required>
          <b>Phone Number</b>
          <input type="text" name="phone" required>
          <b>Land Id</b>
          <input type="text" name="landid" required>
        </div>
        <b>Enter the Services You Need<br>(Machinery, Labour, Seeds, Fertilizers, Tools, Others) </b>
        <input type="text" name="syn" required>
        <!--<div class="question">
            <p>Services you need:<span class="required">*</span></p>
            <div class="question-answer checkbox-item">
              <div>
                <input type="checkbox" value="none" id="check_1" name="syn"/>
                <label for="check_1" class="check"><span>Machinery</span></label>
              </div>
              <div>
                <input type="checkbox" value="none" id="check_2" name="syn"/>
                <label for="check_2" class="check"><span>Labour</span></label>
              </div>
              <div>
                <input type="checkbox" value="none" id="check_3" name="syn"/>
                <label for="check_3" class="check"><span>Fertilizers</span></label>
              </div>
              <div>
                <input type="checkbox" value="none" id="check_4" name="syn"/>
                <label for="check_4" class="check"><span>Tools</span></label>
              </div>
              <div>
                <input type="checkbox" value="none" id="check_5" name="syn"/>
                <label for="check_5" class="check"><span>Seeds</span></label>
              </div>
              <div>
                <input type="checkbox" value="none" id="check_6" name="syn"/>
                <label for="check_6" class="check"><span>Others</span></label>
              </div>
            </div>
         </div>-->
         <br><br><br>
        <center><button type="submit" name="submit">Submit</button></center>
        <br><br>
        <center> <P><B>HELP DESK CONTACT NO: 9207592982</B></P></center>

      </form>
    </div>
  </body>
</html>
