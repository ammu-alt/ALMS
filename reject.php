<?php
include('dBConfig.php');
$landid = $_GET['landid'];
//echo "Land id is: " . $landid;
$data = [
  'STATUS' => "Rejected",
  'LANDID' => $landid
];
$sql = "UPDATE landsoil SET STATUS=:STATUS WHERE LANDID = :LANDID";

$stmt = $pdo -> prepare($sql);
$stmt -> execute($data);
$count = $stmt -> rowCount();
if($count > 0)  {
  $_SESSION['succmsg'] = "Application with id ".$landid." has been rejected";
  header("Location: ./verification.php");
} else {
  $_SESSION['errmsg'] = "Opps! Somethis happend. Try again later.";
  header("Location: ./verification.php");
}
?>
