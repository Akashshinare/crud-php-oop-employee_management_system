<?php
require 'db.php';

$sql = "SELECT * FROM employees";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="container my-5">
        <h2>List of Employees</h2>
        <a class="btn btn-primary mb-3" href="add_employee.php" role="button">Add New Client</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Employee Id</th>
                    <th>Employee Name</th>
                    <th>Employee Email</th>
                    <th>Employee Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['emp_id']) ?></td>
                    <td><?= htmlspecialchars($row['emp_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['salary']) ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit.php?emp_id=<?= $row['emp_id'] ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="delete.php?emp_id=<?= $row['emp_id'] ?>"
                            onclick="return confirm('Are you sure to delete this record?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>