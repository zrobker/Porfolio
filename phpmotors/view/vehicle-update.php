<?php

if(isset($_SESSION['loggedin']) ==NULL || $_SESSION['clientData']['clientLevel'] <= 1) { 
    header('location: /phpmotors/');
    exit;
}
// Creates list of classifications with id for drop-down selector
$classificationList = '<select name="classificationId" id="classificationId" required>';
foreach ($classifications as $classification) {
    $cn = "$classification[0]";
    $cid = "$classification[1]";
    $classificationList .= "<option value='$cid'";
    if(isset($classificationId)){
        if($cid === $classificationId){
            $classificationList .= ' selected ';
        }
    } elseif(isset($invInfo['classificationId'])){
        if($cid === $invInfo['classificationId']){
        $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$cn</option>";
}
$classificationList .= '</select><br><br>';

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
        elseif(isset($invMake) && isset($invModel)) { 
		    echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
            <?php 
            if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
            elseif (isset($invMake) && isset($invModel)) { 
                echo "Modify$invMake $invModel"; }
            ?>
        </h1>
            <p>*All Fields Required</p>
                <div class="message">
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <form method="post" action="/phpmotors/vehicles/index.php">
                    <label for="classificationId">Choose Car Classification:</label>
                    <?php 
                    echo $classificationList;
                    ?>
                    <label for="invMake">Make:</label><br>
                    <input name="invMake" id="invMake" type="text" required <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?>><br>
                    <label for="invModel">Model:</label><br>
                    <input name="invModel" id="invModel" type="text" required <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?>><br>
                    <label for="invDescription">Description</label><br>
                    <textarea name="invDescription" id="invDescription" cols="25" rows="3" required><?php if(isset($invDescription)){echo"$invDescription";}elseif(isset($invInfo['invDescription'])){echo $invInfo['invDescription']; } ?></textarea><br>
                    <label for="invImage">Image Path:</label><br>
                    <input name="invImage" id="invImage" value="/phpmotors/images/no-image.png" type="text" required <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } ?>><br>
                    <label for="invThumbnail">Thumbnail Path:</label><br>
                    <input name="invThumbnail" id="invThumbnail" value="/phpmotors/images/no-image.png" type="text" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } ?>><br>
                    <label for="invPrice">Price:</label><br>
                    <input name="invPrice" id="invPrice" type="number" required <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } ?>><br>
                    <label for="invStock"># In Stock:</label><br>
                    <input name="invStock" id="invStock" type="number" min="1" required <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; } ?>><br>
                    <label for="invColor">Color:</label><br>
                    <input name="invColor" id="invColor" type="text" required <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?>><br><br>
                    <input type="submit" name="submit" id="regbtn" value="Update Vehicle">
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])){ echo$invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
                </form>
        </main>
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
</body>
</html>