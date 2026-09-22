	<?php

include "db.php";

$message = "";

$schools = [

"Subramania Bharathi School of Tamil Language & Literature" => [
    "Subramania Bharathi School of Tamil Language & Literature"
],

"School of Management" => [
    "Department of Banking Technology",
    "Department of Commerce",
    "Department of Commerce – Karaikal Campus",
    "Department of Economics",
    "Department of International Business",
    "Department of Management Studies",
    "Department of Management Studies – Karaikal Campus",
    "Department of Management Studies Port Blair Campus",
    "Department of Tourism Studies"
],

"Ramanujan School of Mathematical Sciences" => [
    "Department of Mathematics",
    "Department of Statistics"
],

"School of Physical, Chemical and Applied Sciences" => [
    "Department of Applied Psychology",
    "Department of Chemistry",
    "Department of Coastal Disaster Management",
    "Department of Earth Sciences",
    "Department of Physics"
],

"School of Life Sciences" => [
    "Department of Biochemistry and Molecular Biology",
    "Department of Bioinformatics",
    "Department of Biotechnology",
    "Department of Ecology and Environmental Sciences",
    "Department of Food Science and Technology",
    "Department of Microbiology",
    "Department of Ocean Studies and Marine Biology"
],

"School of Humanities" => [
    "Centre for Foreign Languages",
    "Department of English",
    "Department of French",
    "Department of Hindi",
    "Department of Philosophy",
    "Department of Physical Education and Sports",
    "Department of Sanskrit",
    "Escande Chair in Asian Christian Studies"
],

"School of Social Sciences & International Studies" => [
    "Centre for European Studies",
    "Centre for Maritime Studies",
    "Centre for Study of Social Inclusion",
    "Centre for Women’s Studies",
    "Department of Anthropology",
    "Department of History",
    "Department of Politics and International Studies",
    "Department of Social Work",
    "Department of Sociology",
    "UMISARC – Centre for South Asian Studies"
],

"School of Engineering & Technology" => [
    "Centre for Pollution Control and Environmental Engineering",
    "Department of Computer Science",
    "Department of Computer Science – Karaikal Campus",
    "Department of Electronics Engineering"
],

"School of Education" => [
    "Centre for Adult and Continuing Education",
    "School of Education"
],

"School of Medical Sciences" => [
    "General"
],

"School of Performing Arts" => [
    "Department of Performing Arts"
],

"School of Law" => [
    "School of Law"
],

"School of Media & Communication" => [
    "Department of Electronic Media and Mass Communication",
    "Department of Library and Information Science"
],

"Madanjeet School of Green Energy Technologies" => [
    "Centre for Nano Sciences & Technology",
    "Department of Green Energy Technology"
]

];


if (isset($_POST["add"])) {

    $name = $_POST["name"];
    $category = $_POST["category"];
    $designation = $_POST["designation"] ?? "";
    $faculty_guide = $_POST["faculty_guide"] ?? "";
    $course = $_POST["course"] ?? "";
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $school = $_POST["school"];
    $department = $_POST["department"];

    $sql = "INSERT INTO contacts
            (name, category, designation, faculty_guide, course, phone, email, school, department)
            VALUES
            ('$name', '$category', '$designation', '$faculty_guide', '$course', '$phone',
             '$email', '$school', '$department')";

    if (mysqli_query($conn, $sql)) {

        $message = "Contact added successfully";

    } else {

        $message = "Contact could not be added";

    }

}

?>


<!DOCTYPE html>

<html>

<head>

<title>Add Contact - PU</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: #f2f2f2;
}

header {
    background: orange;
    color: blue;
    padding: 20px;
    text-align: center;
}

nav a {
    color: darkgreen;
    margin: 15px;
    text-decoration: none;
}

.container {
    width: 80%;
    max-width: 750px;
    margin: 40px auto;
    background: white;
    padding: 30px;
    box-shadow: 0 0 8px #aaa;
}

label {
    display: block;
    margin-top: 15px;
}

input, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
}

