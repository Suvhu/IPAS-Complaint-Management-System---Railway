<?php
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/db_connect.php';
  $division = $_POST["division"];
  $section = $_POST["section"];
  $userid = $_POST["userid"];
  $name = $_POST["name"];
  $number = $_POST["number"];
  $comdesc = $_POST["comdesc"];
  if ($number < 0) {
    $showError = "Enter a valid mobile number";
  } else if (strlen($number) != 10) {
    $showError = "Mobile number should be of 10 digits";
  } else {
    $adminid = "admin1";
    if ($division > 3105) {
      $adminid = "admin2";
    }
    $year = 2020;
    $month = 6;
    $day = 18;
    $hour = 12;
    $minute = 30;
    $second = 45;
    $given_date = new DateTime("$year-$month-$day $hour:$minute:$second");
    $sgid1 = $given_date->getTimestamp();
    $current_date = new DateTime();
    $sgid2 = $current_date->getTimestamp();
    $sgid = $sgid2 - $sgid1;
    $sql = "INSERT INTO `complaint` (`division`, `section`, `userid`, `name`, `mobile`, `comdesc`, `sgid`,`adminid`) VALUES ('$division', '$section', '$userid', '$name', '$number', '$comdesc', '$sgid', '$adminid');";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      session_start();
      $_SESSION['loggedin3'] = true;
      $_SESSION['sgid'] = $sgid;
      header("location: unique_id.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.png" type="image/png">
  <title>IPAS - Register Complaint </title>
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: none;
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

    .container1 img {
      position: absolute;
      width: 2.5%;
      left: 2%;
      top: 2.6%;
    }

    .container2 {
      width: 60%;
      height: 90%;
      display: flex;
      align-items: center;
      /* justify-content: center; */
      /* background-color: pink; */
    }

    .container2 form {
      width: 60%;
      height: 90%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-around;
      /* background-color: blue; */
      transform: translateX(18%);
    }

    .container2 form div {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: space-around;
    }

    .container2 form div h2 {
      width: 30%;
      text-align: end;
    }

    .container2 form div select {
      width: 60%;
      height: 70%;
      font-size: 1.1rem;
      border: 1px solid #0d42ff;
      border-radius: 10px;
    }

    .container2 form div input {
      width: 55.5%;
      height: 68%;
      font-size: 1.1rem;
      padding: 0 2%;
      border: 1px solid #0d42ff;
      border-radius: 10px;
    }

    .container2 form div textarea {
      width: 55.5%;
      height: 68%;
      font-size: 1.1rem;
      padding: 1% 2%;
      border: 1px solid #0d42ff;
      border-radius: 10px;
    }

    .container2 form div select {
      text-align: center;
    }

    .container2 form div select:hover {
      background-color: rgb(222, 226, 238);
    }

    .container2 form div input:hover {
      background-color: rgb(222, 226, 238);
    }

    .container2 form div textarea:hover {
      background-color: rgb(222, 226, 238);
    }

    .container2 form div #unique {
      border: transparent;
      background-color: transparent;
      color: rgb(229, 25, 25);
      font-size: 1.3rem;
      text-align: center;
      font-weight: bolder;
    }

    .container2 form div #unique:hover {
      background-color: transparent;
    }

    .btns {
      width: 18%;
      height: 60%;
      font-size: 1.0rem;
      font-weight: bold;
      border-radius: 12px;
      border: transparent;
      cursor: pointer;
    }

    #btn1 {
      transform: translateX(160%);
      background-color: #0d42ff;
      color: white;
    }

    #btn2 {
      transform: translateX(40%);
      background-color: red;
      color: white;
    }

    #btn1:hover {
      background-color: white;
      border: 2px solid #0d42ff;
      color: #0d42ff;
    }

    #btn2:hover {
      background-color: white;
      border: 2px solid red;
      color: red;
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
        <strong style="color: red;">ERROR ! </strong> '.$showError.'
    </div>';
  }
  ?>
  <div class="container">
    <div class="container1">
      <a href="/railway/home.php"><img src="home.png"></a>
      <h1>REGISTER COMPLAINT</h1>
    </div>
    <div class="container2">
      <form action="/railway/complaint.php" id="form" method="post">
        <div class="divi">
          <h2>Division/HQ</h2>
          <select name="division" id="division" required>
            <option value="">--select--</option>
          </select>
        </div>
        <div class="sec">
          <h2>Section</h2>
          <select name="section" id="section" required>
            <option value="">--select--</option>
          </select>
        </div>
        <div class="usid">
          <h2>User ID</h2>
          <select name="userid" id="userid" required>
            <option value="">--select--</option>
          </select>
        </div>
        <div class="name">
          <h2>Name</h2>
          <input type="text" name="name" id="name" required>
        </div>
        <div class="mobile">
          <h2>Mobile</h2>
          <input type="number" name="number" id="number" required>
        </div>
        <div class="comdes">
          <h2>Complaint Description</h2>
          <textarea name="comdesc" id="comdesc" cols="30" rows="8" required></textarea>
        </div>
        <div class="btn">
          <button type="submit" class="btns" id="btn1">SUBMIT</button>
          <button type="reset" class="btns" id="btn2" onclick="handleclear()">CLEAR</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    const form = document.getElementById('form');
    const btn = document.getElementById('btn1');
    btn.addEventListener('click', function handleSubmit(event) {
      // event.preventDefault();
      setTimeout(() => {
        form.reset();
      }, 2000);
    });
    setTimeout(() => {
      document.getElementById("containers").style.transform = "translateY(-100%)";
    }, 2500);
  </script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      function loadData(type, category_id, category_id1) {
        $.ajax({
          url: "fetch.php",
          type: "POST",
          data: { type: type, id: category_id, id1: category_id1 },
          success: function (data) {
            if (type == "userData") {
              $("#userid").append(data);
            }
            else if (type == "sectionData") {
              $("#section").append(data);
            } else {
              $("#division").append(data);
            }

          }
        });
      }

      loadData();

      $("#division").on("change", function () {
        var division = $("#division").val();

        if (division != "") {
          loadData("sectionData", division);
        } else {
          $("#section").html("");
        }
      })
      $("#section").on("change", function () {
        var division = $("#division").val();
        var section = $("#section").val();
        if ((division != "") || (section != "")) {
          loadData("userData", division, section);
        } else {
          $("#userid").html("");
        }
      })
    });
  </script>
</body>

</html>