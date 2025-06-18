<?php
require 'db.php';

$emp_id = "";
$emp_name = "";
$email = "";
$salary = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET METHOD: Show the data of the employee
    if (!isset($_GET["emp_id"])) {
        header("location: index.php");
        exit;
    }

    $emp_id = $_GET["emp_id"];
    // Read the row of the employee from the database table
    $sql = "SELECT * FROM employees WHERE emp_id = $emp_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: index.php");
        exit;
    }

    $emp_id = $row['emp_id'];
    $emp_name = $row['emp_name'];
    $email = $row['email'];
    $salary = $row['salary'];
} else {
    // POST METHOD: Update the data of the employee
    $emp_id = $_POST["emp_id"];
    $emp_name = $_POST['emp_name'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];

    do {
        if (empty($emp_id) || empty($emp_name) || empty($email) || empty($salary)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Corrected SQL query with missing comma added
        $sql = "UPDATE employees SET emp_name='$emp_name', email='$email', salary='$salary' WHERE emp_id='$emp_id'";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $successMessage = "Employee updated successfully";
        header("location: index.php");
        exit;

    } while (true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit Employee</h2>

        <?php if (!empty($errorMessage)) : ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <?php if (!empty($successMessage)) : ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Employee Name:</label>
                <div class="col-sm-6">
                    <input type="text" name="emp_name" class="form-control" value="<?php echo $emp_name; ?>"
                        placeholder="Enter Employee Name">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Employee Email:</label>
                <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>"
                        placeholder="Enter Employee Email">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Enter Salary:</label>
                <div class="col-sm-6">
                    <input type="number" name="salary" class="form-control" value="<?php echo $salary; ?>"
                        placeholder="Enter Employee Salary">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button class="btn btn-primary" type="submit">Update Employee</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-secondary" href="index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>