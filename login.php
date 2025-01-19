<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$password = $_POST['password'];
$email = $_POST['email'];
// Create XML data
$xml = new SimpleXMLElement('<user></user>');
$xml->addChild('password', $password);
$xml->addChild('email', $email);
// Create SOAP client and send the request
//echo realpath("user_registration.wsdl");

//echo file_get_contents("user_registration.wsdl");

$client = new SoapClient("user_registration.wsdl");
$response = $client->registerUser($xml->asXML());
echo "<h2>$response</h2>";

if($response == "Login successful!") {
    header("Location: profile.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
</head>
<body>
<h2>User Login</h2>
<form method="POST" action="login.php">
<label for="email">Email:</label><br>
<input type="email" id="email" name="email" required><br><br>
<label for="password">Password:</label><br>
<input type="password" id="password" name="password" required><br><br>
<input type="submit" value="Register">
</form>
</body>
</html>