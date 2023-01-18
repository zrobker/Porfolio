<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $makeModel; ?> | PHP Motors, Inc.</title>
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
            <p>Vehicle reviews can be found at the bottom of this page.</p>
            <?php
                if (isset($_SESSION['loggedin']) ==TRUE) {
                    if(isset($message)){echo $message; }
                }
            ?>
            <h1><?php echo $makeModel; ?></h1>
            <?php if(isset($vehicleDisplay)){echo $vehicleDisplay;} ?>
            <h2>Add your review</h2>
            <?php 
                if (isset($_SESSION['loggedin'])) {
                    $currentFirstName = $_SESSION['clientData']['clientFirstname'];
                    $currentLastName = $_SESSION['clientData']['clientLastname'];
                    $currentClientId = $_SESSION['clientData']['clientId'];
                    $reviewScreenName =substr($currentFirstName,0,1);
                    $reviewScreenName .= $currentLastName;
                    echo "<form method='post' action='/phpmotors/reviews/index.php'>
                    <input name='reviewScreenName' id='reviewScreenName' type='text' required value='$reviewScreenName' readonly><br>
                    <label for='reviewText'>Review</label><br>
                    <textarea name='reviewText' id='reviewText' cols='25' rows='3' required></textarea><br>
                    <input type='submit' name='submit' id='regbtn' value='Add Review'>
                    <input type='hidden' name='invId' value='$invId'>
                    <input type='hidden' name='clientId' value='$currentClientId'>
                    <input type='hidden' name='action' value='regReview'>
                    </form>";
            }   else {
                    echo '<p>You can only leave a review after <a href= "/phpmotors/accounts/index.php?action=login">logging in.</a></p>';
            }
            ?>
            <h2>Customer Reviews</h2>
            <?php 
                if(isset($reviewDisplay)){
                    echo $reviewDisplay;
                } else {
                    echo "<p class='notice'>Sorry there are no reviews at this time.</p>";
                }
            ?>
        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
</body>
</html> 