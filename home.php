<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: rgb(178, 167, 255);
            font-family: Arial, sans-serif;
        }
        header {
            display: flex;
            flex-direction: row;
            height: 100px;
            background-color: #9966cc;
            justify-content: space-around;
            align-items: center;
            gap: 100px;
        }
        .logo {
            font-size: 60px;
            color: black;
            animation: logo 3s infinite;
        }
        nav {
            display: flex;
            background-color: aquamarine;
            justify-content: space-around;
            min-height: 10vh;
            align-items: center;
        }
        a {
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 30px;
            color: #7b68ee;
        }

   
        .products {
            display: flex;
            flex-direction: column; 
            align-items: center;  
            gap: 20px;              
            margin-top: 20px;
        }

        .items {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: solid black 2px;
            padding: 20px;
            background-color: white;
            width: 350px;
            text-align: center;
        }

        img {
            width: 350px;
            height: 300px;
        }

        @keyframes logo {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(30px);
            }
            100% {
                transform: translateY(0px);
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Our website logo</div>
    </header>
    <nav>
        <a href="http://localhost/project/home.php">Home</a>
        <a href="">Contact</a>
        <a href="">Category</a>
        <a href="">About us</a>
    </nav>
    <main>
        <?php
        echo "<div class='products'>";

   
        $db = new PDO("mysql:host=localhost;dbname=shoes", "root", "");

        $query = $db->prepare("SELECT * FROM shoes");
        $query->execute();

        while ($shoes = $query->fetch()) {
            echo "<div class='items'>";
            echo "<h2>" . htmlspecialchars($shoes["type"]) . "</h2>";
            echo "<a href='index.php?id=" . $shoes["id"] . "'><img src='data:image/jpeg;base64," . base64_encode($shoes["image"]) . "' alt='Afbeelding' /></a>";
            echo "<p>" . htmlspecialchars($shoes["description"]) . "</p>";
            echo "<p>Prijs: €" . number_format($shoes["price"], 2) . "</p>";
            echo "</div>";
        }
        echo "</div>";
        ?>
    </main>
</body>
</html>
