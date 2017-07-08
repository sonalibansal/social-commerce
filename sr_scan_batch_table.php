<?php

use Aws\DynamoDb\Marshaler;

function scan_batch_table($post_id,$user_id)
{
	


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
		$post_id_string=(string)$post_id;

		$key = $marshaler->marshalJson
		('
			{
				"post_id": ' . $post_id . '
			}
		');




		$params = 
				[
						'TableName' => 'batch_table',
						'Key' =>$key,
						 'ExpressionAttributeNames'=> [ '#cnt' => 'count','#user'=>'Users' ],

						'ProjectionExpression' => 'post_id,#user,#cnt'
						
						
				];




		try 
		{
		
			
			$result = $dynamodb->getItem($params);
			
			
			if($result["Item"])
				{ 
					 update_item_for_batch_table($post_id,$user_id);
					 
					 $x=0;
					 return $x;
				}

			else
				
				{
					create_item_for_batch_table($post_id,$user_id);	
					
					$x=1;
					return $x;
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