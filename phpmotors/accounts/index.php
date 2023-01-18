<?php
// This is the accounts controller

//Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';
// Get the PHP Reviews model for use as needed
require_once '../model/reviews-model.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a nav bar using $classifications array
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'login':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'admin':
        include '../view/admin.php';
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS))  ;
        
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        //check for existing email
        $existingEmail = checkExistingEmail($clientEmail);

        // Deal with existing email during registration 
        if($existingEmail){
        $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
        include '../view/login.php';
        exit;
        }

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
        }

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

        // Check and report the result
        if($regOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'Login':
        // Filter and store the data
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS))  ;
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);



        // Check for missing data
        if(empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit; 
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if($hashCheck) {
            $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        $clientId = $clientData['clientId'];

        $reviews = getReviewsByClient($clientId);
        if(!count($reviews)){
            $message = "<p class='notice'>Sorry, no reviews could be found.</p>";
        } else {
            $message = "<p class='notice'>Thanks for writing a review! </p>";
            $_SESSION['reviewDisplay'] = buildClientReviewsDisplay($reviews);
            
        }   
        include '../view/admin.php';
        exit;
        break;
    case 'Logout':
        unset($_SESSION['clientData']);
        session_destroy();
        include '../index.php';
        break;
    case 'edit':
        $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);
        $invInfo = getClientInfo($clientId);
        if(count($_SESSION['clientData'])<1){
            $message = 'Sorry, no client information could be found.';
        }
        include '../view/client-update.php';
        exit;
        break;
    case 'updateInfo':
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
 
        $clientEmail = checkEmail($clientEmail);

        // Check to see if clientEmial is the same as session email if not check to see if email is already used in database \
        if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
             //check for existing email
            $existingEmail = checkExistingEmail($clientEmail);
            if($existingEmail){
                $message1 = '<p class="notice">That email address already exists.</p>';
                include '../view/client-update.php';
                exit;
            }
        }
    

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message1 = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }

        // Send the data to the model
        $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Check and report the result
        if($updateResult === 1){
            $message = "<p>Thanks $clientFirstname, your information has been updated.</p>";
            $_SESSION['message'] = $message;
            $clientData = getClientInfo($clientId);
            $_SESSION['clientData'] = $clientData;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message1 = "<p>Sorry, but the update of your account has failed. Please try again. (Make sure you change at least one field)</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    case 'updatePassword':
        // Filter and store the data
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        $checkPassword = checkPassword($clientPassword);
    
        // Check for missing data
        if(empty($checkPassword)){
            $message2 = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }

        // Send the data to the model
        $updateResult = updateClientpassword($clientPassword, $clientId);

        // Check and report the result
        if($updateResult === 1){
            $currentFirstname = $_SESSION['clientData']['clientFirstname'];
            $message = "<p>Thanks $currentFirstname, your password has been updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message2 = "<p>Sorry, but the update of your account has failed. Please try again. (Make sure you change at least one field)</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    default:
        include '../view/admin.php';
}