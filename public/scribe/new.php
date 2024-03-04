<?php

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Exception\RequestException;

require_once dirname(__DIR__, 2) . "/globals.php";

$userEmail = sqlQuery("SELECT email FROM users WHERE id = ?", [$_SESSION['authUserID']]);
if (empty($userEmail['email'])) {
    echo "Add providers email address to the address book, then try again.";
    exit;
}
$client = new Client();
$url = "https://api.affordablecustomehr.com/stripe/resources/connection/api.php?email=" . $userEmail['email'];
$promises = [];
$numRequests = 1;

for ($i = 0; $i < $numRequests; $i++) {
    $promises[] = $client->getAsync($url)->then(
        function ($response) {
            return $response;
        },
        function (RequestException $e) {
            return $e->getResponse();
        }
    );
}
$settle = new Promise\Utils();
$responses = $settle::settle($promises)->wait();

foreach ($responses as $response) {
    if ($response['state'] === 'fulfilled') {
        $response = $response['value'];
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
            header("Location: https://main.dmivm9vuczwwz.amplifyapp.com/");
            exit;
        } else {
            echo "<a href=$_GLOBAL[site_root]'../../modules/custom_modules/oe-module-aws-healthscribe/public/index.php'>No payment method on file</a>";
        }
    } else {
        echo "what else";
        $response = $response['reason'];
        if ($response instanceof \Exception) {
            echo "Request failed: " . $response->getMessage() . "\n";
        } else {
            echo "Request failed: " . $response . "\n";
        }
    }
}
