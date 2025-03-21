<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <style>
        body{
            background-color:rgb(178, 167, 255);
        }
        header{
            display: flex;
            flex-direction: row;
            height: 100px;
            background-color: #9966cc;
            justify-content: space-around;
            flex-wrap: nowrap;
            gap: 100px;
           
        }
        .logo{
            font-size: 60px;
            color: black;
            animation: logo 3s infinite ;
        }
        nav{
            display: flex;
            background-color: aquamarine;
            justify-content: space-around;
            min-height: 10vh;
        }
        a{
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 30px;
            color: #7b68ee;
        }
.items{
    display: flex;
    flex-wrap: wrap;
   justify-content: space-evenly;
}
@keyframes logo {
    0%{
    transform: translateY(0px);
    }
    50%{
    transform: translateY(30px);
    }
    100%{
    transform: translateY(0px);
    }
}
    </style>
    <header>
    <div class="logo">Our website logo</div>
    </header>
    <nav>
        <a href="">Home</a>
        <a href="">Contact</a>
        <a href="">Deals</a>
        <a href="">About us</a>
    </nav>
    <main>
       <?php
$db = new PDO("mysql:host=localhost;dbname=shoes", "root", "");

 
      $query = $db->prepare("SELECT * FROM shoes ");
      $query->execute();
     
while( $shoes = $query->fetch()){
      echo "<div class='items'>";
      echo "<h2>" . $shoes["type"] . "</h2>";
      echo "<p>" . $shoes["description"] . "</p>";
      echo "<p>Prijs: €" . $shoes["price"] . "</p>";
      echo "</div>";
}
?>
    </main>
</body>
</html>