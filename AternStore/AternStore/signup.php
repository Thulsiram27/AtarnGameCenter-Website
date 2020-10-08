<?php

include("mvc/dbController.php");

if (isset($_POST['submit'])) {
    $db = new dbController();

    if ($db->Register($_POST['username'], $_POST['fullname'], $_POST['birthdate'], $_POST['nric'], $_POST['password'], $_POST['confirm'])) {
        header('location: index.php?register=sucess');
    } else {
        header('location: signup.php?register=failure');
    }

    /* $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $birthdate = $_POST["birthdate"];
    $nric = $_POST["nric"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirm"];
    if ($password == $confirmpassword) {
        $insert = mysqli_query($conn, "INSERT INTO `kakitangan`(`username`, `fullname`, `birthdate`, `nric`, `password`) 
 VALUES ('$username','$fullname','$birthdate','$nric','$password')");
        if (!$insert) {
            echo '<script type="text/JavaScript">  
    alert("Register Failed"); 
    window.open("signup.php");
    </script>';
        } else {
            echo '<script type="text/JavaScript">  
    confirm("Register Success"); 
    window.open("navigation.php");
    </script>';
        }
    } */
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/signup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/9b997b2ecb.js" crossorigin="anonymous"></script>
    <title>Gaming Store | Sign Up</title>
</head>

<body>
    <ul>
        <a class="back-btn" href="index.php">
            <i class="fas fa-chevron-left"></i>
            <p>Back</p>
        </a>
    </ul>
    <main class="login-form">
        <h1>Registration</h1>
        <form method="POST" action="signup.php">
            <label for="username">Enter Username</label>
            <input type="text" name="username" placeholder="Enter Username" autocomplete="off" required maxlength="16">
            <label>Full Name</label>
            <input type="text" name="fullname" placeholder="Enter Full Name" autocomplete="off" required maxlength="32">
            <label>Birth Date</label>
            <input type="Date" name="birthdate" placeholder="Enter Birth Date" required>
            <label for="nric">NRIC</label>
            <input type="tel" name="nric" id="nric" placeholder="NRIC" autocomplete="off" maxlength="11">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter Password" required maxlength="16">
            <label> Confirm Password</label>
            <input type="password" name="confirm" placeholder="Confirm Password" required maxlength="16">
            <input type="submit" name="submit" value="Register">
        </form>
    </main>
</body>
</head>

</html>