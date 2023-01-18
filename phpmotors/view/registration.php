<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Registration | PHP Motors</title>
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
        <h1>Register</h1> 
            <div class="message">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </div>
            <form method="post" action="/phpmotors/accounts/index.php">
                <label for="clientFirstname">*First name:</label><br>
                <input name="clientFirstname" id="clientFirstname" type="text" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>><br>
                <label for="clientLastname">*Last name:</label><br>
                <input name="clientLastname" id="clientLastname" type="text" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>><br>
                <label for="clientEmail">*Email:</label><br>
                <input name="clientEmail" id="clientEmail" type="email" placeholder="Enter a valid email address" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>><br>
                <label for="clientPassword">*Password:</label><br>
                <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
                <input name="clientPassword" id="clientPassword" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br><br>
                <input type="submit" name="submit" id="regbtn" value="Register">
                <input type="hidden" name="action" value="register">
            </form>
        </main>
        <footer> 
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
</body>
</html>