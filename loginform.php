<?php
  session_start();
  include('dBConfig.php');
   if (isset($_POST["submit"]) && !empty($_POST)) {
     //Get all the values from the form
        $EMAIL = $_POST['email'];
        $PASSWORD = md5($_POST['pswd']);

        //Checks whether the user with giver id, password and status =1 exists
        $data = [
            'EMAIL' => $EMAIL,
            'PASSWORD' => $PASSWORD,
            'STATUS' => 1
        ];
        //print_r($data) ;
        $sql = 'SELECT * FROM userlogin WHERE EMAIL = :EMAIL AND PASSWORD = :PASSWORD AND STATUS = :STATUS';
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute($data);
        $count = $stmt -> rowCount();
        if ($count > 0) {
            $row = $stmt -> fetch();
            $ACCTYPE = $row['ACCTYPE'];
          //Set SESSION Variables
            $_SESSION['username'] = $EMAIL;

            $_SESSION['logged_in'] = true;
            if ($ACCTYPE == 0){
                    //Re-Direct: Adminpanel
                    $_SESSION['acctype'] = "Administrator";
                    header("location: http://localhost/ALMS/adminpanel.php");
                  }
                else if($ACCTYPE == 2){
                    //Re-Direct: member panel
                    $_SESSION['acctype'] = "Customer";
                    header("location: http://localhost/ALMS/view/index.php");
                } else {
                  $_SESSION['acctype'] = "Village_Officer";
                  header("location: http://localhost/ALMS/vopanel.php");
                }
        } else {
          $_SESSION['errmsg'] = 'Enter valid Account';
        }
   }
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <title>LOGIN</title>
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
     <style>
       html, body {
       display: flex;
       justify-content: center;
       font-family: Roboto, Arial, sans-serif;
       font-size: 15px;
       padding-top: 20px;
       background-image: url("348959.jpg");
       background-position: center;
       background-size: cover;
       }
       form {
       border: 5px solid #f3f0f0;
       background-color: #f3f0f0;

       }
       input[type=text], input[type=password] {
       width: 100%;
       padding: 16px 8px;
       margin: 8px 0;
       display: inline-block;
       border: 1px solid #ccc;
       box-sizing: border-box;
       }
       button {
       background-color: #6cca36;
       color: white;
       padding: 14px 0;
       margin: 10px 0;
       border: none;
       cursor: grabbing;
       width: 100%;
       font-size: large;
       }
       h1 {
       text-align:center;
       fone-size:18;
       }
       button:hover {
       opacity: 0.8;
       }
       .formcontainer {
       text-align: left;
       margin: 24px 50px 12px;
       padding-top: 0%;
       }
       .container {
       padding: 16px 0;
       text-align:left;
       }
       span.psw {
       float: right;
       padding-top: 0;
       padding-right: 15px;
       }
       /* Change styles for span on extra small screens */
       @media screen and (max-width: 300px) {
       span.psw {
       display: block;
       float: none;
       }}
     </style>
   </head>
   <body>
     <form method="post">
       <h1>LOGIN</h1>

       <div class="formcontainer">
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
       <hr/>
       <div class="container">
         <label for="uname"><strong>Your email</strong></label>
         <input type="text"  placeholder="Enter Email address" name="email" required>
         <label for="uname"><strong>Your password</strong></label>
         <input type="password"  placeholder="Enter your password" name="pswd" required>
       </div>
       <center> <a href="ALMS/assets/forgotpswd.html">forgot password</a> </center>
       <button name="submit" type="submit"><strong>Submit</strong></button>

     </form>
   </body>
 </html>
