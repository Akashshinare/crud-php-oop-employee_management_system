<?php
require 'db.php';
$emp_name = "";
$email = "";
$salary = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emp_name = $_POST['emp_name'];
    $email = $_POST['email']; // corrected
    $salary = $_POST['salary'];

    do {
        if (empty($emp_name) || empty($email) || empty($salary)) {
            $errorMessage = "All the fields are required.";
            break;
        }

        // TODO: Add your database insert logic here
        $sql = "INSERT INTO employees (emp_name,email,salary) VALUES ('$emp_name', '$email', '$salary')";
        if(mysqli_query($conn, $sql)){
            header("Location: index.php");
            exit;
        }else{

            $ $errorMessage = "Failed to add employee: " . mysqli_error($conn);
        }

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Add Employee</h2>

        <?php if (!empty($errorMessage)) : ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <?php if (!empty($successMessage)) : ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Employee Name:</label>
                <div class="col-sm-6">
                    <input type="text" name="emp_name" class="form-control" value="<?php echo $emp_name ?>"
                        placeholder="Enter Employee Name">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Employee Email:</label>
                <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" value="<?php echo $email ?>"
                        placeholder="Enter Employee Email">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Enter Salary:</label>
                <div class="col-sm-6">
                    <input type="number" name="salary" class="form-control" value="<?php echo $salary ?>"
                        placeholder="Enter Employee Salary">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button class="btn btn-primary" type="submit">Add Employee</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-secondary" href="index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>