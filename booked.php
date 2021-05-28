<?php
include('dBConfig.php');
$landid = $_GET['landid'];
//echo "Land id is: " . $landid;
$data = [
  'STATUS' => "Booked",
  'LANDID' => $landid
];
$sql = "UPDATE booking SET STATUS=:STATUS WHERE LANDID = :LANDID";

$stmt = $pdo -> prepare($sql);
$stmt -> execute($data);
$count = $stmt -> rowCount();
if($count > 0)  {
  $_SESSION['succmsg'] = "Application with id ".$landid." has been booked";
  header("Location: ./bookreq.php");
} else {
  $_SESSION['errmsg'] = "Opps! Somethis happend. Try again later.";
  header("Location: ./bookreq.php");
}
?>
