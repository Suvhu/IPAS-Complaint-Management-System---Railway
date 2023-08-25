<?php
session_start();
$adminid = $_SESSION['adminid'];
if (!isset($_SESSION['loggedin1']) || $_SESSION['loggedin1'] == !true) {
  header('location: home.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="favicon.png" type="image/png">
  <title>IPAS - Admin </title>
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: none;
    }

    ::-webkit-scrollbar {
      width: 5px;
    }

    ::-webkit-scrollbar-thumb {
      background-color: #0d42ff;
      border-radius: 10px;
    }

    .container {
      width: 100%;
      height: 100vh;
      display: flex;
    }

    .container1 {
      width: 15%;
      height: 100vh;
      background-color: #0d42ff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: white;
      z-index: 1;
    }

    .container1 h1 {
      position: absolute;
      transform: translate(8%, -400%);
    }

    .btns {
      position: absolute;
      width: 50%;
      height: 20%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      transform: translateY(-100%);
    }

    .btns button {
      width: 20%;
      height: 33%;
      border-radius: 12px;
      font-size: 1.4rem;
      cursor: pointer;
      border: 2px solid white;
      transition: transform 0.5s;
      font-weight: bolder;
    }

    .btns button:hover {
      transform: scale(1.0);
    }

    #button1 {
      background-color: white;
      color: #0d42ff;
    }

    #button2 {
      background-color: #0d42ff;
      color: white;
    }

    #btn {
      position: absolute;
      transform: translateY(600%);
      display: flex;
      align-items: center;
      justify-content: left;
      cursor: pointer;
      width: 9.5%;
      height: 7vh;
      padding: 1% 0.5%;
      border: 2px solid white;
      border-radius: 20px;
      background-color: transparent;
      font-size: 0.9rem;
      color: white;
    }

    #btn img {
      width: 20%;
      margin-right: 15%;
    }

    .container2 {
      width: 100%;
      height: 100vh;
      display: flex;
      overflow: auto;
      position: absolute;
    }

    .container2 .table {
      width: 85%;
      margin-top: 2%;
      transform: translateX(15%);
    }

    .table thead {
      display: flex;
      width: 100%;
      justify-content: end;
      font-size: 1.5rem;
      color: #0d42ff;
    }

    thead tr {
      display: flex;
      width: 90%;
      justify-content: end;
    }

    thead tr .id {
      display: flex;
      width: 25%;
      justify-content: center;
    }

    thead tr .com {
      display: flex;
      width: 50%;
      justify-content: center;
    }

    .table tbody {
      display: flex;
      flex-direction: column;
      width: 100%;
      justify-content: end;
      font-size: 1.3rem;
      overflow: auto;
    }

    .container3 {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: end;
      overflow: auto;
      position: absolute;
      display: none;
    }

    .container3 .table {
      width: 85%;
      margin-top: 2%;
      transform: translateX(15%);
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="container1">
      <h1>Complaint received from</h1>
      <div class="btns">
        <button id="button1" onclick="funcuser()">User</button>
        <button id="button2" onclick="funcdealer()">Dealer</button>
      </div>
      <button id="btn" onclick="location.href='/railway/logout.php'"><img src="logout.png">LOGOUT</button>
    </div>
    <div class="container2" id="contain2">
      <table class="table" id="table1">
        <thead>
          <tr>
            <th scope="col" class="id">IPAS ID</th>
            <th scope="col" class="id">SGID</th>
            <th scope="col" class="com">Complaint</th>
          </tr>
        </thead>
        <tbody id="tableBody1">
          <?php
          include 'partials/db_connect.php';
          $sql = "Select * from complaint where adminid='$adminid' AND dealerid IS NULL AND adminremark IS NULL;";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result);
          $no = 0;
          if ($num == 0) {
            echo '<tr style="width: 100%;display: flex; margin: 1% 0; height: 10vh ; "><td style="width: 95%; display: flex; justify-content: center; align-items:center; font-size:2.2rem; font-weight: bolder; color:red;">There is no complaints to display</td></tr>';
          } else {
            while ($row = mysqli_fetch_assoc($result)) {
              $no = $no + 1;
              if (strlen($row['comdesc']) > 30) {
                $trimstr = substr($row['comdesc'], 0, 30) . "...";
              } else {
                $trimstr = $row['comdesc'];
              }
              echo '<tr style="width: 100%;display: flex; margin: 1% 0; height: 7vh;
                ">
                    <td style="background-color: #0d42ff; width: 3.2%; display: flex; justify-content: center; align-items:center; border-radius: 400px; border-radius: 15px; margin: 0.5% 4%; color:white;">' . $no . '</td>
                    <td style="width: 23%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;">' . $row['userid'] . '</td>
                    <td style="width: 23%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;"><a href="/railway/admin_sgid1.php" style="text-decoration: none; color:red;" onclick="handleClick1(id)" id="unique1-' . $no . '">' . $row['sgid'] . '</a></td>
                    <td style="width: 48%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;">' . $trimstr . '</td>
                    </tr>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="container3" id="contain3">
      <table class="table" id="table2">
        <thead>
          <tr>
            <th scope="col" class="id">IPAS ID</th>
            <th scope="col" class="id">SGID</th>
            <th scope="col" class="com">Complaint</th>
          </tr>
        </thead>
        <tbody id="tableBody2">
          <?php
          include 'partials/db_connect.php';
          $sql = "Select * from complaint where adminid='$adminid' AND dealerremark IS NOT NULL AND adminremark IS NULL;";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result);
          $no = 0;
          if ($num == 0) {
            echo '<tr style="width: 100%;display: flex; margin: 1% 0; height: 10vh ; "><td style="width: 95%; display: flex; justify-content: center; align-items:center; font-size:2.2rem; font-weight: bolder; color:red;">There is no complaints to display</td></tr>';
          } else {
            while ($row = mysqli_fetch_assoc($result)) {
              $no = $no + 1;
              if (strlen($row['comdesc']) > 30) {
                $trimstr = substr($row['comdesc'], 0, 30) . "...";
              } else {
                $trimstr = $row['comdesc'];
              }
              echo '<tr style="width: 100%;display: flex; margin: 1% 0; height: 7vh;
                ">
                    <td style="background-color: #0d42ff; width: 3.2%; display: flex; justify-content: center; align-items:center; border-radius: 400px; border-radius: 15px; margin: 0.5% 4%; color:white;">' . $no . '</td>
                    <td style="width: 23%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;">' . $row['userid'] . '</td>
                    <td style="width: 23%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;"><a href="/railway/admin_sgid2.php" style="text-decoration: none; color:red;" onclick="handleClick2(id)" id="unique2-' . $no . '">' . $row['sgid'] . '</a></td>
                    <td style="width: 48%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;">' . $trimstr . '</td>
                    </tr>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    // functions
    function funcuser() {
      console.log("hi");
      document.getElementById("contain2").style.display = 'block';
      document.getElementById("contain3").style.display = 'none';
      document.getElementById('button1').style.backgroundColor = "white";
      document.getElementById('button1').style.color = "#0d42ff";
      document.getElementById('button2').style.color = "white";
      document.getElementById('button2').style.backgroundColor = "#0d42ff";
    }
    function funcdealer() {
      document.getElementById('contain2').style.display = 'none';
      document.getElementById('contain3').style.display = 'block';
      document.getElementById('button1').style.backgroundColor = "#0d42ff";
      document.getElementById('button1').style.color = "white";
      document.getElementById('button2').style.color = "#0d42ff";
      document.getElementById('button2').style.backgroundColor = "white";
    }

    function handleClick1(id) {
      console.log("hiiiiii");
      const a = document.getElementById(id).innerHTML;
      console.log(a);
      localStorage.setItem("uniid1", a);
      var myVariable = localStorage.getItem("uniid1");
      document.cookie = "variable=" + myVariable;
    }
    function handleClick2(id) {
      console.log("hiiiiii");
      const a = document.getElementById(id).innerHTML;
      console.log(a);
      localStorage.setItem("uniid2", a);
      var myVariable = localStorage.getItem("uniid2");
      document.cookie = "variable=" + myVariable;
    }
  </script>
</body>

</html>