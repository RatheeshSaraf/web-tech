<?php
// Database connection
$host = "sql207.infinityfree.com";
$username = "if0_42626922";
$password = "Rath0413";
$database = "if0_42626922_employee_db";

$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Insert employee
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employee_name = $_POST["employee_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $department = $_POST["department"];
    $designation = $_POST["designation"];
    $salary = $_POST["salary"];
    $joining_date = $_POST["joining_date"];
    $address = $_POST["address"];

    $stmt = $conn->prepare(
        "INSERT INTO employees
        (employee_name, email, phone, department, designation, salary, joining_date, address)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssssdss",
        $employee_name,
        $email,
        $phone,
        $department,
        $designation,
        $salary,
        $joining_date,
        $address
    );

    if ($stmt->execute()) {
        $message = "Employee details saved successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Details</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: span 2;
        }

        label {
            font-weight: bold;
            margin-bottom: 7px;
        }

        input,
        select,
        textarea {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        .btn {
            margin-top: 25px;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 6px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .message {
            padding: 12px;
            margin-bottom: 20px;
            background: #dcfce7;
            color: #166534;
            border-radius: 6px;
            text-align: center;
        }

        .table-card {
            margin-top: 30px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #1e3a8a;
            color: white;
        }

        tr:nth-child(even) {
            background: #f8fafc;
        }

        @media (max-width: 700px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: span 1;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Employee Details Form</h1>

        <?php if (isset($message)) { ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php } ?>

        <form method="POST" action="">

            <div class="form-grid">

                <div class="form-group">
                    <label>Employee Name</label>
                    <input
                        type="text"
                        name="employee_name"
                        placeholder="Enter employee name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input
                        type="text"
                        name="phone"
                        placeholder="Enter phone number"
                    >
                </div>

                <div class="form-group">
                    <label>Department</label>
                    <select name="department">
                        <option value="">Select Department</option>
                        <option value="HR">HR</option>
                        <option value="IT">IT</option>
                        <option value="Finance">Finance</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Sales">Sales</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Designation</label>
                    <input
                        type="text"
                        name="designation"
                        placeholder="Enter designation"
                    >
                </div>

                <div class="form-group">
                    <label>Salary</label>
                    <input
                        type="number"
                        name="salary"
                        step="0.01"
                        placeholder="Enter salary"
                    >
                </div>

                <div class="form-group">
                    <label>Joining Date</label>
                    <input
                        type="date"
                        name="joining_date"
                    >
                </div>

                <div class="form-group full">
                    <label>Address</label>
                    <textarea
                        name="address"
                        placeholder="Enter employee address"
                    ></textarea>
                </div>

            </div>

            <button type="submit" class="btn">
                Save Employee
            </button>

        </form>

    </div>


    <!-- Employee Table -->

    <div class="card table-card">

        <h1>Employee List</h1>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Salary</th>
                    <th>Joining Date</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $result = $conn->query("SELECT * FROM employees ORDER BY id DESC");

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
            ?>

                <tr>
                    <td><?php echo htmlspecialchars($row["id"]); ?></td>

                    <td>
                        <?php echo htmlspecialchars($row["employee_name"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["email"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["phone"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["department"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["designation"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["salary"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["joining_date"]); ?>
                    </td>
                </tr>

            <?php
                }

            } else {
            ?>

                <tr>
                    <td colspan="8" style="text-align:center;">
                        No employees found.
                    </td>
                </tr>

            <?php
            }
            ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>

<?php
$conn->close();
?>
```
