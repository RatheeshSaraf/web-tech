<?php
?>

<html>

<style>

.container1 {

    width: 100%;

    max-width: 800px;

    margin: 40px auto;

    background-color: white;

    padding: 30px;

    box-shadow: 0 0 8px #aaa;

}

</style>

</html>

<?php
?>
<?php

session_start();

include "db.php";


/* Check whether user is logged in */

if (!isset($_SESSION["id"])) {

    header("Location: login.php");

    exit();

}


$name = $_SESSION["name"];

$role = $_SESSION["role"];

?>


<!DOCTYPE html>
<html>

<head>

    <title>Contact Dashboard</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>


<header>

    <h1>Pondicherry University</h1>

    <p> Contact Portal</p>

    <nav>

        <a href="index.php">Home</a>

        <a href="dashboard.php">Dashboard</a>

        <a href="logout.php">Logout</a>

    </nav>

</header>


<div class="container1">


    <h2>
        Welcome, <?php echo $name; ?>
    </h2>




<?php


/* STUDENT LOGIN */

if ($role == "student") {


    echo "<h2>Faculty Details</h2>";


    $sql = "SELECT * FROM users
            WHERE role!='student'";


    $result = mysqli_query($conn, $sql);


?>


<table>

    <tr>


        <th>Name</th>

        <th>Email</th>
		        <th>Incharge</th>

        <th>Designation</th>

    </tr>


<?php


while ($row = mysqli_fetch_assoc($result)) {


?>


    <tr>

        <td>
            <?php echo $row["name"]; ?>
        </td>

        <td>
            <?php echo $row["email"]; ?>
        </td>
		<td>
            <?php echo $row["course"]; ?>
        </td>    
        <td>
            <?php echo $row["role"]; ?>
        </td>

    </tr>


<?php

}

?>


</table>


<?php


}


/* ADMIN LOGIN */

elseif ($role != "student") {


    echo "<h2>Student Details</h2>";


    $sql = "SELECT * FROM users
            WHERE role='student'";


    $result = mysqli_query($conn, $sql);


?>


<table>

    <tr>

        

        <th>Name</th>
                <th>Reg.No.</th>

        <th>Course</th>

        <th>Email</th>
		        <th>Mobile</th>
                <th>Address</th>



    </tr>


<?php


while ($row = mysqli_fetch_assoc($result)) {


?>


    <tr>

        <td>
            <?php echo $row["name"]; ?>
        </td>
		<td>
            <?php echo $row["reg"]; ?>
        </td>
        <td>
            <?php echo $row["course"]; ?>
        </td>
        <td>
            <?php echo $row["email"]; ?>
        </td>
        <td>
            <?php echo $row["mobile"]; ?>
        </td>
        <td>
            <?php echo $row["addr"]; ?>
        </td>

        
    </tr>


<?php

}

?>


</table>


<?php

}

?>


</div>


</body>

</html>