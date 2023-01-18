<?php

if(isset($_SESSION['loggedin']) ==NULL || $_SESSION['clientData']['clientLevel'] <= 1) { 
    header('location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Classification | PHP Motors</title>
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
            <h1>Add Car Classification</h1>
                <div class="message">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </div> 
                <form method="post" action="/phpmotors/vehicles/index.php">
                    <label for="classificationName">*Classification Name:</label><br>
                    <input name="classificationName" id="classificationName" type="text" maxlength="30" required><br>
                    <span>Classification name limited to 30 characters or less.</span>
                    <input type="submit" name="submit" id="regbtn" value="Add Classification">
                    <input type="hidden" name="action" value="regClassification">
                </form> 
        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
</body>
</html>