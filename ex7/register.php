<?php

include "db.php";

$message = "";

if (isset($_POST["register"])) {

    $name = $_POST["name"];
    $reg = $_POST["reg"];
    $course = $_POST["course"];
    $email = $_POST["email"];
        $mobile = $_POST["mobile"];
    $addr = $_POST["addr"];

    $password = $_POST["password"];
    $role = $_POST["role"];

    $sql = "INSERT INTO users
            (name, reg, course, email,mobile,addr, password, role)
            VALUES
            ('$name', '$reg', '$course', '$email','$mobile','$addr', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {

        $message = "Registration successful!";

    } else {

        $message = "Registration failed: " . mysqli_error($conn);

    }
}

?>


<!DOCTYPE html>
<html>

<head>

    <title>PU Registration</title>

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

    <h2>Student Registration</h2>


    <?php

    if ($message != "") {

        echo "<p class='message'>$message</p>";

    }

    ?>


    <form method="POST"
          onsubmit="return validateRegister()">


        <label>Full Name</label>

        <input
            type="text"
            id="name"
            name="name"
            placeholder="Enter your name"
        >

			<label>Reg.No.</label>

        <input
            type="text"
            id="reg"
            name="reg"
            placeholder="Enter your Registration Number"
        >
        <label>Course & Year</label>

        <input
            type="text"
            id="course"
            name="course"
            placeholder="Enter your Course and Year"
        >

        <label>Email</label>

        <input
            type="email"
            id="email"
            name="email"
            placeholder="Enter your email"
        >
        <label>Mobile</label>

        <input
            type="text"
            id="mobile"
            name="mobile"
            placeholder="Enter your Mobile"
        >
		<label>Address</label>

        <input
            type="text"
            id="addr"
            name="addr"
            placeholder="Enter your Address"
        >

        <label>Password</label>

        <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter password"
        >


        <input type="hidden" name="role" value="student">


        <button type="submit" name="register">

            Register

        </button>


    </form>

</div>


<script src="script.js"></script>


</body>

</html>