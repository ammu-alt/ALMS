<?php
    session_start();
    include('dBConfig.php');
    if (!$_SESSION['logged_in'])
    {
        header('Location: http://localhost/ALMS/loginform.php');
    }
    //function to Generate Random String like XX00000000
    function random_num($size) {
        $alpha_key = '';
        $keys = range('A', 'Z');

        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }

        $length = $size - 2;

        $key = '';
        $keys = range(0, 9);

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $alpha_key . $key;
    }

    if (isset($_POST["submit"]) && !empty($_POST)) {
      $LANDID = uniqid('LD');
      //$userid = uniqid('prefix');
      $file = $_FILES['img'];
      $soilreport = $_FILES['soilrpt'];

      $fileName = $file['name'];
      $soilrptName = $soilreport['name'];

      $fileTmpName = $file['tmp_name'];
      $SoilrptTmpName = $soilreport['tmp_name'];

      $fileSize = $file['size'];
      $soilrptsize = $soilreport['size'];

      $fileError = $file['error'];
      $soilrptError = $soilreport['error'];

      $fileType = $file['type'];
      $soilrptType = $soilreport['type'];

      $fileExt = explode('.', $fileName);
      $soilrptfileExt = explode('.', $soilrptName);

      $fileActualExt = strtolower(end($fileExt));
      $soilrptActualExt = strtolower(end($soilrptfileExt));

      $allowed = array('jpg', 'jpeg', 'png');
      if (in_array($fileActualExt, $allowed) && in_array($soilrptActualExt, $allowed)) {
        if ($fileError === 0  && $soilrptError ===0 ) {
          if ($fileSize < 1000000 && $soilrptsize < 1000000) {
            $fileNameNew = "landsoil".$LANDID.".".$fileActualExt;
            $soilrptNameNew = "soilrpt".$LANDID.".".$soilrptActualExt;

            $fileDestination = 'uploads/'.$fileNameNew;
            $fileDes = 'uploads/'.$soilrptNameNew;
            if(move_uploaded_file($fileTmpName, $fileDestination) && move_uploaded_file($SoilrptTmpName, $fileDes)) {
              //Get all data from the form

              $LAND_OWNERS_NAME = $_POST['name'];
              $CONTACT = $_POST['phone'];
              $PLACE = $_POST['place'];
              $POST_OFFICE = $_POST['po'];
              $PINCODE = $_POST['pin'];
              $LOCAL_BODY = $_POST['gram'];
              $NAME_OF_LOCAL_BODY = $_POST['localbody'];
              $WARD_NO = $_POST['wn'];
              $SURVEY_NO = $_POST['sn'];
              $VILLAGE = $_POST['village'];
              $TALUK = $_POST['taluk'];
              $DISTRICT = $_POST['district'];
              $LAND_AREA = $_POST['landarea'];
              $EXPECTING_LEASE_RATE = $_POST['rate'];
              $LAND_PICTURE = $fileNameNew;
              $SOIL_TEST_REPORT = $soilrptNameNew;
              $IRRIGATION_FACILITY = $_POST['irrtype'];
              $DROUGHT_AFFECTING_AREA = $_POST['daay'];
              $FLOOD_AFFECTING_AREA= $_POST['faay'];
              $data = [
                'LANDID' => $LANDID,
                'LAND_OWNERS_NAME' => $LAND_OWNERS_NAME,
                'CONTACT' => $CONTACT,
                'PLACE' => $PLACE,
                'POST_OFFICE' => $POST_OFFICE,
                'PINCODE' => $PINCODE,
                'LOCAL_BODY' => $LOCAL_BODY,
                'NAME_OF_LOCAL_BODY' => $NAME_OF_LOCAL_BODY,
                'WARD_NO' => $WARD_NO,
                'SURVEY_NO' => $SURVEY_NO,
                'VILLAGE' => $VILLAGE,
                'TALUK' => $TALUK,
                'DISTRICT' => $DISTRICT,
                'LAND_AREA' => $LAND_AREA,
                'EXPECTING_LEASE_RATE' => $EXPECTING_LEASE_RATE,
                'LAND_PICTURE' => $LAND_PICTURE,
                'SOIL_TEST_REPORT' => $SOIL_TEST_REPORT,
                'IRRIGATION_FACILITY' => $IRRIGATION_FACILITY,
                'DROUGHT_AFFECTING_AREA' => $DROUGHT_AFFECTING_AREA,
                'FLOOD_AFFECTING_AREA' => $FLOOD_AFFECTING_AREA
                ] ;
        //Insert data into the members table
        	$sql = 'INSERT INTO landsoil (LANDID, LAND_OWNERS_NAME, CONTACT,	PLACE,	POST_OFFICE,	PINCODE,	LOCAL_BODY,	NAME_OF_LOCAL_BODY, WARD_NO,	SURVEY_NO,	VILLAGE,	TALUK,	DISTRICT,	LAND_AREA,	EXPECTING_LEASE_RATE,	LAND_PICTURE,	SOIL_TEST_REPORT,	IRRIGATION_FACILITY,	DROUGHT_AFFECTING_AREA,	FLOOD_AFFECTING_AREA)
          VALUES (:LANDID, :LAND_OWNERS_NAME, :CONTACT,	:PLACE, :POST_OFFICE,	:PINCODE,	:LOCAL_BODY,	:NAME_OF_LOCAL_BODY, :WARD_NO,	:SURVEY_NO,	:VILLAGE,	:TALUK, :DISTRICT,	:LAND_AREA,	:EXPECTING_LEASE_RATE,	:LAND_PICTURE,	:SOIL_TEST_REPORT,	:IRRIGATION_FACILITY,	:DROUGHT_AFFECTING_AREA,	:FLOOD_AFFECTING_AREA);';
        	$stmt = $pdo -> prepare($sql);
        	$stmt -> execute($data);
        	$count = $stmt -> rowCount();
        	if($count > 0)  {
        	    //Data Successfully Inserted.
            $_SESSION['succmsg'] = 'Your application with id '.$LANDID.' has been submitted. Please wait for the verification.';
            } else {
                  //Failed to Insert data
                  $_SESSION['errmsg'] = 'Oops..Something Happened! Please try again Later!';
            }
            }
          } else {
            $_SESSION['errmsg'] =  "Your file is too big!";
          }
        } else {
          $_SESSION['errmsg'] = "There was an error in uploading your file!";
        }
      } else {
        $_SESSION['errmsg'] = "You Cannot upload files of this type!";
      }
      header('Location:id.php');
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Land and Soil Details</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  -->  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, textarea, p {
      padding: 0;
      margin: 0;
      outline: none;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      font-size: 16px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      position: absolute;
      margin: 0;
      font-size: 36px;
      color: rgb(7, 14, 73);
      z-index: 2;
      }
      h5 {
      margin: 10px 0;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
      }
      form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      background: #fff;
      box-shadow: 0 0 20px 0 #095484;
      }
      .banner {
      position: relative;
      height: 400px;
      background-image: url("homepage-banner.jpg");
      background-attachment: fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.5);
      position: absolute;
      width: 100%;
      height: 100%;
      }
      input, select, textarea {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      }
      select {
      width: 100%;
      padding: 7px 0;
      background: transparent;
      }
      textarea {
      width: calc(100% - 12px);
      padding: 5px;
      }
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder, a {
      color: #095484;
      }
      .item input:hover, .item select:hover, .item textarea:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 6px 0 #095484;
      color: #095484;
      }
      .item {
      position: relative;
      margin: 10px 0;
      }
      input[type="date"]::-webkit-inner-spin-button {
      display: none;
      }
      .item i, input[type="date"]::-webkit-calendar-picker-indicator {
      position: absolute;
      font-size: 20px;
      color: #a9a9a9;
      }
      .item i {
      right: 2%;
      top: 30px;
      z-index: 1;
      }
      [type="date"]::-webkit-calendar-picker-indicator {
      right: 1%;
      z-index: 2;
      opacity: 0;
      cursor: pointer;
      }
      input[type=radio], input[type=checkbox]  {
      display: none;
      }
      label.radio, label.check {
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
      label.radio:before, label.check:before {
      content: "";
      position: absolute;
      left: 0;
      }
      label.radio:before {
      width: 17px;
      height: 17px;
      border-radius: 50%;
      border: 2px solid #095484;
      }
      label.check:before {
      top: 2px;
      width: 16px;
      height: 16px;
      border-radius: 2px;
      border: 1px solid #095484;
      }
      input[type=checkbox]:checked + .check:before {
      background: #095484;
      }
      label.radio:after {
      left: 5px;
      border: 3px solid #095484;
      }
      label.check:after {
      left: 4px;
      border: 3px solid #fff;
      }
      label.radio:after, label.check:after {
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
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background: #095484;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background: #0666a3;
      }
      @media (min-width: 568px) {
      .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .city-item input {
      width: calc(50% - 20px);
      }
      .city-item select {
      width: calc(50% - 8px);
      }
      }
    </style>
    <style> select{width: 1750px; height: 50px} </style>
  </head>
  <body>
    <div class="testbox">
    <form method="post" enctype="multipart/form-data">
      <div class="banner">
        <h1><b><I>LAND AND SOIL DETAILS</I></b></h1>
      </div>
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
      <div class="city-item">
          <P></P>
        <!--<input type="text" name="landid" placeholder="LAND ID" required readonly/>-->
      </div>

      <fieldset><legend>LAND DETAILS</legend>

      <div class="item">
        <p>LAND OWNER'S NAME</p>
        <input type="text" name="name" required/>
      </div>
      <div class="item">
        <p>Phone<span class="required">*</span></p>
        <input type="text" name="phone" required/>
      </div>

      <!-- <div class="item">
        <p>Date</p>
        <input type="date" name="bdate" required/>
        <i class="fas fa-calendar-alt"></i>
      </div>
      <h5>1. Principal Investigator:</h5>
      <div class="item">
        <p>Name and Credentials<span class="required">*</span></p>
        <input type="text" name="name" required/>
      </div> -->
      <div class="item">
        <p>LAND ADDRESS<span class="required">*</span></p>
        Place<input type="text" name="place"  required/>
        Post Office<input type="text" name="po"  required/>
        Postal / Zip Code<input type="text" name="pin"  required/>
        <p>LOCAL BODY<span class="required">*</span></p>
        <div class="question">
        <div class="question-answer">
        <input type="radio" value="Grampachayath" id="radio_1" name="gram" required/>
        <label for="radio_1" class="radio"><span>GRAMAPANCHAYAT</span></label>
        <input type="radio" value="Muncipality" id="radio_2" name="gram" required/>
        <label for="radio_2" class="radio"><span>MUNCIPALITY</span></label>
        <input type="radio" value="Coorporation" id="radio_3" name="gram" required/>
        <label for="radio_3" class="radio"><span>COORPORATION</span></label>
        </div></div>
        <!-- <div class="city-item">
          <input type="text" name="name" placeholder="City" required/>
          <input type="text" name="name" placeholder="Region" required/>
          <select required>
            <option value="">Country</option>
            <option value="1">Russia</option>
            <option value="2">Germany</option>
            <option value="3">France</option>
            <option value="4">Armenia</option>
            <option value="5">USA</option>
          </select>
        </div> -->
      </div>
      <div class="item">
        NAME OF LOCAL BODY<input type="text" name="localbody" required />
      </div>
      <div class="item">
        WARD NUMBER<input type="text" name="wn" required/>
        </div>
      <!-- </div>
      <div class="item">
        <p>Email<span class="required">*</span></p>-->
        <div class="item">
        SURVEY NUMBER<input type="text" name="sn" required/>
      </div>
    <!--  <div class="item">
        VILLAGE OFFICE<input type="text" name="village" required />
      </div> -->
      <div class="form-group">
          Village Office<br>
          <select name="village">
          <option value="select" selected>SELECT YOUR VILLAGE</option>
          <option value="Airapuram">Airapuram</option>
          <option value="Alangad">Alangad</option>
          <option value="Aluva East">Aluva East</option>
          <option value="Aluva West">Aluva West</option>
          <option value="Amballur">Amballur</option>
          <option value="Angamali">Angamali</option>
          <option value="Arakkapady">Arakkapady</option>
          <option value="Arakuzha">Arakuzha</option>
          <option value="Ashamannur">Ashamannur</option>
          <option value="Ayyampuzha">Ayyampuzha</option>
          <option value="Chelamattam">Chelamattam</option>
          <option value="Chellanam">Chellanam</option>
          <option value="Chendamangalam">Chendamangalam</option>
          <option value="Chengamanad">Chengamanad</option>
          <option value="Cheranellur">Cheranellur</option>
          <option value="Chovvara">Chovvara</option>
          <option value="Choornikara">Choornikara</option>
          <option value="Edakkattuvayal">Edakkattuvayal</option>
          <option value="Edakochi">Edakochi</option>
          <option value="Edapilly North">Edapilly North</option>
          <option value="Edapilly south">Edapilly South</option>
          <option value="Edavanakkad">Edavanakkad</option>
          <option value="Elamkulam">Elamkulam</option>
          <option value="Elanji">Elanji</option>
          <option value="Elankunnapuzha">Elankunnapuzha</option>
          <option value="Elur">Elur</option>
          <option value="Enanalloor">Enanalloor</option>
          <option value="Eramallur">Eramallur</option>
          <option value="Ernakulam">Ernakulam</option>
          <option value="Ezhikkara">Ezhikkara</option>
          <option value="Fort Kochi">Fort Kochi</option>
          <option value="Iyakaranadu North">Iyakaranadu North</option>
          <option value="Iyakaranadu South">Iyakaranadu South</option>
          <option value="Kadamakkudi">Kadamakkudi</option>
          <option value="Kadungallur">Kadungallur</option>
          <option value="Kaipattur">Kaipattur</option>
          <option value="Kakkanad">Kakkanad</option>
          <option value="kalady">Kalady</option>
          <option value="Kallorkkad">Kallorkkad</option>
          <option value="Kanayannur">Kanayannur</option>
          <option value="Karimalur">Karimalur</option>
          <option value="Karukutti">Karukutti</option>
          <option value="Kedavoor">Kedavoor</option>
          <option value="Keecheri">Keecheri</option>
          <option value="Keerampara">Keerampara</option>
          <option value="Keezhmad">Keezhmad</option>
          <option value="Kizhakkambalam">Kizhakkambalam</option>
          <option value="Kizhakumbhagam">Kizhakumbhagam</option>
          <option value="Kodanad">Kodanad</option>
          <option value="Kombanadu">Kombanadu</option>
          <option value="Koothattukulam">Koothattukulam</option>
          <option value="Kothamangalam">Kothamangalam</option>
          <option value="Kottapady">Kottapady</option>
          <option value="Kottuvally">Kottuvally</option>
          <option value="Kulayettikkara">Kulayettikkara</option>
          <option value="Kumbalam">Kumbalam</option>
          <option value="Kumbalanji">Kumbalanji</option>
          <option value="Kunnathunad">Kunnathunad</option>
          <option value="Kunnukara">Kunnukara</option>
          <option value="Kureekad">Kureekad</option>
          <option value="Kuttamangalam">Kuttamangalam</option>
          <option value="Kuttampuzha">Kuttampuzha</option>
          <option value="Kuvappady">Kuvappady</option>
          <option value="Kuzhupilly">Kuzhupilly</option>
          <option value="malayattur">Malayattur</option>
          <option value="Manakunnam">Manakunnam</option>
          <option value="Maneed">Maneed</option>
          <option value="Manjalloor">Manjalloor</option>
          <option value="Manjapra">Manjapra</option>
          <option value="Maradu">Maradu</option>
          <option value="Marady">Marady</option>
          <option value="Marampilly">Marampilly</option>
          <option value="Mattancheri">Mattancheri</option>
          <option value="Mattur">Mattur</option>
          <option value="Mazhuvannur">Mazhuvannur</option>
          <option value="Memury">Memury</option>
          <option value="mookkannur">Mookkannur</option>
          <option value="Mulanthuruthi">Mulanthuruthi</option>
          <option value="Mulavoor">Mulavoor</option>
          <option value="Mulavukad">Mulavukad</option>
          <option value="Muthakunnam">Muthakunnam</option>
          <option value="Muvattupuzha">Muvattupuzha</option>
          <option value="Nadama">Nadama</option>
          <option value="Nayarambalam">Nayarambalam</option>
          <option value="Nedumbasseri">Nedumbasseri</option>
          <option value="Neriamangalam">Neriamangalam</option>
          <option value="Njarakkal">Njarakkal</option>
          <option value="Onakkoor">Onakkoor</option>
          <option value="Palakuzha">Palakuzha</option>
          <option value="Pallarimangalam">Pallarimangalam</option>
          <option value="Pallippuram">Pallippuram</option>
          <option value="Palluruthi">Palluruthi</option>
          <option value="Parakkadavu">Parakkadavu</option>
          <option value="Paravur">Paravur</option>
          <option value="Pattimattam">Pattimattam</option>
          <option value="Perumbavoor">Perumbavoor</option>
          <option value="Pindimana">Pindimana</option>
          <option value="Piravom">Piravom</option>
          <option value="Poonithura">Poonithura</option>
          <option value="Pothanikkad">Pothanikkad</option>
          <option value="Puthencuruz">Puthenkuruz</option>
          <option value="Puthenvelikkara">Puthenvelikkara</option>
          <option value="Puthuvaypu">Puthuvaypu</option>
          <option value="Ramamangalam">Ramamangalam</option>
          <option value="Rameswaram">Rameswaram</option>
          <option value="Rayamangalam">Rayamangalam</option>
          <option value="Thekkumbhagam">Thekkumbhagam</option>
          <option value="Thiruvaniyur">Thiruvaniyur</option>
          <option value="Thiruvankulam">Thiruvankulam</option>
          <option value="Thirumarady">Thirumarady</option>
          <option value="Thoppumpadi">Thoppumpadi</option>
          <option value="Thrikkakara North">Thrikkakara North</option>
          <option value="Thrikkariyoor">Thrikkariyoor</option>
          <option value="Thuravur">Thuravur</option>
          <option value="Vadakkekara">Vadakkekara</option>
          <option value="Vadakkumbhagam">Vadakkumbhagam</option>
          <option value="Vadavukode">Vadavukode</option>
          <option value="Valakam">Valakam</option>
          <option value="Varapetty">Varapetty</option>
          <option value="Varappuzha">Varappuzha</option>
          <option value="Vellurkunnam">Vellurkunnam</option>
          <option value="Vengola">Vengola</option>
          <option value="Vengoor East">Vengoor East</option>
          <option value="Vengur West">Vengur West</option>
          <option value="Vazhakkala">Vazhakkala</option>
          <option value="Vazhakkulam">Vazhakkulam</option>
          </select>
          <!--<input type="text" class="form-input" name="village" id="village office"  required/>-->
      </div>
    <!--  <div class="item">
        TALUK<input type="text" name="taluk" required />
      </div> -->
      <div class="form-group">
           Taluk<BR>
               <select  name="taluk">
                 <option value="select">SELECT YOUR TALUK</option>
                 <option value="Aluva">Aluva</option>
                 <option value="Kanayannur">Kanayannur</option>
                 <option value="Kochi">Kochi</option>
                 <option value="Kothamangalam">Kothamangalam</option>
                 <option value="Kunnathunad">Kunnathunad</option>
                 <option value="Muvattupuzha">Muvattupuzha</option>
                 <option value="Paravur">Paravur</option>
               </select>
           <!--<input type="text" class="form-input" name="name" id="taluk"  required/>-->
       </div>
      <div class="item">
        DISTRICT<input type="text" name="district" required />
      </div>
      <div class="item">
        LAND AREA(in cents)<input type="text" name="landarea" required />
      </div>
      <div class="item">
        EXPECTING LEASE RATE(per cent)<input type="text" name="rate" required />
      </div>
      <div class="item">
          <P>LAND PICTURE</P>
        <input type="file" name="img" required/>
      </div>

    </fieldset>

      <fieldset><legend>SOIL DETAILS</legend>

      <div class="item">
          <p>SOIL TEST REPORT</p>
        <input type="file" name="soilrpt" required/>

        IRRIGATION FACILITY TYPE<input type="text" name="irrtype"  required/>
        <!-- <div class="city-item">
          <input type="text" name="name" placeholder="City" required/>
          <input type="text" name="name" placeholder="Region" required/>
          <input type="text" name="name" placeholder="Postal / Zip code" required/>
          <select required>
            <option value="">Country</option>
            <option value="1">Russia</option>
            <option value="2">Germany</option>
            <option value="3">France</option>
            <option value="4">Armenia</option>
            <option value="5">USA</option>
          </select>
        </div>-->
        <div class="question">
        <p>DROUGHT AFFECTING AREA:<span class="required">*</span></p>
        <div class="question-answer">
          <input type="radio" value="Yes" id="radio_4" name="daay" required/>
          <label for="radio_4" class="radio"><span>Yes</span></label>
          <input type="radio" value="No" id="radio_5" name="daay" required/>
          <label for="radio_5" class="radio"><span>No</span></label>
        </div></div>
        <div class="question">
        <p>FLOOD AFFECTING AREA:<span class="required">*</span></p>
        <div class="question-answer">
          <input type="radio" value="Yes" id="radio_6" name="faay" required/>
          <label for="radio_6" class="radio"><span>Yes</span></label>
          <input type="radio" value="No" id="radio_7" name="faay" required/>
          <label for="radio_7" class="radio"><span>No</span></label>
        </div>
        </div>
      </div>
    </fieldset>
     <!--<div class="item">
        <p>Phone<span class="required">*</span></p>
        <input type="text" name="name" required/>
      </div>
      <div class="item">
        <p>Fax</p>
        <input type="text" name="name" />
      </div>
      <div class="item">
        <p>Email<span class="required">*</span></p>
        <input type="text" name="name" required/>
      </div>
      <h5>3. Institute Member</h5>
      <div class="question">
        <p>Principle investigator:<span class="required">*</span></p>
        <div class="question-answer">
          <input type="radio" value="none" id="radio_1" name="investigator" required/>
          <label for="radio_1" class="radio"><span>Yes</span></label>
          <input type="radio" value="none" id="radio_2" name="investigator" required/>
          <label for="radio_2" class="radio"><span>No</span></label>
        </div>
      </div>
      <div class="question">
        <p>Co-Investigator:<span class="required">*</span></p>
        <div class="question-answer">
          <input type="radio" value="none" id="radio_3" name="co-investigator" required/>
          <label for="radio_3" class="radio"><span>Yes</span></label>
          <input type="radio" value="none" id="radio_4" name="co-investigator" required/>
          <label for="radio_4" class="radio"><span>No</span></label>
        </div>
      </div>
      <h5>4. Have you applied for or are you now receiving funding support for this research?</h5>
      <div class="question">
        <p><span class="required">*</span></p>
        <div class="question-answer">
          <input type="radio" value="none" id="radio_5" name="research" required/>
          <label for="radio_5" class="radio"><span>Yes</span></label>
          <input type="radio" value="none" id="radio_6" name="research" required/>
          <label for="radio_6" class="radio"><span>No</span></label>
        </div>
      </div>
      <h5>5. IRB:</h5>
      <div class="question">
        <p>Have you applied for IRB review:</p>
        <div class="question-answer">
          <input type="radio" value="none" id="radio_7" name="IRB"/>
          <label for="radio_7" class="radio"><span>Yes</span></label>
          <input type="radio" value="none" id="radio_8" name="IRB"/>
          <label for="radio_8" class="radio"><span>No</span></label>
        </div>
      </div>
      <h5>6. Students only:</h5>
      <div class="item">
        <p>Name of research advisor:</p>
        <input type="text" name="name" />
      </div>
      <div class="item">
        <p>Include a letter of support from advisor in application packet.<span class="required">*</span></p>
        <textarea rows="3" required></textarea>
      </div>
      <div class="question">
        <p>Research Application Checklist:<span class="required">*</span></p>
        <small>Please include the following in your application.</small>
        <div class="question-answer checkbox-item">
          <div>
            <input type="checkbox" value="none" id="check_1" name="checklist" required/>
            <label for="check_1" class="check"><span>Proposal Cover Form</span></label>
          </div>
          <div>
            <input type="checkbox" value="none" id="check_2" name="checklist" required/>
            <label for="check_2" class="check"><span>Abstract</span></label>
          </div>
          <div>
            <input type="checkbox" value="none" id="check_3" name="checklist" required/>
            <label for="check_3" class="check"><span>Narrative</span></label>
          </div>
          <div>
            <input type="checkbox" value="none" id="check_4" name="checklist" required/>
            <label for="check_4" class="check"><span>Budget and Budget Justification</span></label>
          </div>
          <div>
            <input type="checkbox" value="none" id="check_5" name="checklist" required/>
            <label for="check_5" class="check"><span>Timeframe</span></label>
          </div>
          <div>
            <input type="checkbox" value="none" id="check_6" name="checklist" required/>
            <label for="check_6" class="check"><span>References</span></label>
          </div>
          <div>
            <input type="checkbox" value="none" id="check_7" name="checklist" required/>
            <label for="check_7" class="check"><span>Appendices</span></label>
          </div>
          <div>
            <input type="checkbox" value="none" id="check_8" name="checklist" required/>
            <label for="check_8" class="check"><span>Bio Sketch</span></label>
          </div>
          </div
        </div>
        <br />
        <div class="question">
          <p>If funding is approved I agree to do the following:<span class="required">*</span></p>
          <div class="question-answer checkbox-item">
            <div>
              <input type="checkbox" value="none" id="check_9" name="check" required/>
              <label for="check_9" class="check"><span>I agree to the <a href="https://www.w3docs.com/privacy-policy">terms of service.</a></span></label>
            </div>
          </div>
        </div>
        <div class="item">
          <p>Electronic signature<span class="required">*</span></p>
          <textarea rows="3" required></textarea>
        </div>-->
        <div class="btn-block">
          <button name="submit" type="submit">SUBMIT</button>
        </div>
        <BR><BR>


    </form>
    </div>
  </body>
</html>
