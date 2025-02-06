<?php
include 'components/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['password'])) {
    $user = new User();
    $result = $user->register($_POST['email'], $_POST['password'], $_POST['name']);
    if ($result) {
        header("Location: index.php");
    } else {
        echo "<p class='error'>Registration failed!</p>";
    }
}
?>
<form action="register.php" method="POST">
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <input type="text" name="name" placeholder="Full Name" required />
    <button type="submit">Register</button>
</form>
