<?php
require "../config.php";

$username = "";
$email = "";

// preparing sql statement & retrieving user data
if (isset($_SESSION['userID']) && is_numeric($_SESSION['userID'])) {
    if ($stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?")) {
        
        $stmt->bind_param("i", $_SESSION['userID']);
        
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $username = $row['username'];
                $email = $row['email'];
            }
        } else {
            echo "No user found with the specified ID.";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }
} else {
    echo "Invalid or missing user ID.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="../css/profile-style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Sora:wght@100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <div class = "landing-page">
        <div class="landing-content">
            <div class="landing-heading">
                <h3><label for="username">Welcome, <span style="color:orange"><?php echo $username?>!</label></span></h3>
            </div>
            <h2> The Bugle is still working on its website, but we're glad you're here!</h2>

            <h3><label for="email">When we're ready, we'll let you know at <span style="color:orange;"><?php echo $email?></label></span></h3>
            <br>
            <br>
            <button type="button" name="log-out" class="log-out-button" onclick="return confirmLogOut()">Log Out</button>
            <button type="button" name="view-users" class="view-users-button" onclick="return confirmViewUsers()">View Users</button>

            <script src="../js/script.js"></script>
        </div>
    </div>
    
    

</body>
</html>