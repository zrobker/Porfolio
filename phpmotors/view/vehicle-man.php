<?php

if(isset($_SESSION['loggedin']) ==NULL || $_SESSION['clientData']['clientLevel'] <= 1) { 
    header('location: /phpmotors/');
    exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css">
</head>
<body>
    <img src="/phpmotors/images/site/small_check.jpg" alt="">
    <div class="content">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';?>
        </header>
        <nav>
            <?php 
            echo $navList;
            ?>
        </nav>
        <main>
            <h1>Vehicle Management</h1>
            <div class="message">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </div>
            <a href="/phpmotors/vehicles/index.php?action=classification"><p>Add Classification</p></a>
            <a href="/phpmotors/vehicles/index.php?action=vehicle"><p>Add Vehicle</p></a>
            <?php
            if (isset($message)) { 
                echo $message; 
            } 
            if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
            }
            ?>
            <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>    
</body>
</html>
<?php unset($_SESSION['message']); ?>