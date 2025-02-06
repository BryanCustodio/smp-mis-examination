<?php
if (!defined('ACCESS_ALLOWED')) {
    die("Direct access not permitted.");
}

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Session.php');
Session::init();

include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/Format.php');

spl_autoload_register(function ($class) {
    include_once "classes/" . $class . ".php";
});

$db   = new Database();
$fm   = new Format();
$exam = new Exam();
$user = new User();
$pro  = new Process();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Mon, 6 Dec 1977 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Exam System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-book-reader"></i> Online Examination System
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (Session::get("login") == true) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Welcome, <strong><?php echo Session::get("name"); ?></strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="exam.php"><i class="fas fa-file-alt"></i> Exam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="?action=logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php"><i class="fas fa-user-plus"></i> Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin/"><i class="fas fa-user-shield"></i> Admin</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap 5 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
