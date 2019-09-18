<?php

require_once __DIR__ . '/vendor/autoload.php';

class Main{


	function intializeAuth($data){

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