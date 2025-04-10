<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = htmlspecialchars($_POST["product"]);
    $name    = htmlspecialchars($_POST["name"]);
    $email   = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    echo "<h2>Thank you, $name!</h2>";
    echo "<p>We received your inquiry about <strong>$product</strong>.</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Message:</strong><br />" . nl2br($message) . "</p>";
    echo '<p><a href="product-details.php">Back to product</a></p>';
    exit();
}

// Get product info from query string
$name  = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Unknown Product';
$price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : 'N/A';
$desc  = isset($_GET['desc']) ? htmlspecialchars($_GET['desc']) : 'No description available.';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php echo $name; ?> - Product Details</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    header, footer {
      background-color: #333;
      color: white;
      padding: 15px;
      text-align: center;
    }
    nav a {
      color: white;
      margin: 0 10px;
      text-decoration: none;
    }
    main {
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 30px;
    }
    .product-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      align-items: center;
    }
    .product-container img {
      max-width: 250px;
      height: auto;
      border: 1px solid #ccc;
    }
    .product-details {
      max-width: 500px;
    }
    .inquiry-form form {
      display: flex;
      flex-direction: column;
      max-width: 500px;
    }
    .inquiry-form input[type="text"],
    .inquiry-form textarea {
      margin-bottom: 15px;
      padding: 8px;
      border: 1px solid #ccc;
    }
    .inquiry-form input[type="submit"] {
      padding: 10px;
      background-color: #28a745;
      color: white;
      border: none;
      cursor: pointer;
    }
    @media (max-width: 600px) {
      .product-container {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
  <script type="text/javascript">
    function validateForm() {
      var name = document.getElementById('name').value.trim();
      var email = document.getElementById('email').value.trim();
      var message = document.getElementById('message').value.trim();

      if (name === '' || email === '' || message === '') {
        alert('Please fill in all fields.');
        return false;
      }

      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return false;
      }

      return true;
    }
  </script>
</head>
<body>
  <header>
    <h1>My Online Store</h1>
    <nav>
      <a href="products.html">Back to Products</a>
    </nav>
  </header>

  <main>
    <div class="product-container">
      <img src="https://via.placeholder.com/250" alt="<?php echo $name; ?>" />
      <div class="product-details">
        <h2><?php echo $name; ?></h2>
        <p><strong>Price:</strong> $<?php echo $price; ?></p>
        <p><strong>Description:</strong> <?php echo $desc; ?></p>
      </div>
    </div>

    <div class="inquiry-form">
      <h3>Have a Question about <?php echo $name; ?>?</h3>
      <form action="product-details.php" method="POST" onsubmit="return validateForm();">
        <input type="hidden" name="product" value="<?php echo $name; ?>" />

        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" />

        <label for="email">Your Email:</label>
        <input type="text" id="email" name="email" />

        <label for="message">Message:</label>
        <textarea id="message" name="message"></textarea>

        <input type="submit" value="Submit Inquiry" />
      </form>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 My Online Store. All rights reserved.</p>
  </footer>
</body>
</html>
