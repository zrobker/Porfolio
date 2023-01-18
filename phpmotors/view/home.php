<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PHP Motors</title>
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
            // require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php';
            echo $navList;
            ?>
        </nav>
        <main>
            <h1>Welcome to PHP Motors!</h1>
            <section>
                <img class="car" src="/phpmotors/images/vehicles/delorean.jpg" alt="delorean car">
                <aside>
                    <h2>DMC Delorean</h2>
                    <ul>
                        <li>3 Cup holders</li>
                        <li>Superman doors</li>
                        <li>Fuzzy dice!</li>
                    </ul>
                    <a class="disappear1" href="#"><img src="/phpmotors/images/site/own_today.png" alt="Own today button"></a>
                </aside>
                <a class="disappear2" href="#"><img src="/phpmotors/images/site/own_today.png" alt="Own today button"></a>
            </section>
            <div>
                <section>
                    <h2>DMC Delorean Reviews</h2>
                    <ul>
                        <li>"So fast its almost like traveling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty Mcfly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (5/5)</li>
                        <li>"80's livin and I love it!" (5/5)</li>
                    </ul>
                </section>
                <section>
                    <h2>Delorean Upgrades</h2>
                    <div>
                        <figure>
                            <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux capacitor">
                            <figcaption><a href="#">Flux capacitor</a></figcaption>
                        </figure>
                        <figure>
                            <img src="/phpmotors/images/upgrades/flame.jpg" alt="flame">
                            <figcaption><a href="#">Flame Decals</a></figcaption>
                        </figure>
                        <figure>
                            <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper sticker">
                            <figcaption><a href="#">Bumper Stickers</a></figcaption>
                        </figure>
                        <figure>
                            <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub cap">
                            <figcaption><a href="#">Hub Caps</a></figcaption>
                        </figure>
                    </div>
                </section>
            </div>
        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
</body>
</html>