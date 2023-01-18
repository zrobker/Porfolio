<?php
if ($_SESSION['loggedin'] != 1) {
    header("location:../index.php");
}
$currentFirstname = $_SESSION['clientData']['clientFirstname'];
$currentLastname = $_SESSION['clientData']['clientLastname'];
$currentEmail = $_SESSION['clientData']['clientEmail'];
$currentLevel = $_SESSION['clientData']['clientLevel'];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | PHP Motors</title>
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
            <h1><?php echo "$currentFirstname $currentLastname";?></h1>
            <div class="message">
            <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    }
                ?>
            </div>
            <p>You are logged in.</p>
            <ul>
                <li>First name: <?php echo $currentFirstname ?></li>
                <li>Last name: <?php echo $currentLastname ?></li>
                <li>Email: <?php echo $currentEmail ?></li>
            </ul>
            <h2>Account Management</h2>
            <p>Use this link to update account information.</p>
            <a href="/phpmotors/accounts/index.php?action=edit">Update Account information</a><br>
            <h2>Review Management</h2>
            <p>You can edit and delete reviews here.</p>
            <?php 
                if(isset ($_SESSION['reviewDisplay'])){
                    echo $_SESSION['reviewDisplay'];
                } else {
                    echo "<p class='notice'>Sorry there are no reviews at this time.</p>";
                }


                if ($currentLevel > 1) {
                    echo "<h2>Inventory Management</h2>";
                    echo "<p>Use this link to manage the inventory.</p>";
                    echo '<a href="/phpmotors/vehicles/index.php?action=management"><p>Vehicle Management</p></a>';
                } 
            ?>
        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
</body>
</html> 
<?php unset($_SESSION['message']); ?>