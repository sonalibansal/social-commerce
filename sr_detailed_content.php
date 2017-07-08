<?php

require'aws.phar'; 
use Aws\DynamoDb\Marshaler;
use Aws\DynamoDb\Exception\DynamoDbException;

function get_item_updates($post_id,$User_id)
{
		//echo "inside get_item_updates";
		$credentials = new Aws\Credentials\Credentials('AKIAJBGRY3QUTI4OAIHQ ', 'jnulLVt3+5GL6sAH1yNNRCtBCPg9A6wiZn1UpAIS');

		$sdk1 = new Aws\Sdk([
		        'region'   => 'ap-south-1',
		        'version'  => 'latest',
				'credentials'=>$credentials,
		        'http'    => [
		            'verify' => 'C:\xampp\php\cacert.pem'
		          ]
		    ]);



		$dynamodb1 = $sdk1->createDynamoDb();
		
		$marshaler1 = new Marshaler();

		$post_id_string=(string)$post_id;
		$User_id_string=(string)$User_id;
		




		$params = 
				[
						'TableName' => 'updates',
						'Key' => [
						 		    'post_id'=>['N'=>$post_id_string],
						     		'User_id'=>['N'=>$User_id_string]
								],

						'ProjectionExpression' => 'post_id,User_id,updated_time,User_name',

						
						
				];




		try 
		{
		
			
			$result = $dynamodb1->getItem($params);
						
			if($result["Item"])
				{ 
					 
					 
					 return $result['Item'];
				}

			
		} 	

		catch (DynamoDbException $e) 
		{
			echo "Unable to get item:\n";
			echo $e->getMessage() . "\n";
			return -1;
		}


}

//echo "inside details";


$sdk = new Aws\Sdk
    ([
    'region' => 'ap-south-1',
    'version' => 'latest',
    'http'    => [
            'verify' => 'C:\xampp\php\cacert.pem'
           ],
    'credentials' => [
              'key'    => 'AKIAIAKDEIXMBH3MLVJQ',
              'secret' => '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',
            ]
    ]);

    


	
		$dynamodb = $sdk->createDynamoDb();
		$marshaler = new Marshaler();
		$post_id_string=(string)$_POST['post_id'];
		
		$key = $marshaler->marshalJson
		('
			{
				"post_id": ' . $post_id_string . '
			}
		');


		$params = 
				[
						'TableName' => 'batch_table',
						'Key' => $key,
						 'ExpressionAttributeNames'=> [ '#cnt' => 'count','#user'=>'Users' ],

						'ProjectionExpression' => 'post_id,#user,#cnt'
						
						
				];




		try 
		{
		
			
			$result = $dynamodb->getItem($params);
			$n=count($result['Item']['Users']['NS']);
			if($n==1)

			{


				 echo "post id: ".$_POST['post_id']."<br>";
				 echo "user id: " .$_POST['User_id']."<br>";
				 echo "user name: " .$_POST['User_name']."<br>"; 
				 echo "updated time : " .$_POST['updated_time']."<br>";
				 if($_POST['post_type']!='Contributed'&& $_POST['post_type']!='Liked'&&$_POST['post_type']!='Polled')
				 {
				 		echo "Reaction: " ."rated with score of :".$_POST['post_type']."<br>";
				 }
				 else 
				 	echo "Reaction: " .$_POST['post_type']."<br>";
				 echo "content of post: " .$_POST['content']."<br>";


			}

			else
			 {
				
			 	echo "post id: ".$_POST['post_id']."<br>";
			 	echo "type of post: " .$_POST['post_type']."<br>";
				echo "content of post: " .$_POST['content']."<br><br>";

				for($m=0;$m<$n;$m=$m+1)
									
							{			$user=$result['Item']['Users']['NS'][$m];
										$str=get_item_updates($_POST['post_id'],$user);
															
										echo "user id: " .$user." --> ";
										echo "user name: " .$str['User_name']["S"]." ,"; 
										echo "updated time : " .$str['updated_time']["S"]."<br><br>";
										 
										
							}

			
			 }
			
		} 	

		catch (DynamoDbException $e) 
		{
			echo "Unable to get item:\n";
			echo $e->getMessage() . "\n";
			return -1;
		}





	//$str=get_item_updates();



?>
