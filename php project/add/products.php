<?php

include('../db_connect.php');

$selected_category = isset($_GET['category']) ? $_GET['category'] : null;

if (!$selected_category) {
    echo "<p>No category selected.</p>";
    exit;
}

$sql = "SHOW TABLES LIKE 'products'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $createTableSql = "CREATE TABLE IF NOT EXISTS products (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        quantity INT(11) NOT NULL,
        description TEXT NOT NULL,
        category VARCHAR(255) NOT NULL,
        image VARCHAR(255) NOT NULL
    )";
    if ($conn->query($createTableSql) === FALSE) {
        echo "Error creating table: " . $conn->error;
        exit;
    }
}

$sql = "SELECT * FROM products WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selected_category);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products in <?php echo htmlspecialchars($selected_category); ?></title>
    <link rel="stylesheet" href="../assets/products.css">
    <link rel="stylesheet" href="../assets/index.css">
</head>
<body>

<?php include('../navbar.php'); ?>

<main>
    <section class="category-header">
        <h1>Products in <span><?php echo htmlspecialchars($selected_category); ?></span></h1>
    </section>

    <section class="products-container">
        <?php
        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
                echo "<div class='product-item'>";
                echo "<img src='" . htmlspecialchars($product['image']) . "' alt='" . htmlspecialchars($product['name']) . "' class='product-image'>";
                echo "<div class='product-info'>";
                echo "<h3>" . htmlspecialchars($product['name']) . "</h3>";
                echo "<p class='product-price'>$" . htmlspecialchars($product['price']) . "</p>";
                echo "<p class='product-quantity'>Quantity: " . htmlspecialchars($product['quantity']) . "</p>";
                echo "<p class='product-description'>" . htmlspecialchars($product['description']) . "</p>";
                echo "<button class='add-to-cart'>Add to Cart</button>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found for this category.</p>";
        }
        ?>
    </section>
</main>

<?php
$stmt->close();
$conn->close();
?>

</body>
</html>
