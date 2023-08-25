<?php
$logIn = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/db_connect.php';
  $id1 = $_POST["id1"];
  if ($id1 == "admin") {
    $adminid = $_POST["adminid"];
    $adminpw = $_POST["adminpw"];
    $sql = "Select * from admins where adminid='$adminid' AND password='$adminpw'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
      $logIn = true;
      session_start();
      $_SESSION['loggedin1'] = true;
      $_SESSION['adminid'] = $adminid;
      header("location: admin.php");
    } else {
      $showError = "Invalid Credentials";
    }
  }
  if ($id1 == "dealer") {
    $dealerid = $_POST["dealerid"];
    $dealerpw = $_POST["dealerpw"];
    $sql = "Select * from dealers where dealerid='$dealerid' AND password='$dealerpw'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
      $logIn = true;
      session_start();
      $_SESSION['loggedin2'] = true;
      $_SESSION['dealerid'] = $dealerid;
      header("location: dealer.php");
    } else {
      $showError = "Invalid Credentials";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="favicon.png" type="image/png">
  <title>IPAS - Complaint Management System</title>
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: none;
      /* font-family: 'Montserrat', Arial, sans-serif; */
    }

    .container {
      width: 100%;
      height: 100vh;
      display: flex;
      background-image: linear-gradient(75deg, #0d42ff 50%, transparent 50%);
      /* filter: drop-shadow(10px 10px gray); */
      overflow: hidden;
    }

    .container1 {
      width: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      padding: 6% 0;
      color: white;
    }

    .item11 {
      width: 85%;
      height: 30%;
      font-size: 2rem;
      display: flex;
    }

    .item12 {
      width: 70%;
      height: 30%;
      display: flex;
      flex-direction: column;
      align-items: start;
      justify-content: space-around;
      font-size: 1.5rem;
    }

    .box {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: space-evenly;
    }

    .box a {
      width: 20%;
      background-color: white;
      text-decoration: none;
      padding: 2%;
      text-align: center;
      border-radius: 10px;
      color: #0d42ff;
      transition: transform 0.5s;
      font-weight: bold;
      overflow: hidden;
      font-size: 1.2rem;
    }

    .box a:hover {
      transform: scale(1.1);
      border: 1px solid white;
      background-color: transparent;
      color: white;
    }

    .container2 {
      width: 50%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 4%;
    }

    .container3 {
      width: 70%;
      height: 55%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      padding: 10% 0;
    }

    .item21 {
      width: 70%;
      height: 10%;
      display: flex;
      align-items: center;
      justify-content: space-around;
      padding: 0 5%;
    }

    .item21 a {
      width: 35%;
      background-color: #0d42ff;
      text-decoration: none;
      padding: 2% 4%;
      text-align: center;
      border-radius: 40px;
      transition: transform 0.5s;
      font-weight: bold;
      overflow: hidden;
      font-size: 1.8rem;
      border: 1px solid #0d42ff;
      color: white;
    }

    .item21 a:hover {
      font-size: 1.9rem;
      border: 2px solid #0d42ff;
    }

    #dealer {
      background-color: white;
      color: #0d42ff;
    }

    .item22 {
      width: 70%;
      height: 70%;
      display: flex;
      align-items: start;
      justify-content: center;
    }

    form {
      position: absolute;
      display: flex;
      flex-direction: column;
      width: 25%;
      height: 20%;
      justify-content: space-around;
      font-size: 1.3rem;
    }

    form h4 {
      height: 20%;
    }

    form input {
      height: 28%;
      width: 100%;
      border-radius: 10px;
      border: 1px solid blue;
      background-color: rgba(211, 215, 230, 0.667);
      font-size: 1.2rem;
      padding: 0 3%;
    }

    form .btn2 {
      position: absolute;
      width: 30%;
      height: 26%;
      left: 38%;
      bottom: -50%;
      font-size: 1.1rem;
      background-color: #0d42ff;
      padding: 2% 4%;
      text-align: center;
      border-radius: 60px;
      transition: transform 0.5s;
      font-weight: bold;
      border: transparent;
      color: white;
      cursor: pointer;
    }

    form .btn2:hover {
      transform: scale(1.1);
    }

    #dealer1 {
      display: none;
    }

    .img1 {
      position: absolute;
      width: 25px;
      /* height: 80px; */
      bottom: 5%;
      left: 95%;
      cursor: pointer;
    }

    .img2 {
      position: absolute;
      width: 25px;
      /* height: 80px; */
      bottom: 5%;
      left: 95%;
      display: none;
      cursor: pointer;
    }

    #containers {
      animation: animate 0.5s;
      transition: transform 0.5s;
    }

    @keyframes animate {
      from {
        transform: translateY(-100%);
      }

      to {
        transform: translateY(0);
      }
    }

    #btn {
      position: absolute;
      transform: translate(950%, 1320%);
      display: flex;
      align-items: center;
      justify-content: left;
      cursor: pointer;
      width: 9.5%;
      height: 7vh;
      padding: 1% 0.5%;
      border: 2px solid #0d42ff;
      border-radius: 20px;
      background-color: transparent;
      font-size: 0.9rem;
      color: #0d42ff;
    }

    #btn img {
      width: 20%;
      margin-right: 15%;
    }
  </style>
