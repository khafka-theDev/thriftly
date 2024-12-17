<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
function getUserFirstName($conn) {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $stmt = $conn->prepare("SELECT firstName FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);  
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($firstName);
            $stmt->fetch();
            return htmlspecialchars($firstName);
        }
    }
    return "Guest"; 
}

$userName = getUserFirstName($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.1">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    <nav>
        <a href="homepage.php" class="logo-link">
            <label class="logo">Thriftly</label>
        </a>

    <div class="welcome-message">
            Hello <?php echo $userName; ?>
        </div>
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="add_item.php">Sell</a></li>
            <?php if (!isset($_SESSION['email'])): ?>

                <li><a href="index.php">Login</a></li>
            <?php else: ?>

                <li><a href="profile.php">Dev Profile</a></li>
                <li><a href="logout.php">Log out</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>
</html>
