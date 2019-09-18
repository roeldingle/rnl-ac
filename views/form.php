<?php
require_once('../main.php');



$account_id = 176953;
$project_id = 1878;

$data = array(
	'company' => 'Straightarrow Corporation',
	'app_name' => 'SA-RNL ActiveCollab automation',
	'email' => 'rmdingle@straightarrow.com.ph',
	'password' => 'rinoayuna12',
);

$oMain = new Main();

$authenticator = $oMain->intializeAuth($data);
$token = $oMain->issueToken($authenticator, $account_id);
$client = $oMain->createClientInstance($token);


if(isset($_POST['create'])){
	$oMain->createProjectData($client, $project_id, 'discussions', $_POST);
}



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		<input type="text" name="name">
		<input type="text" name="body">
		<input type="submit" name="create" value="Submit">
	</form>

</body>
</html>