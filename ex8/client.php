<?php

include "db.php";

$search = trim($_GET["search"] ?? "");
$category = $_GET["category"] ?? "";
$school = $_GET["school"] ?? "";
$department = $_GET["department"] ?? "";


$schools = [

"Subramania Bharathi School of Tamil Language & Literature",
"School of Management",
"Ramanujan School of Mathematical Sciences",
"School of Physical, Chemical and Applied Sciences",
"School of Life Sciences",
"School of Humanities",
"School of Social Sciences & International Studies",
"School of Engineering & Technology",
"School of Education",
"School of Medical Sciences",
"School of Performing Arts",
"School of Law",
"School of Media & Communication",
"Madanjeet School of Green Energy Technologies"

];


function getClientResults($conn, $category, $search, $school, $department)
{

    $category = mysqli_real_escape_string($conn, $category);
    $search = mysqli_real_escape_string($conn, $search);
    $school = mysqli_real_escape_string($conn, $school);
    $department = mysqli_real_escape_string($conn, $department);


    $sql = "SELECT * FROM contacts WHERE category='$category'";


    if ($search != "") {

        $sql .= " AND (
            name LIKE '%$search%'
            OR phone LIKE '%$search%'
            OR email LIKE '%$search%'
            OR department LIKE '%$search%'
            OR school LIKE '%$search%'
            OR designation LIKE '%$search%'
            OR faculty_guide LIKE '%$search%'
            OR course LIKE '%$search%'
        )";

    }


    if ($school != "") {

        $sql .= " AND school='$school'";

    }


    if ($department != "") {

        $sql .= " AND department='$department'";

    }


    return mysqli_query($conn, $sql);

}


function renderClientTable($conn, $category, $search, $school, $department)
{

    $result = getClientResults(
        $conn,
        $category,
        $search,
        $school,
        $department
    );


    echo '<h3>' . $category . ' Contacts</h3>';

    echo '<table>';

    echo '<tr>';

    echo '<th>Name</th>';


    if ($category == "Faculty") {

        echo '<th>Designation</th>';

    }


    if ($category == "Scholar") {

        echo '<th>Faculty Guide</th>';

    }


    if ($category == "Student") {

        echo '<th>Course</th>';

    }


    echo '<th>Phone</th>';

    echo '<th>Email</th>';

    echo '<th>School</th>';

    echo '<th>Department</th>';

    echo '</tr>';


    if (!$result || mysqli_num_rows($result) == 0) {

        echo '

        <tr>

        <td colspan="7" class="no-result">

        No results found

        </td>

        </tr>';

    }

    else {

        while ($row = mysqli_fetch_assoc($result)) {

            echo '<tr>';

            echo '<td>';

            echo htmlspecialchars($row["name"]);

            echo '</td>';


            if ($category == "Faculty") {

                echo '<td>';

                echo htmlspecialchars($row["designation"] ?? "");

                echo '</td>';

            }


            if ($category == "Scholar") {

                echo '<td>';

                echo htmlspecialchars($row["faculty_guide"] ?? "");

                echo '</td>';

            }


            if ($category == "Student") {

                echo '<td>';

                echo htmlspecialchars($row["course"] ?? "");

                echo '</td>';

            }


            echo '<td>';

            echo htmlspecialchars($row["phone"]);

            echo '</td>';


            echo '<td>';

            echo htmlspecialchars($row["email"]);

            echo '</td>';


            echo '<td>';

            echo htmlspecialchars($row["school"]);

            echo '</td>';


            echo '<td>';

            echo htmlspecialchars($row["department"]);

            echo '</td>';


            echo '</tr>';

        }

    }


    echo '</table>';

}

?>


<!DOCTYPE html>

<html>

<head>

<title>PU Contact Directory</title>


<style>

body {

    margin: 0;

    font-family: Arial;

    background: #f2f2f2;

}


header {

    background: orange;

    color: blue;

    padding: 25px;

    text-align: center;

}


.container {

    width: 90%;

    max-width: 1100px;

    margin: 30px auto;

    background: white;

    padding: 25px;

    box-shadow: 0 0 8px #aaa;

    box-sizing: border-box;

}


input, select {

    padding: 10px;

    margin: 5px;

    box-sizing: border-box;

}


button {

    padding: 10px 20px;

    background: #17365d;

    color: white;

    border: none;

}


table {

    width: 100%;

    table-layout: fixed;

    border-collapse: collapse;

    margin-top: 20px;

    margin-bottom: 35px;

}


th, td {

    border: 1px solid #aaa;

    padding: 10px;

    word-wrap: break-word;

    overflow-wrap: break-word;

}


th {

    background: #e8eef5;

}


.no-result {

    text-align: center;

    color: red;

    padding: 20px;

}

</style>

</head>


<body>


<header>

<h1>Pondicherry University</h1>

<p>Contact Directory</p>

</header>


<div class="container">


<h2>Search Contacts</h2>


<form method="GET">


<input

type="text"

name="search"

placeholder="Search name, department or school"

value="<?php echo htmlspecialchars($search); ?>"

>


<select name="category">

<option value="">

All Categories

</option>


<option value="Faculty"

<?php

if ($category == "Faculty")

echo "selected";

?>

>

Faculty

</option>


<option value="Scholar"

<?php

if ($category == "Scholar")

echo "selected";

?>

>

Scholar

</option>


<option value="Student"

<?php

if ($category == "Student")

echo "selected";

?>

>

Student

</option>


</select>


<select name="school">


<option value="">

All Schools

</option>


<?php

foreach ($schools as $s) {

    echo '<option value="' .

    htmlspecialchars($s) .

    '"' .

    ($school == $s ? ' selected' : '') .

    '>' .

    htmlspecialchars($s) .

    '</option>';

}

?>


</select>


<input

type="text"

name="department"

placeholder="Department"

value="<?php echo htmlspecialchars($department); ?>"

>


<button type="submit">

Search

</button>


</form>


<?php

/*
------------------------------------------------
DISPLAY TABLES ONLY AFTER SEARCH/FILTER
------------------------------------------------
*/

if (

    $search != "" ||

    $category != "" ||

    $school != "" ||

    $department != ""

) {


    if ($category == "") {


        renderClientTable(

            $conn,

            "Faculty",

            $search,

            $school,

            $department

        );


        renderClientTable(

            $conn,

            "Scholar",

            $search,

            $school,

            $department

        );


        renderClientTable(

            $conn,

            "Student",

            $search,

            $school,

            $department

        );


    }

    else {


        renderClientTable(

            $conn,

            $category,

            $search,

            $school,

            $department

        );

    }

}

?>


</div>


</body>

</html>