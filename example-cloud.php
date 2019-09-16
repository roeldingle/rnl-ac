<?php

/*
 * This library is free software, and it is part of the Active Collab SDK project. Check LICENSE for details.
 *
 * (c) A51 doo <info@activecollab.com>
 */

require_once __DIR__ . '/vendor/autoload.php';

$authenticator = new \ActiveCollab\SDK\Authenticator\Cloud('Straightarrow Corporation', 'My Awesome Application', 'rmdingle@straightarrow.com.ph', 'rinoayuna12',false);
$authenticator->setSslVerifyPeer(false);


// Show all Active Collab 5 and up account that this user has access to
echo "<pre>";
print_r($authenticator->getAccounts());

// Show user details (first name, last name and avatar URL)
echo "<pre>";
print_r($authenticator->getUser());

// Issue a token for account #123456789
$token = $authenticator->issueToken(176953);

if ($token instanceof \ActiveCollab\SDK\TokenInterface) {

    print $token->getUrl() . "\n";
    print $token->getToken() . "\n";

    echo "valid";
} else {
    print "Invalid response\n";
    die();
}

// Create a client instance
$client = new \ActiveCollab\SDK\Client($token);
$client->setSslVerifyPeer(false);

// Make a request
// echo "<pre>";
// var_dump($client->get('projects/1878/discussions')->getJson());

$client->post('projects/1878/discussions', [
      'name' => 'This sample Jian arvin2',
      'body' => 'This sample Jian arvinsdsddsdssddsd'
    ]);
