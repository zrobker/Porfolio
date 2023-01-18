<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Login | PHP Motors</title>
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
           <h1>Sign in</h1>
                <div class="message">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                       }
                    if (isset($message)) {
                    echo $message;
                    }
                    ?>
                </div>
                <form method="post" action="/phpmotors/accounts/" >
                    <label for="clientEmail">*Email:</label><br>
                    <input name="clientEmail" id="clientEmail" type="email" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>><br>
                    <label for="clientPassword">*Password:</label><br>
                    <input name="clientPassword" id="clientPassword" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required ><br>
                    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                    <input type="submit" name="submit" id="loginbtn" value="Sign in">
                    <input type="hidden" name="action" value="Login">
                    <a href="/phpmotors/accounts/index.php?action=registration"><p>Not a member yet?</p></a>
                </form> 
        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
</body>
</html>