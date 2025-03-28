<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
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
           /* animation: logo 3s infinite; */
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
        .items {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            border: solid black 2px;
            padding: 20px;
            margin: 20px;
            background-color: white;
        }
        .sale{
          position: absolute;
          top: 50%;
          left: 5%;
        font-size: 80px;
        color: white;
        background-color: red;
        padding: 20px;
        border-radius: 40px;
        animation: logo 3s infinite;
        }
        .sale2{
          position: absolute;
          top: 50%;
          right: 5%;
        font-size: 80px;
        color: white;
        background-color: red;
        padding: 20px;
        border-radius: 40px;
        animation: logo 3s infinite;
        }
        .products {
            display: flex;
            justify-content: center;
         
        }
        .opisanie{
            display: flex;
            flex-direction: row-reverse;
            width: 200px;
            font-size: 20px;
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

        try {
            $db = new PDO("mysql:host=localhost;dbname=shoes", "root", "");
         
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0; 

            if ($id > 0) {
          
                $query = $db->prepare("SELECT * FROM shoes WHERE id = :id");
                $query->bindParam(":id", $id, PDO::PARAM_INT);
                $query->execute();

  
                while ($shoes = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='opisanie'>";
                    echo "<h3>" . $shoes["opisanie"] . "</h3>";
                    echo "</div>";
                    echo "<div class='items'>";
                    echo "<h2>" . htmlspecialchars($shoes["type"]) . "</h2>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($shoes["image"]) . "' alt='Afbeelding'>";
                    echo "<p>" . htmlspecialchars($shoes["description"]) . "</p>";
                    echo "<p>Prijs: €" . number_format($shoes["price"], 2) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No shoe found with the given ID.</p>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        echo "</div>";
        ?>
          <div class="sale">SALE</div>
          <div class="sale2">SALE</div>
    </main>
</body>
</html>
