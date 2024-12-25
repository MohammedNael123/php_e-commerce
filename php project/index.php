<?php
include('db_connect.php');

$table_check_sql = "SHOW TABLES LIKE 'categories'";
$result = $conn->query($table_check_sql);

if ($result->num_rows == 0) {
    $create_table_sql = "
        CREATE TABLE categories (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            img VARCHAR(255) NULL
        )
    ";
    if ($conn->query($create_table_sql) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mtgrkm - E-commerce</title>
</head>
<body>

<?php
include('navbar.php');
?>

<header class="header-section">
    <div class="header-content">
        <h1>Welcome to Mtgrkm - Your Favorite Store</h1>
        <p>Find the best products at unbeatable prices.</p>
        <a href="#categories" class="shop-now-btn">Shop Now</a>
    </div>
</header>

<h2 style="text-align: center; padding-top: 100px;">Shop by Categories</h2>

<div class="categories-container" id="categories">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $imgPath = $row['img'];
            if (!empty($imgPath)) {
                echo "<div class='category-item'>";
                echo "<a href='add/products.php?category=" . urlencode($row['name']) . "'>";
                echo "<img src='" . $imgPath . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                echo "</a>";
                echo "</div>";
            } else {
                echo "<div class='category-item'>";
                echo "<h3>" . htmlspecialchars($row['name']) . " (No image available)</h3>";
                echo "</div>";
            }
        }
    } else {
        echo "<p>No categories available.</p>";
    }
    ?>
</div>

<h2 style="text-align: center;">Featured Products</h2>

<div class="featured-products">
    <div class="product-card">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3GgYI1boRNJYqmw6sEvaZURa7ylX1UobMhA&s" alt="Product 1">
        <h3>iphone 15</h3>
        <p>$950.00</p>
    </div>
    <div class="product-card">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSd4D1V63xq-Z5rUYL3bdzMxPurK-VJhDHpbw&s" alt="Product 2">
        <h3>Pc gaming</h3>
        <p>$430.00</p>
    </div>
    <div class="product-card">
        <img src="https://b2c-contenthub.com/wp-content/uploads/2023/07/Acer_Asipire3_front.jpg?quality=50&strip=all&w=1200" alt="Product 3">
        <h3>acer asper 3</h3>
        <p>$320.00</p>
    </div>
</div>

<footer class="footer">
    <div class="footer-content">
        <p>&copy; 2024 Mtgrkm. All rights reserved.</p>
        <div class="social-links">
            <a href="#" class="social-icon">Facebook</a>
            <a href="#" class="social-icon">Twitter</a>
            <a href="#" class="social-icon">Instagram</a>
        </div>
    </div>
</footer>

<?php
$conn->close();
?>

</body>
</html>
