<?php

use Aws\DynamoDb\Marshaler;
function create_item_for_batch_table($post_id, $user_id)

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

	
	$count = 1;
	
	$user_id_string= (string)$user_id;
	$count_string= (string)$count;
	$post_id_string= (string)$post_id;
	
	try 
	{
		$response = $dynamodb->putItem
				([
			    
			    'TableName' => 'batch_table',
			    'Item' => 
			    	[
			        'post_id'  => ['N'   => $post_id_string   ], // Hash Key
			        'count'    => ['N'   => $count_string     ],
			        'Users'    => ['NS'  => [$user_id_string] ]
			        ]
				]);
					
		
	} 
	catch (DynamoDbException $e) 
	{
		
		echo "Unable to add item:\n";
		
		echo $e->getMessage() . "\n";


	}

    

}

?>