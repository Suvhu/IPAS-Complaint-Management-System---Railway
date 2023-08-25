<?php
session_start();
$sgid = $_SESSION['sgid'];
if(!isset($_SESSION['loggedin3']) || $_SESSION['loggedin3'] == !true){
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
    <title>IPAS - Complaint Unique Id</title>
    <style>
        * {
        padding: 0;
        margin: 0;
        box-sizing: none;
        overflow: hidden;
      }
      .container{
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #0d42ff;
      }
      .container1{
        width: 100%;
        height: 40vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        color: white;
      }
      .container1 b{
        color: yellow;
      }
      .btn{
        width: 8%;
        height: 15%;
        background-color: white;
        text-decoration: none;
        border-radius: 40px;
        transition: transform 0.5s;
        font-weight: bold;
        overflow: hidden;
        font-size: 1.8rem;
        border: 1px solid white;
        color: #0d42ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
      }
      .btn:hover{
        background-color: transparent;
        color: white;
        border: 2px solid white;
        transform: scale(1.1);
      }
    </style>
</head>
<body>
    <div class="container">
        <div class="container1">
            <h1> Complaint has been successfully registered </h1>
            <h1> Unique id is <?php echo "<b id='unique'>$sgid</b>";?></h1>
            <a href="/railway/logout.php" class="btn">OK</a>
        </div>
    </div>
</body>
</html>