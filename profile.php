<?php
require "config.php";

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
</head>
<body>
    <h2>My Profile</h2>
    <label for="username">Username:</label><br>
    <h3><?php $username?></h3>
    <label for="email">Email:</label><br>
    <h3><?php $email?></h3>
    <button type="button" name="log-out" onclick="return confirmLogOut()">Log Out</button>
    <button type="button" name="view-users" onclick="return confirmViewUsers()">View Users</button>
    <script src="script.js"></script>
</body>
</html>