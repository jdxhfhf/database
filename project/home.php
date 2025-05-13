<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles.css">
    <title>Shoe Catalog</title>
</head>
<body>

    <header>
        <div class="logo">Our Website Logo</div>
    </header>

    <nav>
         <a href="">Home</a>
    <a href="#">Contact</a>
    <a href="http://localhost/project/home.php">Category</a>
    <a href="login.php">Login</a>
       <a href="about.php">About Us</a>
    </nav>

    <main>
        <div class="products">
            <?php
            try {
                $db = new PDO("mysql:host=localhost;dbname=shoes", "root", "");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = $db->query("SELECT * FROM shoes");

                while ($shoes = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='items'>";
                    echo "<h2>" . htmlspecialchars($shoes["type"]) . "</h2>";
                    echo "<a href='index.php?id=" . $shoes["id"] . "'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($shoes["image"]) . "' alt='Shoe Image'>";
                    echo "</a>";
                    echo "<p>" . htmlspecialchars($shoes["description"]) . "</p>";
                    echo "<p><strong>Price:</strong> €" . number_format($shoes["price"], 2) . "</p>";
                    echo "</div>";
                }
            } catch (PDOException $e) {
                echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            ?>
        </div>
    </main>

</body>
</html>
