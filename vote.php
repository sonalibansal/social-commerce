<?php
include 'session.php';
//require_once 'dynamodb_connect.php';
    
if(isset($_POST["id"]))
{
	
    $post=$_POST["id"];
    $reaction_value=$_POST["reaction"];
	date_default_timezone_set('Asia/Kolkata');
$date = date('D-M/d/Y h:i:s A', time());

$tableName="updates";

    $params = [
	'TableName' => $tableName,
	'Key' => [
    'post_id'=>['N'=>$post],
     'User_id'=>['N'=>$login_id]
]
    
];
     try 
{
	$result = $dynamodb->getItem($params);
	echo "successfully executed getitem operation \n";
} 	

catch (DynamoDbException $e) 
{
	echo "Unable to get item:\n";
	echo $e->getMessage() . "\n";
}

 if(!$result['Item'])
           {
             
			try {
                 $response = $dynamodb->putItem(array(
             'TableName' =>$tableName,
              'Item' => array(
                  'post_id' => array( 'N' =>$_POST["id"]), // Primary Key
                  'Reaction_value' => array('S' =>$reaction_value ),
                  'User_id' => array('N' =>$login_id ),
                  'User_name' => array('S' => $login_session),
                  'updated_time'=>array('S' => $date ),
           
              ),  

           ));
          
            echo "Added item\n";

        }
               catch (DynamoDbException $e) {
            echo "Unable to add item:\n";
            echo $e->getMessage() . "\n";
        }
               
               
               
               
               
     $tableName="count"; 
     $params1 = [
	'TableName' =>$tableName,
	'Key' => [
    'post_id'=>['N'=>$post]

]];
     try 
{
	$result1 = $dynamodb->getItem($params1);
    echo "hi cs \n";
	
} 	

catch (DynamoDbException $e) 
{
	echo "Unable to get item:\n";
	echo $e->getMessage() . "\n";
}
    
    if(!$result1['Item'])
    {
         $response1 = $dynamodb->putItem(array(
             'TableName' =>"count",
              'Item' => array(
                  'post_id' => array( 'N' =>$post),
                    'reaction_count'=>array('N'=>"1")
                 
              )

           ));
    }
    else
    {
        //$totalvotes=$_POST["votes"]+1;
        try{
            
            $response = $dynamodb->updateItem([
            'TableName' => 'count',
            'Key' => [
                'post_id' => ['N' =>$post]
            ],

            'ExpressionAttributeValues' => [
                ':val1' => ['N' => "1"]
            ] ,
            'UpdateExpression' => 'set reaction_count=reaction_count  + :val1',  
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
        

}
    else
        echo "already voted \n";
  
}

		
?>