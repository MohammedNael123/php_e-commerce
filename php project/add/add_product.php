<?php
include('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];
        $product_description = $_POST['product_description'];
        $product_category = $_POST['product_category'];
        $product_image = $_POST['product_image'];

        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            quantity INT(11) NOT NULL,
            description TEXT NOT NULL,
            category VARCHAR(255) NOT NULL,
            image VARCHAR(255) NOT NULL
        )";

        if ($conn->query($sql) === TRUE) {
            $sql = "INSERT INTO products (name, price, quantity, description, category, image) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdisss", $product_name, $product_price, $product_quantity, $product_description, $product_category, $product_image);

            if ($stmt->execute()) {
                echo "<p>Product added successfully!</p>";
            } else {
                echo "<p>Error adding product. Please try again.</p>";
            }

            $stmt->close();
        } else {
            echo "<p>Error creating table: " . $conn->error . "</p>";
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/index.css">
    <link rel="stylesheet" href="../assets/add.css">
</head>
<body>

<?php include('../navbar.php'); ?>

<div class="mid">
    <h1>Add Product</h1>
    <form action="" method="POST">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br><br>

        <label for="product_price">Product Price:</label>
        <input type="text" id="product_price" name="product_price" required><br><br>

        <label for="product_quantity">Product Quantity:</label>
        <input type="text" id="product_quantity" name="product_quantity" required><br><br>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" required></textarea><br><br>

        <label for="product_category">Product Category:</label>
        <input type="text" id="product_category" name="product_category" required><br><br>

        <label for="product_image">Product Image URL:</label>
        <input type="text" id="product_image" name="product_image" required><br><br>

        <input type="hidden" name="add_product" value="1">
        <input type="submit" value="Add Product">
    </form>
</div>

</body>
</html>
