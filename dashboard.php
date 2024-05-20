<?php
     include "session.php";
     print_r($_SESSION);
    /*
    *header($header)
    *@param string $header - url path to page
    *@return void //nothing will be returned
    */
    if(!isset($_SESSION['id'])){
        header("Location:http://localhost/login.php");
    }
    //unset($_SESSION['id'])
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        *{
            background-color:lightsteelblue;
            text-align:center;
            margin:20 auto;
        }
        .container{
            margin:10px;
        }
        #logout{
            font-size:20px;
            background-color:azure;
            border-radius:5px;
        }
    </style>
</head>

<body>    
    <?php
        $Message= $_GET['Message'];
        echo '<br>';
        echo '<span style="padding:2px;font-size: 20px;">'.$Message.'</span>';
    ?>
    <div class="container">
        <h1>Welcome</h1>
        <form action="/login.php" method="POST">
           <input type="submit" value="Logout" id="logout" onclick=<?php unset($_SESSION['id'])?>>
        </form>
    </div>
     
</body>
</html>