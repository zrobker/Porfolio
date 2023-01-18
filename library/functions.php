<?php

//Various functions are stored here

function checkEmail($clientEmail){
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }

function checkStock($invStock){
    $valStock = filter_var($invStock, FILTER_VALIDATE_INT);
    if ($valStock >= 1) {
        return $valStock;
    }
    else return "";
}

function checkClassificationName ($classificationName) {
    if (strlen($classificationName) > 30) {
        return "";
    }
    else return $classificationName;
}

function buildNavigation($classifications) {
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View 
    the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classifications&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
}

//build display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetail&invId=".urlencode($vehicle['invId'])."'</a>";
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $dv .= '</a>';
     $dv .= "<span>$vehicle[invPrice]</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
   }

//build display of more detailed vehicle information
function buildVehicleDetailDisplay($invInfo){
    $usd = "$" . number_format($invInfo['invPrice'], 2, ".", ",");
    $dv = '<div id="vehicle-display">';
    $dv .='<div class="left-info">';
    $dv .= "<img src='$invInfo[invImage]' alt='Image of $invInfo[invMake] $invInfo[invModel] on phpmotors.com'>";
    $dv .= "<h2>Price: ";
    $dv .= "$usd";
    $dv .= '</h2>';
    $dv .= '</div>';
    $dv .= '<div class="right-info">';
    $dv .= "<h2>$invInfo[invMake] $invInfo[invModel] Details</h2>";
    $dv .= '<ul>';
    $dv .= "<li>$invInfo[invDescription]</li>";
    $dv .= "<li>Color: $invInfo[invColor]</li>";
    $dv .= "<li># in Stock: $invInfo[invStock]</li>";
    $dv .=  '</ul>';
    $dv .=  '</div>';
    $dv .= '</div>';
    return $dv;
}

//build display of reviews within an unordered list
function buildReviewsDisplay($reviews){
    $dv = '<section id="review-display">';
    foreach ($reviews as $review) {
        // $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetail&invId=".urlencode($review['reviewId'])."'</a>"; 
    $dv .= "<br><p> $review[reviewText] on $review[reviewDate]</p>";
    $dv .= "<br>";
    }
    $dv .= '</section>';
    return $dv;
}

//build display of reviews within an unordered list
function buildClientReviewsDisplay($reviews){
    $dv = '<section id="review-display">';
    foreach ($reviews as $review) {
        $reviewId = $review['reviewId'];
        echo $reviewId;
        // $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetail&invId=".urlencode($review['reviewId'])."'</a>"; 
        $dv .= "<br><p> $review[reviewText] on $review[reviewDate])</p>";
        $dv .= "<a href='/phpmotors/reviews?action=mod&reviewId=$reviewId' title='Click to modify'>Modify </a>";
        $dv .= "<a href='/phpmotors/reviews?action=del&reviewId=$reviewId' title='Click to delete'> Delete</a>";
        $dv .= "<br></section>";
    }

    return $dv;
}