button {
    margin-top: 20px;
    padding: 12px 25px;
    background: #17365d;
    color: white;
    border: none;
}

.message {
    color: green;
}

</style>

</head>


<body>


<header>

<h1>Pondicherry University</h1>

<p>Contact Management Portal - Admin</p>

<nav>

<a href="admin_home.php">Home</a>

<a href="add_contact.php">Add Contact</a>

<a href="client.php">View</a>

</nav>

</header>


<div class="container">

<h2>Add New Contact</h2>


<?php

if ($message != "") {

    echo "<p class='message'>$message</p>";

}

?>


<form method="POST"
      onsubmit="return validateForm()">


<label>Category</label>

<select name="category" id="category"
        onchange="showCategoryFields()">

<option value="">
Select Category
</option>

<option value="Faculty">
Faculty
</option>

<option value="Scholar">
Scholar
</option>

<option value="Student">
Student
</option>

</select>


<label>Name</label>

<input
    type="text"
    id="name"
    name="name"
    placeholder="Enter name"
>


<div id="designationBox" style="display:none;">

<label>Designation</label>

<input
    type="text"
    name="designation"
    id="designation"
    placeholder="Example: Professor"
>

</div>

<div id="guideBox" style="display:none;">

<label>Faculty Guide</label>

<input
    type="text"
    name="faculty_guide"
    id="faculty_guide"
    placeholder="Enter Faculty Guide Name"
>

</div>


<label>Phone</label>

<input
    type="text"
    name="phone"
    id="phone"
    placeholder="Enter phone"
>


<label>Email</label>

<input
    type="email"
    name="email"
    id="email"
    placeholder="Enter email"
>


<label>School</label>

<select name="school" id="school"
        onchange="loadDepartments()">

<option value="">
Select School
</option>

<?php

foreach ($schools as $s => $departments) {

    echo "<option value='$s'>$s</option>";

}

?>

</select>


<label>Department / Centre</label>

<select name="department" id="department">

<option value="">
Select Department
</option>

</select>

<div id="courseBox" style="display:none;">

<label>Course</label>

<input type="text" name="course" id="course" placeholder="Enter Course">

</div>
<button type="submit" name="add">

Add Contact

</button>


</form>

</div>


<script>

let departments = <?php echo json_encode($schools); ?>;


function loadDepartments() {

    let school =
        document.getElementById("school").value;

    let department =
        document.getElementById("department");

    department.innerHTML =
        "<option value=''>Select Department</option>";


    if (school != "") {

        departments[school].forEach(function(item) {

            let option =
                document.createElement("option");

            option.value = item;

            option.text = item;

            department.appendChild(option);

        });

    }

}

function showCategoryFields() {

    var category = document.getElementById("category").value;

    document.getElementById("designationBox").style.display =
        (category == "Faculty") ? "block" : "none";

    document.getElementById("guideBox").style.display =
        (category == "Scholar") ? "block" : "none";

    document.getElementById("courseBox").style.display =
        (category == "Student") ? "block" : "none";
}



function validateForm() {

    let name =
        document.getElementById("name").value;

    let category =
        document.getElementById("category").value;

    let phone =
        document.getElementById("phone").value;

    let email =
        document.getElementById("email").value;

    let school =
        document.getElementById("school").value;


    if (category == "") {

        alert("Select category");

        return false;

    }


    if (name == "") {

        alert("Enter name");

        return false;

    }



    var designation = document.getElementById("designation").value;
    var facultyGuide = document.getElementById("faculty_guide").value;
    var course = document.getElementById("course").value;

    if (category == "Faculty" && designation == "") {
        alert("Enter designation");
        return false;
    }

    if (category == "Scholar" && facultyGuide == "") {
        alert("Enter Faculty Guide");
        return false;
    }

    if (category == "Student" && course == "") {
        alert("Enter Course");
        return false;
    }

    if (phone == "") {

        alert("Enter phone");

        return false;

    }


    if (email == "") {

        alert("Enter email");

        return false;

    }


    if (school == "") {

        alert("Select school");

        return false;

    }


    return true;

}

</script>


</body>

</html>