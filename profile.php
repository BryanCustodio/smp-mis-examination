<?php include 'components/header.php'; ?>

<div class="container">
    <h2>User Profile</h2>
    <p>Name: <?php echo Session::get('name'); ?></p>
    <p>Email: <?php echo Session::get('email'); ?></p>
</div>
