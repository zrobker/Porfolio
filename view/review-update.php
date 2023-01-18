<?php

if(isset($_SESSION['loggedin']) ==NULL) { 
    header('location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review | PHP Motors</title>
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
        <h1>
            Review Update
        </h1>
                <div class="message">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <form method="post" action="/phpmotors/reviews/">

               

                <label for="reviewText">Review</label>
                <textarea name="reviewText" id="reviewText"><?php if(isset($reviewInfo['reviewText'])) {echo $reviewInfo['reviewText']; }?></textarea>

            <input type="submit" class="regbtn" name="submit" value="Edit Review">

                <input type="hidden" name="action" value="updateReview">
                <input type="hidden" name="reviewId" value="<?php if(isset($reviewInfo['reviewId'])){echo $reviewInfo['reviewId'];} elseif(isset($currentId)){ echo $currentId; } ?>">

                </form>
        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
</body>
</html>