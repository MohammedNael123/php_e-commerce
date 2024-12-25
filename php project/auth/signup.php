<?php
include('../db_connect.php');

$table_check_sql = "SHOW TABLES LIKE 'users'";
$result = $conn->query($table_check_sql);

if ($result->num_rows == 0) {
    $create_table_sql = "
        CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            is_admin TINYINT(1) DEFAULT 0
        )
    ";
    if ($conn->query($create_table_sql) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE name = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='error-message'>Username or email already exists!</div>";
    } else {
        $sql = "INSERT INTO users (name, email, password, is_admin) VALUES (?, ?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();

        echo "<div class='success-message'>Registration successful!</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/index.css">
    <link rel="stylesheet" href="../assets/auth.css">
</head>
<body>
<?php include('../navbar.php'); ?>
    <div class="mid"> 
    <div class="container">
        <h1>Create an Account</h1>
        <form action="signup.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Sign Up">
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
    </div>

    <script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('active');
        const menuToggle = document.querySelector('.menu-toggle');
        menuToggle.textContent = navLinks.classList.contains('active') ? '✖' : '☰';
    }
    </script>
</body>
</html>
