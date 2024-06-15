<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('609256922927-dfc25un9v5rlpdro0v22qb5ctab9itdf.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://www.sid.free.nf/logingoogle.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');
