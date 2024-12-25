<?php
include('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $category_image = $_POST['category_image'];

    $sql = "CREATE TABLE IF NOT EXISTS categories (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        img VARCHAR(255) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        $sql = "INSERT INTO categories (name, img) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $category_name, $category_image);
        $stmt->execute();

        echo "<p>Category added successfully!</p>";
    } else {
        echo "<p>Error creating table: " . $conn->error . "</p>";
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
    <title>Add Category</title>
    <link rel="stylesheet" href="../assets/index.css">
    <link rel="stylesheet" href="../assets/add.css">
</head>
<body>

<?php include('../navbar.php'); ?>

<div class="mid">
    <h1>Add Category</h1>
    <form action="add_category.php" method="POST">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" required><br><br>

        <label for="category_image">Category Image URL:</label>
        <input type="text" id="category_image" name="category_image" required><br><br>

        <input type="submit" value="Add Category">
    </form>
</div>

</body>
</html>
