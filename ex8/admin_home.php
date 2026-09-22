<?php
include "db.php";

$schools = [
"Subramania Bharathi School of Tamil Language & Literature" => ["Subramania Bharathi School of Tamil Language & Literature"],
"School of Management" => ["Department of Banking Technology","Department of Commerce","Department of Commerce – Karaikal Campus","Department of Economics","Department of International Business","Department of Management Studies","Department of Management Studies – Karaikal Campus","Department of Management Studies Port Blair Campus","Department of Tourism Studies"],
"Ramanujan School of Mathematical Sciences" => ["Department of Mathematics","Department of Statistics"],
"School of Physical, Chemical and Applied Sciences" => ["Department of Applied Psychology","Department of Chemistry","Department of Coastal Disaster Management","Department of Earth Sciences","Department of Physics"],
"School of Life Sciences" => ["Department of Biochemistry and Molecular Biology","Department of Bioinformatics","Department of Biotechnology","Department of Ecology and Environmental Sciences","Department of Food Science and Technology","Department of Microbiology","Department of Ocean Studies and Marine Biology"],
"School of Humanities" => ["Centre for Foreign Languages","Department of English","Department of French","Department of Hindi","Department of Philosophy","Department of Physical Education and Sports","Department of Sanskrit","Escande Chair in Asian Christian Studies"],
"School of Social Sciences & International Studies" => ["Centre for European Studies","Centre for Maritime Studies","Centre for Study of Social Inclusion","Centre for Women’s Studies","Department of Anthropology","Department of History","Department of Politics and International Studies","Department of Social Work","Department of Sociology","UMISARC – Centre for South Asian Studies"],
"School of Engineering & Technology" => ["Centre for Pollution Control and Environmental Engineering","Department of Computer Science","Department of Computer Science – Karaikal Campus","Department of Electronics Engineering"],
"School of Education" => ["Centre for Adult and Continuing Education","School of Education"],
"School of Medical Sciences" => ["General"],
"School of Performing Arts" => ["Department of Performing Arts"],
"School of Law" => ["School of Law"],
"School of Media & Communication" => ["Department of Electronic Media and Mass Communication","Department of Library and Information Science"],
"Madanjeet School of Green Energy Technologies" => ["Centre for Nano Sciences & Technology","Department of Green Energy Technology"]
];

$search = trim($_GET["search"] ?? "");
$category = $_GET["category"] ?? "";
$school = $_GET["school"] ?? "";
$department = $_GET["department"] ?? "";
$message = "";

/* DELETE */
if (isset($_GET["delete"])) {
    $id = (int)$_GET["delete"];
    mysqli_query($conn, "DELETE FROM contacts WHERE id=$id");
    header("Location: admin_home.php?deleted=1");
    exit();
}

if (isset($_GET["deleted"])) {
    $message = "Contact deleted successfully";
}

/* UPDATE */
if (isset($_POST["update"])) {
    $id = (int)$_POST["id"];
    $name = mysqli_real_escape_string($conn, $_POST["name"] ?? "");
    $editCategory = $_POST["category"] ?? "";
    $designation = mysqli_real_escape_string($conn, $_POST["designation"] ?? "");
    $facultyGuide = mysqli_real_escape_string($conn, $_POST["faculty_guide"] ?? "");
    $course = mysqli_real_escape_string($conn, $_POST["course"] ?? "");
    $phone = mysqli_real_escape_string($conn, $_POST["phone"] ?? "");
    $email = mysqli_real_escape_string($conn, $_POST["email"] ?? "");
    $newSchool = mysqli_real_escape_string($conn, $_POST["school"] ?? "");
    $newDepartment = mysqli_real_escape_string($conn, $_POST["department"] ?? "");

    $sql = "UPDATE contacts SET
            name='$name',
            designation='$designation',
            faculty_guide='$facultyGuide',
            course='$course',
            phone='$phone',
            email='$email',
            school='$newSchool',
            department='$newDepartment'
            WHERE id=$id";

    mysqli_query($conn, $sql);

    $returnSearch = urlencode($_POST["return_search"] ?? "");
    $returnCategory = urlencode($_POST["return_category"] ?? "");
    $returnSchool = urlencode($_POST["return_school"] ?? "");
    $returnDepartment = urlencode($_POST["return_department"] ?? "");

    header("Location: admin_home.php?updated=1&search=$returnSearch&category=$returnCategory&school=$returnSchool&department=$returnDepartment");
    exit();
}

