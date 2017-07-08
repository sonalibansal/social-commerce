<?php
session_start();
//include "dynamodb_connect.php";
include 'database_S3_connect.php';
$user_check=$_SESSION['login_user'];
//$login_id=$_SESSION['login_id'];
$tableName="Friends";
$response = $dynamodb->query([
    'TableName' => $tableName,
    'IndexName' => 'User_name-index',
    'KeyConditionExpression' => '#dt = :v_dt',
    'ExpressionAttributeNames' => ['#dt' => 'User_name'],
    'ExpressionAttributeValues' => [
        ':v_dt' => ['S' => $user_check],
        //':v_precip' => ['N' => '0']
    ],
    'Select' => 'ALL_ATTRIBUTES',
    'ScanIndexForward' => true,
]);

foreach ($response['Items'] as $item)
{
	$login_session=$item['User_name']['S'];
   // $login_id=$item['User_id']['N'];
   $login_id=$_SESSION['login_id'];
}
if(!isset($login_session)){
header("location: login.php"); 
}
?>