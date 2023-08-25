<?php
session_start();
$dealerid = $_SESSION['dealerid'];
if (!isset($_SESSION['loggedin2']) || $_SESSION['loggedin2'] == !true) {
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
  <title>IPAS - Dealer</title>
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
      flex-direction: column;
      align-items: center;
      justify-content: start;
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
      z-index: 1;
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
      overflow: auto;
      position: absolute;
      /* align-items: center; */
      justify-content: center;
      transform: translateY(10%);
    }

    .container2 .table {
      width: 85%;
      margin-top: 2%;
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

    #btn {
      position: absolute;
      transform: translateX(460%);
      display: flex;
      align-items: center;
      justify-content: end;
      cursor: pointer;
      width: 9.5%;
      height: 7vh;
      padding: 1% 2%;
      border: 2px solid white;
      border-radius: 20px;
      background-color: transparent;
      font-size: 0.9rem;
      color: white;
    }

    #btn img {
      width: 22%;
      padding-top: 2.5%;
      padding-left: 5%;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="container1">
      <h1>COMPLAINS FORWARDED BY ADMIN</h1>
      <button id="btn" onclick="location.href='/railway/logout.php'"><img src="logout.png">LOGOUT</button>
    </div>
    <div class="container2">
      <table class="table" id="table">
        <thead>
          <tr>
            <th scope="col" class="id">IPAS ID</th>
            <th scope="col" class="id">SGID</th>
            <th scope="col" class="com">Complaint</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <?php
          include 'partials/db_connect.php';
          $sql = "Select * from complaint where dealerid='$dealerid' AND dealerremark IS NULL;";
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
              echo ' <tr style="width: 100%;display: flex; margin: 1% 0; height: 7vh;">
                <td style="background-color: #0d42ff; width: 3.2%; display: flex; justify-content: center; align-items:center; border-radius: 400px; border-radius: 15px; margin: 0.5% 4%; color:white;">' . $no . '</td>
                <td style="width: 23%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;">' . $row['userid'] . '</td>
                <td style="width: 23%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;"><a href="/railway/dealer_sgid.php" style="text-decoration: none; color:red;"onclick="handleClick(id)" id="unique1-' . $no . '">' . $row['sgid'] . '</a></td>
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
    // // for user
    // let html="";
    // myobj=[{"x":"hituhjkkj","y":"helloyyul","z":"hmmdgtkl"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"},{"x":"hofjljhv","y":"hilloyf","z":"mmfyuufuum"}]
    // // myobj = []
    // myobj.forEach(function(element,index) {
    //     html+=`<tr style="width: 100%;display: flex; margin: 1% 0; height: 7vh;
    //     ">
    //         <td style="background-color: #0d42ff; width: 3.2%; display: flex; justify-content: center; align-items:center; border-radius: 400px; border-radius: 15px; margin: 0.5% 4%; color:white;">${index+1}</td>
    //         <td style="width: 23%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;">${element.x}</td>
    //         <td style="width: 23%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;"><a href="/railway/dealer_sgid.php" style="text-decoration: none; color:red;">${element.y}</a></td>
    //         <td style="width: 48%; display: flex; justify-content: center; align-items:center; border-radius: 15px; margin: 0.5% 1%; border: 1px solid #0d42ff;">${element.z}</td>
    //         </tr>`
    // });
    // let tableBody = document.getElementById('tableBody');
    // if(myobj.length!=0){
    //     tableBody.innerHTML=html;
    // }
    // else{
    //     tableBody.innerHTML=`<b style="color: cadetblue;">There is no complaints</b>`
    // }
    function handleClick(id) {
      // console.log("hiiiiii");
      const a = document.getElementById(id).innerHTML;
      console.log(a);
      localStorage.setItem("unid1", a);
      var myVariable = localStorage.getItem("unid1");
      document.cookie = "variable=" + myVariable;
    }
  </script>
</body>

</html>