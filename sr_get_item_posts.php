<?php
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

function get_item_posts($post_id)
{
		
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

		$key = $marshaler1->marshalJson
		('
			{
				"post_id": ' . $post_id . '
			}
		');





		$params = 
				[
						'TableName' => 'post',
						'Key' =>$key,
						'ProjectionExpression' => 'post_id,content,User_id'
						
						
				];




		try 
		{
		
			
			$result = $dynamodb1->getItem($params);
			//$login_id='7';
			
			if($result["Item"])
				{ 
					 
					  return $result['Item']['content']['S'];
					 
				}

			
		} 	

		catch (DynamoDbException $e) 
		{
			echo "Unable to get item:\n";
			echo $e->getMessage() . "\n";
			return -1;
		}


}



?>