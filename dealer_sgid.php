<?php
session_start();
if (!isset($_SESSION['loggedin2']) || $_SESSION['loggedin2'] == !true) {
  header('location: home.php');
  exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/db_connect.php';
  $dealerremark = $_POST['dealerremark'];
  $sgid = $_COOKIE['variable'];
  $sql = "UPDATE `complaint` SET `dealerremark`='$dealerremark' WHERE `complaint`.`sgid` = $sgid;";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $_SESSION['value'] = "forwarded";
    header("location: confirm2.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.png" type="image/png">
  <title>IPAS - Dealer </title>
  <style>
        * {
        padding: 0;
        margin: 0;
        box-sizing: none;
      }
      .container{
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      .container1{
        width: 100%;
        height: 10%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #0d42ff;
        color: white;
        box-shadow: rgba(48, 66, 85, 0.638) 0px 20px 30px 0px;
        z-index: 1;
      }
      #btn{
        position: absolute;
        transform: translateX(-520%);
        display: flex;
        align-items: center;
        justify-content: left;
        cursor: pointer;
        width: 8.5%;
        height: 7vh;
        padding: 1% 0.5%;
        border: 2px solid white;
        border-radius: 20px;
        background-color: transparent;
        font-size: 0.9rem;
        color: white;
      }
      #btn img{
        width: 30%;
        margin-right: 15%;
      }
        .container2{
          width: 100%;
          height: 90%;
          display: flex;
          align-items: center;
        }
      .item2{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
      }
      .item2 h1{
        height: 2vh;
        color: #0d42ff;
      }
      /* .contain1{
        width: 80%;
        height: 22vh;
        border: 2px solid #0d42ff;
        border-radius: 20px;
        overflow-y: scroll;
        padding: 2% 2%;
        background-color: rgb(222, 235, 246);
      } */
      ::-webkit-scrollbar{
        width: 10px;
      }
      ::-webkit-scrollbar-thumb{
        background-color: #0d42ff;
        border-radius: 10px;
        margin-right: 10%;
      }
      .contain2{
        width: 80%;
        height: 40vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
      }
      #form1{
        width: 100%;
        height: 80%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
      }
      #form1 textarea{
        width: 100%;
        height: 20vh;
        border-radius: 12px;
        border: 2px solid #0d42ff;
        padding: 2%;
        font-size: 1.3rem;
        text-justify: inter-word;
      }
      #form1 textarea:hover,#form1 textarea:focus,#form1 textarea:valid {
        background-color: rgb(222, 235, 246);
      }
      #form1 button{
        width: 11%;
        height: 7vh;
        cursor: pointer;
        border-radius: 12px;
        font-size: 1.1rem;
        background-color: #0d42ff;
        border: 2px solid #0d42ff;
        transition: transform 0.5s;
        font-weight: bolder;
        color: white;
        margin-top: 2%;
      }
      #form1 button:hover{
        background-color: transparent;
        transform: scale(1.1);
        color: #0d42ff;
      }
      .contain1{
        width: 83%;
        height: 27vh;
        border: 2px solid #0d42ff;
        border-radius: 20px;
        overflow-y: scroll;
        /* padding: 0% 2%; */
        background-color: rgb(222, 235, 246);
        font-size: 1.3rem;
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
        font-size: 1.3rem;
        color: rgb(255, 255, 0);
      }
      .box2 {
        width: 70%;
        display: flex;
        flex-direction: column;
        align-items: start;
        padding: 1%;
        /* border-left: 2px solid #0d42ff; */
        overflow-y: scroll;
        color: red;
      }
      .box2 h4 {
        margin-top: 1%;
        color: black;
      }
    </style>
</head>

<body onload="funcgen()">
  <div class="container">
    <div class="container1">
      <h1>SG ID - <b id="uniquww"></b></h1>
      <button id="btn" onclick="location.href='/railway/dealer.php'"><img src="back.png">BACK</button>
    </div>
    <div class="container2">
      <div class="item2">
        <h1>Complaint</h1>
        <div class="contain1" id="contains1">
          <?php
          include 'partials/db_connect.php';
          $sgid = $_COOKIE['variable'];
          $sql = "Select * from complaint where sgid='$sgid'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          ?>
          <div class="box1">
                  <h3>Division - <b><?php
                  $div =$row['division'];
                  $sql = "Select * from division where unit='$div'";
                  $result1 = mysqli_query($conn, $sql);
                 $row1 = mysqli_fetch_assoc($result1);
                   echo $row1['unitdesc'];  ?></b></h3>
                  <h3>Section - <b><?php 
                  $sec =$row['section'];
                  $sql = "Select * from section where sectioncode='$sec'";
                  $result2 = mysqli_query($conn, $sql);
                 $row2 = mysqli_fetch_assoc($result2);
                   echo $row2['secdesc'];  ?></b></h3>
                  <h3>Userid - <b><?php echo $row['userid'];  ?></b></h3>
                  <h3>Name - <b><?php echo $row['name'];  ?></b></h3>
                </div>
                <div class="box2">
                  <h3>Complaint Description-</h3>
                  <h4><?php echo $row['comdesc'];  ?></h4>
                </div>
        </div>
        <h1>Remark</h1>
        <div class="contain2" id="contains2">
          <form action="/railway/dealer_sgid.php" id="form1" method="post">
            <textarea name="dealerremark" id="dealerremark" cols="30" rows="10" required></textarea>
            <button type="submit">FORWARD</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    function funcgen() {
      document.getElementById("uniquww").innerHTML = localStorage.getItem("unid1");
    }
  </script>
</body>

</html>