</head>

<body>
  <?php
  if ($showError != false) {
    echo '<div id="containers" style="width:99.9%;
    height: 8vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #F8D7DA;
    border: 1px solid red;
    position: absolute;
    font-size: 1.05rem;">
        <strong style="color: red;">ERROR ! </strong> Invalid Credentials, try to login with correct credentials
    </div>';
  }
  ?>
  <section class="container">
    <div class="container1">
      <div class="item11">
        <h1>IPAS COMPLAINT MANAGEMENT SYSTEM</h1>
      </div>
      <div class="item12">
        <div class="box">
          <span>Register your complaint</span>
          <a href="/railway/complaint.php">Register</a>
        </div>
        <div class="box">
          <span>Track your complaint</span>
          <a href="/railway/status.php">Status</a>
        </div>
      </div>
    </div>
    <div class="container2">
      <div class="container3">
        <div class="item21">
          <a onclick="funcadmin()" id="admin">Admin</a>
          <a onclick="funcdealer()" id="dealer">Dealer</a>
        </div>
        <div class="item22">
          <form action="/railway/home.php" id="admin1" method="post">
            <input type="hidden" name="id1" value="admin">
            <h4>Admin Id</h4>
            <input type="text" name="adminid" id="adminid" req uired />
            <h4>password</h4>
            <input type="password" id="adpw" name="adminpw" required />
            <img src="closeeye.png" class="img1" id="img1" onclick="funcimg1()">
            <img src="openeye.png" class="img2" id="img2" onclick="funcimg2()">
            <button class="btn2" type="submit" id="btn11">login</button>
          </form>
          <form action="/railway/home.php" id="dealer1" method="post">
            <input type="hidden" name="id1" value="dealer">
            <h4>Dealer Id</h4>
            <input type="text" name="dealerid" id="dealerid" required />
            <h4>password</h4>
            <input type="password" id="depw" name="dealerpw" required />
            <img src="closeeye.png" class="img1" id="img3" onclick="funcimg1()">
            <img src="openeye.png" class="img2" id="img4" onclick="funcimg2()">
            <button class="btn2" type="submit" id="btn12">login</button>
          </form>
        </div>
      </div>
    </div>
    <button id="btn" onclick="location.href='/railway/analytics.php'"><img src="analytics.png">ANALYTICS</button>
  </section>
  <script>
    const a = document.getElementById("admin")
    const b = document.getElementById("dealer")
    const c = document.getElementById("admin1")
    const d = document.getElementById("dealer1")
    const e = document.getElementById("img1")
    const f = document.getElementById("img2")
    const i = document.getElementById("img3")
    const j = document.getElementById("img4")
    const g = document.getElementById("adpw")
    const h = document.getElementById("depw")
    function funcadmin() {
      c.style.display = "block";
      d.style.display = "none";
      a.style.backgroundColor = "#0d42ff";
      a.style.color = "white";
      b.style.color = "#0d42ff";
      b.style.backgroundColor = "white";
    }
    function funcdealer() {
      c.style.display = "none";
      d.style.display = "block";
      a.style.backgroundColor = "white";
      a.style.color = "#0d42ff";
      b.style.color = "white";
      b.style.backgroundColor = "#0d42ff";
    }
    function funcimg1() {
      e.style.display = "none";
      f.style.display = "block";
      i.style.display = "none";
      j.style.display = "block";
      g.type = "text";
      h.type = "text";
    }
    function funcimg2() {
      e.style.display = "block";
      f.style.display = "none";
      i.style.display = "block";
      j.style.display = "none";
      g.type = "password";
      h.type = "password";
    }


    setTimeout(() => {
      document.getElementById("containers").style.transform = "translateY(-100%)";
    }, 2500);
    const form1 = document.getElementById('admin1');
    const form2 = document.getElementById('dealer1');
    const btn1 = document.getElementById('btn11');
    const btn2 = document.getElementById('btn12');
    btn11.addEventListener('click', function handleSubmit(event) {
      // event.preventDefault();
      setTimeout(() => {
        form1.reset();
      }, 2000);
    });
    btn12.addEventListener('click', function handleSubmit(event) {
      // event.preventDefault();
      setTimeout(() => {
        form2.reset();
      }, 2000);
    });
  </script>
</body>

</html>