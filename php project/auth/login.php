<?php
session_start();

include('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE name = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;

            echo "<script>
                    window.localStorage.setItem('username', '{$user['name']}');
                    window.localStorage.setItem('is_admin', '{$user['is_admin']}');
                    window.location.href = '../index.php';
                </script>";
            exit;
        }
    }
    echo "<div class='error-message'>Invalid credentials!</div>";

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/index.css">
    <link rel="stylesheet" href="../assets/auth.css">
</head>
<body>
<?php include('../navbar.php'); ?>
<div class="mid">
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <label for="username_or_email">Username or Email:</label>
            <input type="text" id="username_or_email" name="username_or_email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
</div>
</body>
</html>
