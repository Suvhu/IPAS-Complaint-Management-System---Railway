<?php
include 'partials/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <title>IPAS - Analytics</title>
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
            z-index: 1;
        }

        .container2 {
            width: 100%;
            height: 90%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            font-weight: bolder;
        }

        .contain1 {
            /* background-color: red; */
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: end;
        }

        #ulist {
            width: 75%;
            height: 75vh;
            /* background-color: pink; */
            list-style: none;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        #ulist li {
            /* background-color: yellow; */
            display: flex;
            align-items: center;
        }

        #ulist li::before {
            content: "•";
            color: #0d42ff;
            font-weight: bold;
            font-size: 3rem;
            /* background-color: yellow; */
            margin-left: 5%;
            margin-right: 2%;
        }

        #ilist {
            width: 25%;
            height: 75vh;
            list-style: none;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        #ilist li {
            height: 7.3vh;
            width: 22%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #0d42ff;
            background-color: #0d42ff;
            color: white;
        }

        .contain2 {
            width: 100%;
            height: 15vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn {
            width: 7%;
            height: 40%;
            background-color: #0d42ff;
            text-decoration: none;
            border-radius: 40px;
            transition: transform 0.5s;
            font-weight: bold;
            overflow: hidden;
            font-size: 1.8rem;
            border: 1px solid #0d42ff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            cursor: pointer;
        }

        .btn:hover {
            background-color: transparent;
            color: #0d42ff;
            border: 2px solid #0d42ff;
            transform: scale(1.1);
        }
    </style>
</head>

<body onload="funcgen()">
    <div class="container">
        <div class="container1">
            <h1>Website Analytics</h1>
        </div>
        <div class="container2">
            <div class="contain1">
                <ul id="ulist">
                    <li>Number of Users visited the site</li>
                    <li>Number of Complaints that are registered</li>
                    <li>Number of Complaints that are pending</li>
                    <li>Number of Complaints that are underprocess</li>
                    <li>Number of Complaints that are resolved</li>
                </ul>
                <ul id="ilist">
                    <li><?php 
                    $sql = "Select * from visitor";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo $row['visitcount'] ;?></li>
                    <li><?php 
                    $sql = "Select * from complaint ";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    echo $num ;?></li>
                    <li><?php 
                    $sql = "Select * from complaint where status = 'pending'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    echo $num ;?></li>
                    <li><?php 
                    $sql = "Select * from complaint where status = 'underprocess'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    echo $num ;?></li>
                    <li><?php 
                    $sql = "Select * from complaint where status = 'resolved'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    echo $num ;?></li>
                </ul>
            </div>
            <div class="contain2">
                <button class="btn" onclick="location.href='/railway/logout.php'">OK</button>
            </div>
        </div>
    </div>
</body>

</html>