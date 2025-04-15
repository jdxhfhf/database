<?php
session_start();
 
// CONNECT TO DATABASE
$conn = new mysqli("localhost", "root", "", "shoes");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
// LOGOUT
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
 
// REGISTER
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
    echo "<p>Registered! You can now log in.</p>";
}
 
// LOGIN
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            header("Location: ".$_SERVER['PHP_SELF']);
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
<title>Simple Login/Register</title>
</head>
<body>
 
<?php if (isset($_SESSION['user'])): ?>
<h2>Welcome, <?= $_SESSION['user']['username'] ?>!</h2>
<p>User ID: <?= $_SESSION['user']['id'] ?></p>
<p>Your reviews:</p>
<p>Liked reviews:</p>
<a href="?logout=true">Logout</a>
 
<?php else: ?>
 
    <h2>Register</h2>
<form method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
<button type="submit" name="register">Register</button>
</form>
 
    <h2>Login</h2>
<form method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
<button type="submit" name="login">Login</button>
</form>
 
<?php endif; ?>
 
</body>
</html>