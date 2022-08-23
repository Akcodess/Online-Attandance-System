<?php

session_start();

if(!isset($_SESSION['username']))
{
    header('location:TeacherLogin.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
    </div>
    <div>
        <a href="../logout.php">Logout</a>
    </div>
</body>
</html>