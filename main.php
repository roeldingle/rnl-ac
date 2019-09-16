<?php

require_once __DIR__ . '/vendor/autoload.php';

class Main{

	function __construct(){

		$account_id = 176953;
		$project_id = 1878;

		$data = array(
			'company' => 'Straightarrow Corporation',
			'app_name' => 'SA-RNL ActiveCollab automation',
			'email' => 'rmdingle@straightarrow.com.ph',
			'password' => 'rinoayuna12',
		);

		$authenticator = self::intializeAuth($data);
		$token = self::issueToken($authenticator, $account_id);
		$client = self::createClientInstance($token);
		

		if(isset($_POST['create'])){
			self::createProjectData($client, $project_id, 'discussions', $_POST);
		}

		include('./views/form.php');




	}

	private function intializeAuth($data){

		$authenticator = new \ActiveCollab\SDK\Authenticator\Cloud(
			$data['company'], 
			$data['app_name'], 
			$data['email'], 
			$data['password'],
			false
		);

 		return $authenticator->setSslVerifyPeer(false);

	}

	function getAccounts($authenticator){
		return $authenticator->getAccounts();
	}
	function getUser($authenticator){
		return $authenticator->getUser();
	}

	function issueToken($authenticator, $account_id){
		return $token = $authenticator->issueToken($account_id);
	}

	function createClientInstance($token){
		$client = new \ActiveCollab\SDK\Client($token);
        return $client->setSslVerifyPeer(false);
	}

	function getProjectData($client, $project_id, $type){
		return $client->get('projects/'.$id.'/'.$type.'')->getJson();
	}

	function createProjectData($client, $project_id, $type, $data){
		try {
		    $client->post('projects/'.$project_id.'/'.$type, $data);
		} catch(AppException $e) {
		    print $e->getMessage() . '<br><br>';
		    // var_dump($e->getServerResponse()); (need more info?)
		}
	}


}

new Main();

/*
 * This library is free software, and it is part of the Active Collab SDK project. Check LICENSE for details.
 *
 * (c) A51 doo <info@activecollab.com>
 */






// Show all Active Collab 5 and up account that this user has access to
// echo "<pre>";
// print_r($authenticator->getAccounts());

// Show user details (first name, last name and avatar URL)
// echo "<pre>";
// print_r($authenticator->getUser());

// Issue a token for account #123456789
// $token = $authenticator->issueToken(176953);

// if ($token instanceof \ActiveCollab\SDK\TokenInterface) {

//     print $token->getUrl() . "\n";
//     print $token->getToken() . "\n";

//     echo "valid";
// } else {
//     print "Invalid response\n";
//     die();
// }

// Create a client instance
// $client = new \ActiveCollab\SDK\Client($token);
// $client->setSslVerifyPeer(false);

// Make a request
// echo "<pre>";
// var_dump($client->get('projects/1878/discussions')->getJson());

// $client->post('projects/1878/discussions', [
//       'name' => 'This sample Jian arvin2',
//       'body' => 'This sample Jian arvinsdsddsdssddsd'
//     ]);
