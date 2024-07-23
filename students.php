<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "school_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert a new student
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];
    $sql = "INSERT INTO students (name, age, grade) VALUES ('$name', '$age', '$grade')";
    $conn->query($sql);
}

// Update a student
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];
    $sql = "UPDATE students SET name='$name', age='$age', grade='$grade' WHERE id='$id'";
    $conn->query($sql);
}

// Delete a student
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM students WHERE id='$id'";
    $conn->query($sql);
}

// Retrieve students
$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="students.php">Students</a></li>
            <li><a href="staff.php">Staff</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>
    <h1>Students</h1>

    <form method="POST" action="">
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="grade" placeholder="Grade" required>
        <button type="submit" name="add">Add Student</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Grade</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['grade']; ?></td>
            <td>
                <a href="students.php?edit=<?php echo $row['id']; ?>">Edit</a>
                <a href="students.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>