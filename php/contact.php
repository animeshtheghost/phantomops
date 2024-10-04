<?php

// Include the configuration file
$config = include(__DIR__ . '/../includes/config.php');

// Database connection parameters
$dbConfig = $config['db'];
$host = $dbConfig['host'];
$dbname = $dbConfig['dbname'];
$username = $dbConfig['username'];
$password = $dbConfig['password'];

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Function to validate email
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and validate input data
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $mobile = sanitize_input($_POST['mobile']);
    $address = sanitize_input($_POST['address']);
    $message = sanitize_input($_POST['message']);

    // Validate email
    if (!validate_email($email)) {
        die("Invalid email format");
    }

    // Get current timestamp in IST
    $dateTime = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
    $timestamp = $dateTime->format('Y-m-d H:i:s');

    // Prepare SQL query
    $sql = "INSERT INTO contact_form_submissions (name, email, mobile, address, message, `timestamp`) VALUES (:name, :email, :mobile, :address, :message, :timestamp)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters and execute query
    try {
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':mobile' => $mobile,
            ':address' => $address,
            ':message' => $message,
            ':timestamp' => $timestamp
        ]);

        // Redirect to thank you page to prevent resubmission on reload
        header("Location: ../thankyou/thankyou.php");
        exit; // Ensure script execution is stopped after redirection
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    die("Invalid request");
}

?>
