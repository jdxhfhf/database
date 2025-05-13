<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Shoe Details</title>
</head>
<body>
    <header>
        <div class="logo">Our website logo</div>
    </header>

    <nav>
       <a href="">Home</a>
    <a href="#">Contact</a>
    <a href="http://localhost/project/home.php">Category</a>
    <a href="login.php">Login</a>
       <a href="about.php">About Us</a>
    </nav>

    <main>
        <?php
        echo "<div class='products'>";

        try {
            $db = new PDO("mysql:host=localhost;dbname=shoes", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

            if ($id > 0) {
                $query = $db->prepare("SELECT * FROM shoes WHERE id = :id");
                $query->bindParam(":id", $id, PDO::PARAM_INT);
                $query->execute();

                if ($shoes = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='opisanie'><h3>" . htmlspecialchars($shoes["opisanie"]) . "</h3></div>";
                    echo "<div class='items'>";
                    echo "<h2>" . htmlspecialchars($shoes["type"]) . "</h2>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($shoes["image"]) . "' alt='Shoe Image'>";
                    echo "<p>" . htmlspecialchars($shoes["description"]) . "</p>";
                    echo "<p>Price: €" . number_format($shoes["price"], 2) . "</p>";
                    echo "</div>";
                } else {
                    echo "<p>No shoe found with the given ID.</p>";
                }
            } else {
                echo "<p>Invalid shoe ID provided.</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
        }

        echo "</div>";
        ?>
        <div class="sale">SALE</div>
        <div class="sale2">SALE</div>
    </main>
</body>
</html>
