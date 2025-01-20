<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
// Create XML data
$xml = new SimpleXMLElement('<user></user>');
$xml->addChild('username', $username);
$xml->addChild('password', $password);
$xml->addChild('email', $email);
// Create SOAP client and send the request
//echo realpath("user_registration.wsdl");

//echo file_get_contents("user_registration.wsdl");

$client = new SoapClient("user_registration.wsdl");
$response = $client->registerUser($xml->asXML());
echo "<h2>$response</h2>";

if ($response == "Registration successful!") { 
    header("Location: login.php");
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Form</title>
        <link href="register-style.css" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Sora:wght@100..800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    </head>
    <body>
        <div class = "landing-page">
            <div class="landing-content">
                <div class="landing-heading">
                    <h2>The Daily Bugle!</h2>
                </div>
                <div class="landing-subheading">
                    <h2>Makati's <span style = "color:orange;">Most Trusted</span> Newspaper.</h2>
                </div>

                <div class="scroll-indicator"> 
                    <h2>Stay In the Loop, <span style = "color:orangel">Register Below!</span></h2>
                </div>
            </div>
            

        </div>
        <div class="form-container">
            <div class="left-side">

                <h2>ABOUT THE BUGLE:</h2>
                <p>The Daily Bugle is Makati's most trusted source for news, delivering timely updates on everything from local happenings to global events. With a commitment to uncovering the truth, we aim to keep our readers informed, inspired, and engaged.</p>
                <p><strong>Next Issue:</strong> Mapua's Centennial Anniversary</p>
                
            </div>

            <div class="right-side">
                <div class="form-style">
                    <div class="register-form">
                        <form method="POST" action="register.php">
                            <label for="username">Username:</label><br>
                            <input type="text" id="username" name="username" required><br><br>
                            <label for="password">Password:</label><br>
                            <input type="password" id="password" name="password" required><br><br>
                            <label for="email">Email:</label><br>
                            <input type="email" id="email" name="email" required><br><br>
                            <input type="submit" value="Register">
                            <h4>Already have an account?<a href="register.php"> Log in now!</a></h4>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>