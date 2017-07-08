<?php
session_start();
$error='';

include "dynamodb_connect.php";


if(isset($_POST['check']))

{
     if(empty($_POST['uname'])|| empty($_POST['psw']))
        $error="User name or password is invalid ";
    else
    {
  $UserName = $_POST['uname'];
	$user_name=$_POST['uname'];
	$password=$_POST['psw'];
	$tableName = 'Friends';

    $response = $dynamodb->query([
    'TableName' => $tableName,
    'IndexName' => 'User_name-index',
    'KeyConditionExpression' => '#dt = :v_dt',
    'ExpressionAttributeNames' => ['#dt' => 'User_name'],
    'ExpressionAttributeValues' => [
        ':v_dt' => ['S' => $user_name],
        //':v_precip' => ['N' => '0']
    ],
    'Select' => 'ALL_ATTRIBUTES',
    'ScanIndexForward' => true,
]);

foreach ($response['Items'] as $item)
{
if($item['Password']['S']==$password)
{
	//echo "successfully logged in ";
    $_SESSION['login_user']=$user_name;
    $_SESSION['login_id']=$item['User_id']['N'];
    $_SESSION["username"]=$UserName;
    $_SESSION["password"]=$password;
   // echo $_SESSION['User_id'];
    header("location:home_final.php");
}
else
	$error="wrong login information ";
}
}
}
?>