if (isset($_GET["updated"])) {
    $message = "Contact updated successfully";
}

function getResults($conn, $category, $search, $school, $department) {
    $category = mysqli_real_escape_string($conn, $category);
    $search = mysqli_real_escape_string($conn, $search);
    $school = mysqli_real_escape_string($conn, $school);
    $department = mysqli_real_escape_string($conn, $department);

    $sql = "SELECT * FROM contacts WHERE category='$category'";

    if ($search != "") {
        $sql .= " AND (
            name LIKE '%$search%' OR
            phone LIKE '%$search%' OR
            email LIKE '%$search%' OR
            school LIKE '%$search%' OR
            department LIKE '%$search%' OR
            designation LIKE '%$search%' OR
            faculty_guide LIKE '%$search%' OR
            course LIKE '%$search%'
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

function renderTable($conn, $category, $search, $school, $department, $schools) {
    $result = getResults($conn, $category, $search, $school, $department);
    $editId = isset($_GET["edit"]) ? (int)$_GET["edit"] : 0;
    $formId = "editForm" . $category;

    echo '<h3>'.$category.' Contacts</h3>';

    /* Hidden edit form is kept outside the table so the Save button works correctly. */
    if ($editId > 0) {
        echo '<form id="'.$formId.'" method="POST">';
        echo '<input type="hidden" name="id" value="'.$editId.'">';
        echo '<input type="hidden" name="update" value="1">';
        echo '<input type="hidden" name="category" value="'.htmlspecialchars($category).'">';
        echo '<input type="hidden" name="return_search" value="'.htmlspecialchars($search).'">';
        echo '<input type="hidden" name="return_category" value="'.htmlspecialchars($_GET["category"] ?? "").'">';
        echo '<input type="hidden" name="return_school" value="'.htmlspecialchars($school).'">';
        echo '<input type="hidden" name="return_department" value="'.htmlspecialchars($department).'">';
        echo '</form>';
    }

    echo '<table><tr>';
    echo '<th>Name</th>';

    if ($category == "Faculty") echo '<th>Designation</th>';
    if ($category == "Scholar") echo '<th>Faculty Guide</th>';
    if ($category == "Student") echo '<th>Course</th>';

    echo '<th>Phone</th><th>Email</th><th>School</th><th>Department</th><th class="action-cell">Action</th></tr>';

    if (!$result || mysqli_num_rows($result) == 0) {
        echo '<tr><td colspan="7" class="no-result">No results found</td></tr>';
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $isEditing = ($editId == (int)$row["id"]);

        echo '<tr>';

        if ($isEditing) {
            echo '<td><input form="'.$formId.'" type="text" name="name" value="'.htmlspecialchars($row["name"]).'"></td>';

            if ($category == "Faculty") {
                echo '<td><input form="'.$formId.'" type="text" name="designation" value="'.htmlspecialchars($row["designation"] ?? "").'"></td>';
            }
            if ($category == "Scholar") {
                echo '<td><input form="'.$formId.'" type="text" name="faculty_guide" value="'.htmlspecialchars($row["faculty_guide"] ?? "").'"></td>';
            }
            if ($category == "Student") {
                echo '<td><input form="'.$formId.'" type="text" name="course" value="'.htmlspecialchars($row["course"] ?? "").'"></td>';
            }

            echo '<td><input form="'.$formId.'" type="text" name="phone" value="'.htmlspecialchars($row["phone"]).'"></td>';
            echo '<td><input form="'.$formId.'" type="email" name="email" value="'.htmlspecialchars($row["email"]).'"></td>';

            echo '<td><select form="'.$formId.'" name="school">';
            foreach ($schools as $s => $deps) {
                echo '<option value="'.htmlspecialchars($s).'"'.($row["school"] == $s ? ' selected' : '').'>'.htmlspecialchars($s).'</option>';
            }
            echo '</select></td>';

            echo '<td><select form="'.$formId.'" name="department">';
            foreach ($schools as $s => $deps) {
                foreach ($deps as $d) {
                    echo '<option value="'.htmlspecialchars($d).'"'.($row["department"] == $d ? ' selected' : '').'>'.htmlspecialchars($d).'</option>';
                }
            }
            echo '</select></td>';

            echo '<td class="action-cell">';
            echo '<button form="'.$formId.'" type="submit" class="save">Save</button> ';
            echo '<a href="admin_home.php?search='.urlencode($search).'&category='.urlencode($_GET["category"] ?? "").'&school='.urlencode($school).'&department='.urlencode($department).'">Cancel</a>';
            echo '</td>';
        } else {
            echo '<td>'.htmlspecialchars($row["name"]).'</td>';

            if ($category == "Faculty") echo '<td>'.htmlspecialchars($row["designation"] ?? "").'</td>';
            if ($category == "Scholar") echo '<td>'.htmlspecialchars($row["faculty_guide"] ?? "").'</td>';
            if ($category == "Student") echo '<td>'.htmlspecialchars($row["course"] ?? "").'</td>';

            echo '<td>'.htmlspecialchars($row["phone"]).'</td>';
            echo '<td>'.htmlspecialchars($row["email"]).'</td>';
            echo '<td>'.htmlspecialchars($row["school"]).'</td>';
            echo '<td>'.htmlspecialchars($row["department"]).'</td>';
            echo '<td class="action-cell">';
            echo '<a class="edit" href="admin_home.php?edit='.(int)$row["id"].'&search='.urlencode($search).'&category='.urlencode($_GET["category"] ?? "").'&school='.urlencode($school).'&department='.urlencode($department).'">Edit</a> ';
            echo '<a class="delete" href="admin_home.php?delete='.(int)$row["id"] .'" onclick="return confirm(\'Delete this contact?\')">Delete</a>';
            echo '</td>';
        }

        echo '</tr>';
    }

    echo '</table>';
}
?>
<!DOCTYPE html>
<html>
<head>
<title>PU Contact Management Portal</title>
<style>
body{margin:0;font-family:Arial;background:#f2f2f2}
header{background:orange;color:blue;padding:20px;text-align:center}
nav a{color:darkgreen;margin:15px;text-decoration:none}
.container{width:95%;margin:30px auto;background:white;padding:25px;box-shadow:0 0 8px #aaa;box-sizing:border-box}
input,select{padding:9px;margin:5px;box-sizing:border-box}
button{padding:9px 15px;border:none;background:#17365d;color:white;cursor:pointer}
.delete{background:#b22222;color:white;padding:7px;text-decoration:none}
.edit{background:#286090;color:white;padding:7px;text-decoration:none}
.save{background:green}
table{width:100%;table-layout:fixed;border-collapse:collapse;margin-top:20px;margin-bottom:35px}
th,td{border:1px solid #aaa;padding:8px;word-wrap:break-word;overflow-wrap:break-word;vertical-align:top}
th{background:#e8eef5}
td input,td select{width:100%;max-width:100%;margin:0}
th:last-child,td:last-child{width:120px}
.message{color:green}.no-result{text-align:center;color:red;padding:20px}
</style>
</head>
<body>
<header><h1>Pondicherry University</h1><p>Contact Management Portal - Admin</p><nav><a href="admin_home.php">Home</a><a href="add_contact.php">Add Contact</a><a href="client.php">View</a></nav></header>
<div class="container">
<h2>Contact List</h2>
<?php if($message!="") echo '<p class="message">'.htmlspecialchars($message).'</p>'; ?>
<form method="GET">
<input type="text" name="search" placeholder="Search contacts..." value="<?php echo htmlspecialchars($search); ?>">
<select name="category"><option value="">All Categories</option><option value="Faculty" <?php if($category=="Faculty")echo"selected";?>>Faculty</option><option value="Scholar" <?php if($category=="Scholar")echo"selected";?>>Scholar</option><option value="Student" <?php if($category=="Student")echo"selected";?>>Student</option></select>
<select name="school"><option value="">All Schools</option><?php foreach($schools as $s=>$deps) echo '<option value="'.htmlspecialchars($s).'"'.($school==$s?' selected':'').'>'.htmlspecialchars($s).'</option>'; ?></select>
<select name="department"><option value="">All Departments</option><?php foreach($schools as $s=>$deps) foreach($deps as $d) echo '<option value="'.htmlspecialchars($d).'"'.($department==$d?' selected':'').'>'.htmlspecialchars($d).'</option>'; ?></select>
<button type="submit">Search</button> <a href="admin_home.php"><button type="button">Reset</button></a>
</form>
<?php
if($category==""){
    renderTable($conn,"Faculty",$search,$school,$department,$schools);
    renderTable($conn,"Scholar",$search,$school,$department,$schools);
    renderTable($conn,"Student",$search,$school,$department,$schools);
}else{
    renderTable($conn,$category,$search,$school,$department,$schools);
}
?>
</div>
</body>
</html>
