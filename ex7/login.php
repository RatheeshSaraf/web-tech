<?php

session_start();

include "db.php";

$message = "";


if (isset($_POST["login"])) {

    $email = $_POST["email"];

    $password = $_POST["password"];


    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$password'";


    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) == 1) {


        $user = mysqli_fetch_assoc($result);


        $_SESSION["id"] = $user["id"];

        $_SESSION["name"] = $user["name"];

        $_SESSION["role"] = $user["role"];


        header("Location: dashboard.php");

        exit();


    } else {

        $message = "Invalid email or password.";

    }

}

?>


<!DOCTYPE html>
<html>

<head>

    <title>PU Login</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>


<header>

    <h1>Pondicherry University</h1>

    <p>Contact Portal</p>

    <nav>

        <a href="index.php">Home</a>

        <a href="register.php">Register</a>

        <a href="login.php">Login</a>

    </nav>

</header>


<div class="container">

    <h2>Portal Login</h2>


    <?php

    if ($message != "") {

        echo "<p class='error'>$message</p>";

    }

    ?>


    <form method="POST"
          onsubmit="return validateLogin()">


        <label>Email</label>

        <input
            type="email"
            id="loginEmail"
            name="email"
            placeholder="Enter email"
        >


        <label>Password</label>

        <input
            type="password"
            id="loginPassword"
            name="password"
            placeholder="Enter password"
        >


        <button type="submit" name="login">

            Login

        </button>


    </form>

</div>


<script src="script.js"></script>


</body>

</html>