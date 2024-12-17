<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['addItem'])) {
    $itemName = htmlspecialchars($_POST['itemName']);
    $itemDescription = htmlspecialchars($_POST['itemDescription']);
    $itemPrice = htmlspecialchars($_POST['itemPrice']);
    $brand = htmlspecialchars($_POST['brand']);
    $condition = htmlspecialchars($_POST['condition']);
    $size = htmlspecialchars($_POST['size']);
    $location = htmlspecialchars($_POST['location']);
    $dealMethod = htmlspecialchars($_POST['dealMethod']);
    $contact = htmlspecialchars($_POST['contact']);
    
    $image = $_FILES['itemImage']['name'];
    $imageTmpName = $_FILES['itemImage']['tmp_name'];
    $imageSize = $_FILES['itemImage']['size'];
    $imageError = $_FILES['itemImage']['error'];
    $imageExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'png'];
    if (in_array($imageExt, $allowed)) {
        if ($imageError === 0) {
            if ($imageSize < 5000000) {
                $newImageName = uniqid('', true) . '.' . $imageExt;
                $imagePath = 'uploads/' . $newImageName;

                if (!file_exists('uploads')) {
                    if (!mkdir('uploads', 0777, true)) {
                        $_SESSION['notification'] = "Failed to create directory.";
                        $_SESSION['notification_type'] = "error";
                        header("Location: add_item.php");
                        exit();
                    }
                }

                move_uploaded_file($imageTmpName, $imagePath);

                $stmt = $conn->prepare("INSERT INTO items (item_name, item_description, price, brand, item_condition, size, location, deal_method, contact, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssdsssssss", $itemName, $itemDescription, $itemPrice, $brand, $condition, $size, $location, $dealMethod, $contact, $imagePath);

                if ($stmt->execute()) {
                    $_SESSION['notification'] = "Item added successfully!";
                    $_SESSION['notification_type'] = "success";
                } else {
                    $_SESSION['notification'] = "Error: " . $stmt->error;
                    $_SESSION['notification_type'] = "error";
                }
                $stmt->close();
            } else {
                $_SESSION['notification'] = "Your image is too big!";
                $_SESSION['notification_type'] = "error";
            }
        } else {
            $_SESSION['notification'] = "There was an error uploading your image!";
            $_SESSION['notification_type'] = "error";
        }
    } else {
        $_SESSION['notification'] = "You cannot upload files of this type!";
        $_SESSION['notification_type'] = "error";
    }
    header("Location: add_item.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <?php include("header.php"); ?>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/notification.js" defer></script>
</head>
<body>
    <div id="notification" style="display: none;"></div>

    <div class="addItemContainer">
        <div class="add-item-page">
            <h1 class="form-title">Add Item for Sale</h1>
            <form method="POST" action="add_item.php" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="text" name="itemName" id="itemName" placeholder="Item Name" required>
                    <label for="itemName">Item Name</label>
                </div><br>
                <div class="input-group">
                    <input type="text" name="brand" id="brand" placeholder="Item Brand" required> 
                    <label for="brand">Item Brand</label>
                </div><br>

                <div class="input-radio">
                    <label for="condition">Condition:</label><br>
                    <input type="radio" name="condition" id="likeNew" value="Used-like new" required>
                    <label for="likeNew">Used-like new</label><br>

                    <input type="radio" name="condition" id="good" value="Good" required>
                    <label for="good">Good</label><br>

                    <input type="radio" name="condition" id="soSo" value="So-so" required>
                    <label for="soSo">So-so</label><br>

                    <input type="radio" name="condition" id="wellWorn" value="Well worn" required>
                    <label for="wellWorn">Well worn</label>
                </div><br>

                <div class="input-group">
                    <input type="text" name="size" id="size" placeholder="Size" required>
                    <label for="size">Size</label>
                </div><br>
                <div class="input-group">
                    <textarea name="itemDescription" id="itemDescription" placeholder="Item Description" rows='5' required></textarea>
                    <label for="itemDescription">Description</label>
                </div><br>
                <div class="input-group">
                    <input type="number" name="itemPrice" id="itemPrice" placeholder="Item Price" required>
                    <label for="itemPrice">Price</label>
                </div><br>
                <div class="input-group">
                    <input type="text" name="location" id="location" placeholder="Location" required>
                    <label for="location">Location</label>
                </div><br>

                <div class="input-group">
                    <label for="dealMethod">Deal Method:</label><br>
                    <select name="dealMethod" id="dealMethod" required>
                        <option value="" disabled selected>Select a deal method</option>
                        <option value="Courier delivery">Courier delivery</option>
                        <option value="Meet-up">Meet-up</option>
                        <option value="Cash on delivery">Cash on delivery</option>
                    </select>
                </div><br>

                <div class="input-group">
                    <input type="tel" name="contact" id="contact" placeholder="Contact" required>
                    <label for="contact">Contact Number</label>
                </div><br>
                <div class="input-group">
                    <input type="file" name="itemImage" id="itemImage" required>
                    <label for="itemImage">Item Image</label>
                </div><br>
                <input type="submit" class="btn" value="Add Item" name="addItem">
            </form>
        </div>
    </div>

    <script>
        <?php if(isset($_SESSION['notification'])): ?>
            document.addEventListener('DOMContentLoaded', function() {
                showSuccessNotification("<?php echo $_SESSION['notification']; ?>");
            });
            <?php unset($_SESSION['notification']); ?>
        <?php endif; ?>
    </script>
</body>
<footer>
    <?php include 'footer.php'; ?>
</footer>
</html>
