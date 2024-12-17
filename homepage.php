<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include("header.php"); ?>

    <div class="container">
        <h1 class="form-title">Items for Sale</h1>
        <div class="items-grid">
            <?php
            $sql = "SELECT item_name, item_description, price, image_url, brand, item_condition, size, location, deal_method, contact FROM items";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="item-card">';
                    echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['item_name']) . '" class="item-image">';
                    echo '<div class="item-details">';
                    echo '<h2>' . htmlspecialchars($row['item_name']) . '</h2>';
                    echo '<p><strong>Price:</strong> RM' . htmlspecialchars($row['price']) . '</p>';
                    echo '<p><strong>Brand:</strong> ' . htmlspecialchars($row['brand']) . '</p>';
                    echo '<p><strong>Condition:</strong> ' . htmlspecialchars($row['item_condition']) . '</p>';
                    echo '<p><strong>Size:</strong> ' . htmlspecialchars($row['size']) . '</p>';
                    echo '<p><strong>Location:</strong> ' . htmlspecialchars($row['location']) . '</p>';
                    echo '<p><strong>Deal Method:</strong> ' . htmlspecialchars($row['deal_method']) . '</p>';
                    echo '<p><strong>Contact:</strong> ' . htmlspecialchars($row['contact']) . '</p>';
                    echo '<p><br></p>';
                    echo '<p>' . htmlspecialchars($row['item_description']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No items available for sale at the moment.</p>';
            }
            ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
