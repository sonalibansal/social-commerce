<?php
//include 'dynamodb_connect.php';
$cat=array();
//$val="apple";
include 'session.php';

if(!empty($_POST['check_list'])) {
    foreach($_POST['check_list'] as $check) {
        array_push($cat,$check);
            echo $check."<br/>"; 
    }
    print_r($cat);
    //echo $cat[1];
    try{
            
            $response = $dynamodb->updateItem([
            'TableName' => 'Friends',
            'Key' => [
                'User_id' => ['N' =>$login_id]
            ],

            'ExpressionAttributeValues' => [
                ':val1' => ['SS' => $cat]
            ] ,
            'UpdateExpression' => 'Add liked_categories:val1',  
                'Condition-expression'=>['NOT(:val1 IN liked_categories)'],
				
				'ReturnValues' => 'ALL_NEW'

        ]);

        //print_r($response['Attributes']);
            echo "successfully updated item \n";
    }
    catch (DynamoDbException $e) 
    {
        echo "Unable to get item:\n";
        echo $e->getMessage() . "\n";
    }
}
?>
<html>
 
 <head><title>post created</title></head>
 <body>

     <a href="home_final.php">Go back to the home page</a>
 </body>
 </html>