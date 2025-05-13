<?php
session_start();


$conn = new mysqli("localhost", "root", "", "shoes");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
    echo "<p>Registered! You can now log in.</p>";
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<p>Wrong password!</p>";
        }
    } else {
        echo "<p>User not found!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Simple Login/Register</title>
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

<?php if (isset($_SESSION['user'])): ?>
    <div class="form-container">
        <h2>Welcome, <?= $_SESSION['user']['username'] ?>!</h2>
        <p>User ID: <?= $_SESSION['user']['id'] ?></p>
        <a href="?logout=true">Logout</a>
    </div>
<?php else: ?>
    <div class="form-container">
        <h2>Register</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>

        <h2>Login</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
<?php endif; ?>

</body>
</html>
