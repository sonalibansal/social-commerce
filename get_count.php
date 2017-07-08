<?php 
require 'dynamodb_connect.php';
if(isset($_POST['id']))
{
    $post=$_POST['id'];
    $n_votes=" ";
    $params = [
	'TableName' => 'count',
	'Key' => [
    'post_id'=>['N'=>$post],
             //'User_id'=>['N'=>$login_id]

       ] ];
    
    
    try{  $get_count1=$dynamodb->getItem($params)  ;
        echo "successfully got the count of votes";
        
       }

        catch (DynamoDbException $e) 
        {
            echo "Unable to get the count of items:\n";
            echo $e->getMessage() . "\n";
        }
    
    if(!$get_count1['Item'])
    { $n_votes=0;
    echo  $n_votes;}
     else
     {
         $n_votes=$get_count1['Item']["reaction_count"]["N"];
         echo  $n_votes;
     }
   
   
    
   // echo  $n_votes;
}

    
?>