<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = htmlspecialchars($_POST["product"]);
    $name    = htmlspecialchars($_POST["name"]);
    $email   = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    echo "<h2>Thank you, $name!</h2>";
    echo "<p>We received your inquiry about <strong>$product</strong>.</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Message:</strong><br />$message</p>";
} else {
    echo "<p>Invalid request method.</p>";
}
?>
