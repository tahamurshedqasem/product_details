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
    echo '<p><a href="products.php">Back to Products</a></p>';
    exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Products</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <style type="text/css">
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
    header, footer { background-color: #333; color: white; text-align: center; padding: 10px; }
    nav a { color: white; text-decoration: none; margin: 0 10px; }
    main { padding: 20px; }
    ul { list-style: none; padding: 0; }
    li { margin-bottom: 10px; }
    .product-container { display: flex; flex-wrap: wrap; gap: 20px; align-items: center; }
    .product-container img { max-width: 250px; border: 1px solid #ccc; }
    .product-details { max-width: 500px; }
    form { max-width: 500px; display: flex; flex-direction: column; }
    input[type="text"], textarea { margin-bottom: 10px; padding: 8px; border: 1px solid #ccc; }
    input[type="submit"] { background: green; color: white; padding: 10px; border: none; cursor: pointer; }
    @media (max-width: 600px) {
      .product-container { flex-direction: column; align-items: flex-start; }
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

      var emailRegex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
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
  <nav><a href="products.php">Home</a></nav>
</header>
<main>

<?php
// If viewing details
if (isset($_GET['name']) && isset($_GET['price']) && isset($_GET['desc']) && isset($_GET['img'])) {
    $name  = htmlspecialchars($_GET['name']);
    $price = htmlspecialchars($_GET['price']);
    $desc  = htmlspecialchars($_GET['desc']);
    $img   = htmlspecialchars($_GET['img']);
    ?>

    <div class="product-container">
      <img src="<?php echo $img; ?>" alt="<?php echo $name; ?>" />
      <div class="product-details">
        <h2><?php echo $name; ?></h2>
        <p><strong>Price:</strong> $<?php echo $price; ?></p>
        <p><strong>Description:</strong> <?php echo $desc; ?></p>
      </div>
    </div>

    <div class="inquiry-form">
      <h3>Ask about <?php echo $name; ?></h3>
      <form method="POST" action="products.php" onsubmit="return validateForm();">
        <input type="hidden" name="product" value="<?php echo $name; ?>" />
        <label>Your Name:</label>
        <input type="text" name="name" id="name" />
        <label>Your Email:</label>
        <input type="text" name="email" id="email" />
        <label>Message:</label>
        <textarea name="message" id="message"></textarea>
        <input type="submit" value="Send Inquiry" />
      </form>
    </div>

    <p><a href="products.php">← Back to all products</a></p>

    <?php
} else {
    // Product listing
    $products = [
        [
            "name" => "Smartphone X100",
            "price" => 699,
            "desc" => "High-performance smartphone with 128GB storage.",
            "img" => "https://via.placeholder.com/250?text=Smartphone"
        ],
        [
            "name" => "Laptop ZPro",
            "price" => 999,
            "desc" => "Powerful laptop with 16GB RAM and SSD.",
            "img" => "image.png"
        ],
        [
            "name" => "Wireless Earbuds",
            "price" => 149,
            "desc" => "Noise-cancelling earbuds with long battery life.",
            "img" => "https://via.placeholder.com/250?text=Earbuds"
        ]
    ];

    echo "<h2>Available Products</h2><ul>";
    foreach ($products as $product) {
        $url = "products.php?name=" . urlencode($product["name"]) .
               "&price=" . urlencode($product["price"]) .
               "&desc=" . urlencode($product["desc"]) .
               "&img=" . urlencode($product["img"]);
        echo "<li><a href=\"$url\">" . htmlspecialchars($product["name"]) . " - $" . $product["price"] . "</a></li>";
    }
    echo "</ul>";
}
?>

</main>
<footer>
  <p>&copy; 2025 My Online Store</p>
</footer>
</body>
</html>
