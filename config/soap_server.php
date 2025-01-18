<?php
// Enable SOAP server
ini_set("soap.wsdl_cache_enabled", "0"); // Disable WSDL cache for development
$server = new SoapServer("user_registration.wsdl");
// Register the class that handles registration
$server‐>setClass("UserRegistration");
$server‐>handle();
class UserRegistration {
// Database connection parameters
private $host = 'localhost';
private $dbname = 'user_registration';
private $username = 'root'; // Replace with your database username
private $password = ''; // Replace with your database password
// Connect to the database
private function connect() {
try {
$conn = new PDO("mysql:host=$this‐>host;dbname=$this‐>dbname",
$this‐>username, $this‐>password);
$conn‐>setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $conn;
} catch (PDOException $e) {
echo "Connection failed: "
. $e‐>getMessage();
return null;
}
}
// Method to register a new user
public function registerUser($xml) {
// Parse XML data
$userData = simplexml_load_string($xml);
$username = (string)$userData‐>username;
$password = (string)$userData‐>password;
$email = (string)$userData‐>email;
// Insert user into the database
$conn = $this‐>connect();
if ($conn) {
// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
// Prepare and execute SQL query
$stmt = $conn‐>prepare("INSERT INTO users (username, password, email)
VALUES (:username, :password, :email)");
$stmt‐>bindParam(':username', $username);
$stmt‐>bindParam(':password', $hashedPassword);
$stmt‐>bindParam(':email', $email);
if ($stmt‐>execute()) {
return "Registration successful!";
} else {
return "Error: Could not register user.";
}
}
return "Database connection error.";
}
}
?>