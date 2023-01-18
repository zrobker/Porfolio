<?php
if ($_SESSION['loggedin'] != 1) {
    header("location:../index.php");
}
$currentFirstname = $_SESSION['clientData']['clientFirstname'];
$currentLastname = $_SESSION['clientData']['clientLastname'];
$currentEmail = $_SESSION['clientData']['clientEmail'];
$currentId = $_SESSION['clientData']['clientId'];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management | PHP Motors</title>
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
        <h1>Manage Account</h1> 
            <h2>Update Account</h2>
            <div class="message">
                <?php
                if (isset($message1)) {
                    echo $message1;
                }
                ?>
            </div>
            <form method="post" action="/phpmotors/accounts/index.php">
                <label for="clientFirstname">First name:</label><br>
                <input name="clientFirstname" id="clientFirstname" type="text" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($currentFirstname)) {echo "value='$currentFirstname'"; } ?>><br>
                <label for="clientLastname">Last name:</label><br>
                <input name="clientLastname" id="clientLastname" type="text" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($currentLastname)) {echo "value='$currentLastname'"; } ?>><br>
                <label for="clientEmail">Email:</label><br>
                <input name="clientEmail" id="clientEmail" type="email" placeholder="Enter a valid email address" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($currentEmail)) {echo "value='$currentEmail'"; } ?>><br><br>
                <input type="submit" name="submit" class="regbtn" value="Update Info">
                <input type="hidden" name="action" value="updateInfo">
                <input type="hidden" name="clientId" value="<?php if (isset($clientData['clientId'])){ echo$clientData['clientId'];} elseif(isset($currentId)){ echo $currentId; } ?>">
            </form> <br>
            <h2>Update Password</h2>
            <div class="message">
                <?php
                if (isset($message2)) {
                    echo $message2;
                }
                ?>
            </div>
            <form method="post" action="/phpmotors/accounts/index.php">   
                <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                <span>*note your original password will be changed.</span><br>
                <label for="clientPassword">Password:</label><br>
                <input name="clientPassword" id="clientPassword" type="password"  required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" ><br><br>
                <input type="submit" name="submit" class="regbtn" value="Update Password">
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" value="<?php if (isset($clientData['clientId'])){ echo$clientData['clientId'];} elseif(isset($currentId)){ echo $currentId; } ?>">
            </form>
        </main>
        <footer> 
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
</body>
</html>