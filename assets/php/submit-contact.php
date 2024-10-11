<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize form data
    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

    // Validate form data
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If any field is empty or email is invalid, show an error
        echo "Please fill in all fields correctly.";
        exit;
    }

    // Email configuration
    $to = "darkbarrier2004@gmail.com"; // Change to your actual email address
    $subject = "New Contact Us Message from " . $name;
    $body = "You have received a new message from the contact form on Tech Heaven:\n\n";
    $body .= "Name: " . $name . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Message:\n" . $message . "\n";

    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        // Success message
        echo "Thank you for contacting us, " . $name . ". We will get back to you shortly.";
    } else {
        // Error message
        echo "Sorry, there was a problem sending your message. Please try again later.";
    }
}
?>
