<?php

include("mvc/dbController.php");

if (isset($_POST['submit'])) {
    $db = new dbController();

    if ($db->Login($_POST['username'], $_POST['password'])) {
        header('location: dashboard.php?login=success');
    } else {
        echo '
        <script>alert("Please enter correct username or password")</script>
        ';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atarn Store | Home</title>
</head>

<body>
    <main>
        <ul>
            <a id="home" class="active" href="#">Home</a>
            <a id="customer" onclick="openForm()">Customer</a>
            <a id="signup" href="signup.php">Sign Up</a>
            <a id="creator" href="about-us.html">About</a>
        </ul>
        <div class="center-title">
            <div class="text">
                <h1>WELCOME TO <span style="color: #c0392b">ATARN</span></h1>
                <p>
                    <span style="color: white;">THE</span> GAMING CENTRE
                </p>
            </div>
        </div>
    </main>

    <form id="form" action="#" method="POST" class="form-container">
        <div class="form-header">
            <h1>Login</h1>
            <i class="fas fa-times" onclick="closeForm()"></i>
        </div>

        <div class="form-body">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" autocomplete="none" required maxlength=16>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required maxlength=16>

            <div class="btn-form">
                <input type="submit" id="submit" name="submit" style="background-color: #205a81;"></input>
                <input type="reset" id="reset" style="background-color: #9c3226; " onclick="clearAll()"></input>
            </div>
        </div>
    </form>

    <script>
        function openForm() {
            get("form").style.display = "flex";
        }

        function closeForm() {
            get("form").style.display = "none";
        }

        function clearAll() {
            get("#username").value = ""
            get("#password").value = ""
        }

        function get(tag) {
            return document.querySelector(tag)
        }
    </script>
</body>

</html>