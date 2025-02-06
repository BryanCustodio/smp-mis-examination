<?php
include 'components/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['password'])) {
    $user = new User();
    $result = $user->login($_POST['email'], $_POST['password']);
    if ($result) {
        header("Location: index.php");
    } else {
        echo "<p class='error'>Invalid credentials!</p>";
    }
}
?>
