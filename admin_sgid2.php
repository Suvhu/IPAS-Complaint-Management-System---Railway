<?php
session_start();
if (!isset($_SESSION['loggedin1']) || $_SESSION['loggedin1'] == !true) {
  header('location: home.php');
  exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/db_connect.php';
  $adminremark = $_POST['adminremark'];
  $sgid = $_COOKIE['variable'];
  $sql = "UPDATE `complaint` SET `adminremark` = '$adminremark',`status` = 'resolved' WHERE `complaint`.`sgid` = $sgid;";
  $result = mysqli_query($conn, $sql);
  if($result){
    $_SESSION['value'] = "resolved";
    header("location: confirm.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.png" type="image/png">
  <title>IPAS - Admin </title>
  <style>
        * {
        padding: 0;
        margin: 0;
        box-sizing: none;
      }
      ::-webkit-scrollbar{
        width: 10px;
      }
      ::-webkit-scrollbar-thumb{
        background-color: #0d42ff;
        border-radius: 10px;
        margin-right: 10%;
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
      .container2{
        width: 100%;
        height: 90%;
        display: flex;
        align-items: center;
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
      .item2{
        width: 100%;
        height: 100%;
        /* background-color: #0d42ff; */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        color: #0d42ff;
      }
      .item2 form{
        width: 90%;
        height: 90%;
        /* background-color: pink; */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        /* transform: translateY(-6%); */
      }
      #complaint{
        height: 14vh;
        text-align: center;
        background-color: rgb(222, 235, 246);
      }
      #dremark{
        text-align: center;
        background-color: rgb(222, 235, 246);
      }
      #aremark:hover,#aremark:focus,#aremark:valid {
        background-color: rgb(222, 235, 246);
      }
      .item2 form textarea{
        width: 90%;
        border-radius: 12px;
        padding: 2% 2%;
        height: 6vh;
        font-size: 1.2rem;
        border: 2px solid #0d42ff;
      }
      .item2 form button{
        width: 10%;
        height: 6vh;
        cursor: pointer;
        border-radius: 12px;
        font-size: 1.1rem;
        background-color: rgb(43, 238, 43);
        border: 2px solid rgb(43, 238, 43);
        transition: transform 0.5s;
        font-weight: bolder;
        color: white;
      }
      .item2 form button:hover{
        background-color: transparent;
        transform: scale(1.1);
        color: rgb(43, 238, 43);
      }

      .contain1{
        width: 94%;
        height: 25vh;
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
      <h1>SG ID - <b id="uniquw"></b></h1>
      <button id="btn" onclick="location.href='/railway/admin.php'"><img src="back.png">BACK</button>
    </div>
    <div class="container2">
      <div class="item2" id="item2">
        <form action="/railway/admin_sgid2.php" method="post">
          <?php
          include 'partials/db_connect.php';
          $sgid = $_COOKIE['variable'];
          $sql = "Select * from complaint where sgid='$sgid'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $comdesc = $row['comdesc'];
          $dealerremark = $row['dealerremark']
            ?>
            <h1>Complaint </h1>
            <div class="contain1" id="contains1">
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
                <h4>
                <?php echo $row['comdesc'];  ?>
                </h4>
              </div>
            </div>
          <h1>Dealer Remark</h1>
          <textarea name="" id="dremark" readonly><?php echo "$dealerremark"; ?></textarea>
          <h1>Remark</h1>
          <textarea name="adminremark" id="aremark" required></textarea>
          <button type="submit">RESOLVE</button>
        </form>
      </div>
    </div>
  </div>
  <script>
    function funcgen() {
      document.getElementById("uniquw").innerHTML = localStorage.getItem("uniid2");
    }
  </script>
</body>

</html>