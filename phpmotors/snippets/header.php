<a href="/phpmotors/index.php"><img src="/phpmotors/images/site/logo.png" alt="logo for php motors"></a>
<?php 
    if (isset($_SESSION['loggedin'])) {
        $currentFirstname = $_SESSION['clientData']['clientFirstname'];
        echo "<div><a href='/phpmotors/accounts/index.php?action=admin'><h1>Welcome $currentFirstname | </h1></a><a href='/phpmotors/accounts/index.php?action=Logout'><h1>&nbsp;Logout</h1></a></div>";
}   else {
        echo '<a href="/phpmotors/accounts/index.php?action=login"><h1> My Account</h1></a>';
}

?>