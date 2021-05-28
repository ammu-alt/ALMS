<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<center>
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
<BR><BR><BR><BR><BR><BR>
<h3><b>Your Application Has Been Successfully Submitted.<BR>
<br>We Will Contact You Soon to Provide Your Needs. <BR>
<br>Thank You for Using Our Services.<br>Have a Great Day.</b></h3>
<BR><BR>
<input type="button" name="back" value="BACK" onclick="location.href='view/index.php'">

</center>
</body>
</html>
