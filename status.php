<?php
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/db_connect.php';
    $sgid = $_POST["sgid"];
    $sql = "Select * from complaint where sgid='$sgid';";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
      session_start();
      $_SESSION['loggedin4'] = true;
      $_SESSION['sgid3'] = $sgid;
      header("location: status_show.php");
    } else {
      $showError = "Invalid Credentials";
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
  <title>IPAS - Check Status</title>
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
      }
      .container1 h1{
        word-spacing: 10px;
        /* letter-spacing: 10px; */
      }
      .container1 img{
        position: absolute;
        width: 2.5%;
        left: 2%;
        top: 2.6%;
      }
      .container2{
        width: 100%;
        height: 90%;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .container2 form{
        width: 90%;
        height: 40%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        /* background-color: red; */
      }
      .sgid{
        width: 25%;
        height: 11vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: start;
        /* background-color: aliceblue; */
        color: #0d42ff;
      }
      .sgid input{
        width: 100%;
        height: 5vh;
        border-radius: 12px;
        border: 2px solid #0d42ff;
        padding: 0 2%;
        font-weight: bold;
        font-size: 1.2rem;
      }
      .btn{
        width: 9%;
        height: 6vh;
        font-size: 1.1rem;
        border-radius: 12px;
        border: 2px solid #0d42ff;
        background-color: #0d42ff;
        font-weight: bolder;
        color: white;
        transition: transform 0.5s;
      }
      .btn:hover{
        background-color: transparent;
        color: #0d42ff;
        transform: scale(1.1);
      }
      #containers{
      animation: animate 0.5s ;
      transition: transform 0.5s;
    }
    @keyframes animate{
      from{
        transform: translateY(-100%);
      }
      to{
        transform: translateY(0);
      }
    }
    </style>
</head>
<body>
<?php
  if($showError!= false){
    echo '<div id="containers" style="width:99.9%;
    height: 8vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #F8D7DA;
    border: 1px solid red;
    position: absolute;
    font-size: 1.05rem;">
        <strong style="color: red;">ERROR ! </strong> wrong sgid, enter the correct sgid to proceed
    </div>';
  }
  ?>
    <div class="container">
        <div class="container1">
            <a href="/railway/home.php"><img src="home.png"></a>
            <h1>COMPLAINT STATUS</h1>
        </div>
        <div class="container2">
            <form action="/railway/status.php" method="post" id="form">
                <div class="sgid">
                    <h2>SG-ID:</h2>
                    <input type="text" name="sgid" required>
                </div>
                    <button type="submit" class="btn" id="btn1">SUBMIT</button>
            </form>
        </div>
    </div>
    <script>
      setTimeout(() => {
      document.getElementById("containers").style.transform = "translateY(-100%)";
    }, 2500);

    const form = document.getElementById('form');
    const btn = document.getElementById('btn1');
    btn.addEventListener('click', function handleSubmit(event) {
      // event.preventDefault();
      setTimeout(() => {
        form.reset();
      }, 1500);
    });
    </script>
</body>
</html>