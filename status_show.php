<?php
session_start();
$sgid = $_SESSION['sgid3'];
if (!isset($_SESSION['loggedin4']) || $_SESSION['loggedin4'] == !true) {
  header('location: home.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.png" type="image/png">
  <title>IPAS - Complaint Status </title>
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: none;
    }

    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-thumb {
      background-color: #0d42ff;
      border-radius: 10px;
      margin-right: 10%;
    }

    .container {
      width: 100%;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .container1 {
      width: 100%;
      height: 10%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #0d42ff;
      color: white;
      box-shadow: rgba(48, 66, 85, 0.638) 0px 20px 30px 0px;
    }

    .container1 h1 {
      word-spacing: 10px;
      /* letter-spacing: 10px; */
    }

    .container1 img {
      position: absolute;
      width: 2.5%;
      left: 2%;
      top: 2.6%;
    }

    .container2 {
      width: 100%;
      height: 90%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .item2 {
      width: 85%;
      height: 90%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-around;
      color: #0d42ff;
      margin: 2% 0;
      font-size: 1rem;
    }

    .boxs {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      height: 25vh;
      width: 80%;
    }

    #boxs {
      justify-content: center;
      height: 10vh;
    }

    .box {
      height: 15vh;
      width: 95%;
      padding: 1% 2%;
      font-size: 1.3rem;
      border-radius: 12px;
      border: 2px solid #0d42ff;
      text-align: center;
      color: black;
    }

    #box1 {
      height: 6vh;
      font-size: 2.5rem;
      font-weight: bolder;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0.5%;
      border: transparent;
    }

    .contain1 {
      width: 99%;
      height: 27vh;
      border: 2px solid #0d42ff;
      border-radius: 20px;
      overflow-y: scroll;
      /* padding: 0% 2%; */
      background-color: rgb(222, 235, 246);
      font-size: 1.2rem;
      display: flex;
    }

    .box1 {
      width: 30%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: #0d42ff;
      color: white;
    }

    .box1 b {
      font-size: 1.2rem;
      color: rgb(255, 255, 0);
    }

    .box2 {
      width: 70%;
      display: flex;
      flex-direction: column;
      align-items: start;
      padding: 1%;
      overflow-y: scroll;
      color: red;
    }

    .box2 h4 {
      margin-top: 1%;
      color: black;
    }
  </style>
</head>

<body onload="funcload()">
  <div class="container">
    <div class="container1">
      <a href="/railway/logout.php"><img src="home.png"></a>
      <h1>COMPLAINT STATUS</h1>
    </div>

    <?php
    include 'partials/db_connect.php';
    $sql = "Select * from complaint where sgid='$sgid';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sec = $row['section'];
    $sql = "Select * from section where sectioncode='$sec'";
    $result2 = mysqli_query($conn, $sql);
    $row2 = mysqli_fetch_assoc($result2);
    $div = $row['division'];
    $sql = "Select * from division where unit='$div'";
    $result1 = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_assoc($result1);
    if ($row['status'] == 'pending') {
      echo '<div class="container2">
          <div class="item2">
            <div class="boxs" id="boxs">
            <h1>Status</h1>
            <div class="box" id="box1" style="color: red; text-align: center;">PENDING</div>
          </div>
          <div class="boxs">
            <h1>Complaint</h1>
            <div class="contain1" id="contains1">
              <div class="box1">
                <h3>Division - <b>' . $row1['unitdesc'] . '</b></h3>
                <h3>Section - <b>' . $row2['secdesc'] . '</b></h3>
                <h3>Userid - <b>' . $row['userid'] . ' </b></h3>
                <h3>Name - <b>' . $row['name'] . ' </b></h3>
              </div>
              <div class="box2">
                <h3>Complaint Description-</h3>
                <h4>
                ' . $row['comdesc'] . ' 
                </h4>
              </div>
            </div>
          </div>
          </div>
      </div>';
    } else if ($row['status'] == 'underprocess') {
      echo '<div class="container2">
          <div class="item2">
            <div class="boxs" id="boxs">
            <h1>Status</h1>
            <div class="box" id="box1" style="color: rgb(203, 203, 59); text-align: center;">UNDERPROCESS</div>
          </div>
          <div class="boxs">
            <h1>Complaint</h1>
            <div class="contain1" id="contains1">
              <div class="box1">
                <h3>Division - <b>' . $row1['unitdesc'] . '</b></h3>
                <h3>Section - <b>' . $row2['secdesc'] . '</b></h3>
                <h3>Userid - <b>' . $row['userid'] . ' </b></h3>
                <h3>Name - <b>' . $row['name'] . ' </b></h3>
              </div>
              <div class="box2">
                <h3>Complaint Description-</h3>
                <h4>
                ' . $row['comdesc'] . ' 
                </h4>
              </div>
            </div>
          </div>
          </div>
      </div>';
    } else if ($row['dealerremark'] == NULL and $row['status'] == 'resolved') {
      echo '<div class="container2">
          <div class="item2">
            <div class="boxs" id="boxs">
            <h1>Status</h1>
            <div class="box" id="box1" style="color: green; text-align: center;">RESOLVED</div>
          </div>
          <div class="boxs">
            <h1>Complaint</h1>
            <div class="contain1" id="contains1">
              <div class="box1">
                <h3>Division - <b>' . $row1['unitdesc'] . '</b></h3>
                <h3>Section - <b>' . $row2['secdesc'] . '</b></h3>
                <h3>Userid - <b>' . $row['userid'] . ' </b></h3>
                <h3>Name - <b>' . $row['name'] . ' </b></h3>
              </div>
              <div class="box2">
                <h3>Complaint Description-</h3>
                <h4>
                ' . $row['comdesc'] . ' 
                </h4>
              </div>
            </div>
          </div>
          <div class="boxs">
            <h1>Admin Remark</h1>
            <div class="box" id="box3">' . $row['adminremark'] . '</div>
          </div>
      </div>';
    } else {
      echo '<div class="container2">
          <div class="item2">
            <div class="boxs" id="boxs">
            <h1>Status</h1>
            <div class="box" id="box1" style="color: green; text-align: center;">RESOLVED</div>
          </div>
          <div class="boxs">
            <h1>Complaint</h1>
            <div class="contain1" id="contains1">
              <div class="box1">
                <h3>Division - <b>' . $row1['unitdesc'] . '</b></h3>
                <h3>Section - <b>' . $row2['secdesc'] . '</b></h3>
                <h3>Userid - <b>' . $row['userid'] . ' </b></h3>
                <h3>Name - <b>' . $row['name'] . ' </b></h3>
              </div>
              <div class="box2">
                <h3>Complaint Description-</h3>
                <h4>
                ' . $row['comdesc'] . ' 
                </h4>
              </div>
            </div>
          </div>
          <div class="boxs">
            <h1>Dealer Remark</h1>
            <div class="box" id="box3">' . $row['dealerremark'] . '</div>
          </div>
          <div class="boxs">
            <h1>Admin Remark</h1>
            <div class="box" id="box4">' . $row['adminremark'] . '</div>
          </div>

      </div>';
    }
    ?>
  </div>
</body>

</html>