<?php
// This is the reviews controller

//Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/reviews-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a nav bar using $classifications array
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
}

// 1. Add a new review
// 2. Deliver a view to edit a review.
// 3. Handle the review update.
// 4. Deliver a view to confirm deletion of a review.
// 5. Handle the review deletion.
// 6. A default that will deliver the "admin" view if the client is logged in or the
// php motors home view if not.


switch ($action){
    case 'regReview':
        // Filter and store the data
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $reviewScreenName = trim(filter_input(INPUT_POST, 'reviewScreenName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        

        // Check for missing data
        if(empty($reviewText) || empty($reviewScreenName) || empty($invId) || empty($clientId)){
            $message = '<p>Please add a review.</p>';
            include '../view/vehicle-detail.php';
            exit; 
        }

        $reviewText .= " -";
        $reviewText .= $reviewScreenName;
        // Send the data to the model
        $regOutcome = regReview($reviewText, $invId, $clientId);

        // Check and report the result
        if($regOutcome === 1){
            $message = "<p>Thanks, for leaving a review!</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/vehicles/?action=vehicleDetail&invId='$invId'");
            exit;
        } else {
            $_SESSION['message'] = $message;
            $message = "<p>Sorry, processing your review has failed. Please try again.</p>";
            header("Location: /phpmotors/vehicles/?action=vehicleDetail&invId='$invId'");
            exit;   
        }
        break; 
    case 'mod':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewInfo = getReviewItemInfo($reviewId);
        if(count($reviewInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/review-update.php';
        exit;
        break;
    case 'updateReview':
        // Filter and store the data
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        
        // Check for missing data
        if(empty($reviewText)){  
            $message = '<p>Please write a review.</p>';
            include '../view/review-update.php';
            exit; 
        }

        // Send the data to the model
        $updateResult = updateReview($reviewText, $reviewId);

        // Check and report the result
        if($updateResult === 1){
            $message = "<p>Thanks, your review has been updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;
        } else {
            $message = "<p>Sorry, but the update of your review has failed. Please try again.</p>";
            include '../view/review-update.php';
            exit;
        }
        break;
    case 'del':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewInfo = getReviewItemInfo($reviewId);
        if (count($reviewInfo) < 1) {
            $message = 'Sorry, no review information could be found.';
        }
        include '../view/review-delete.php';
        exit;
        break; 
    case 'deleteReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        
        $deleteResult = deleteReview($reviewId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, your review was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;
        } else {
            $message = "<p class='notice'>Error: Your review was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews');
            exit;
        }
        break;
    default:
        if (isset($_SESSION['loggedin'])) {
            include '../view/admin.php';
        } else {
            include '../view/home.php';
        }
}