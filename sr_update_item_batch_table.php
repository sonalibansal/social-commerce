<?php

use Aws\DynamoDb\Marshaler;
function update_item_for_batch_table($post_id,$user_id)
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
		
		$tableName = 'batch_table';
		$post_id_string=(string)$post_id;
		$user_id_string=(string)$user_id;	

		
		
		$params = 
		[
				'TableName' => $tableName,
				
				'ExpressionAttributeNames'=> [ '#count' => 'count','#Users'=>'Users' ],
				'ProjectionExpression' => 'post_id',
				'Key' =>
				 [
			        	'post_id' =>
			        	 [
			            	'N' => $post_id_string
			        	 ]
			     ],

			    
				
				'ExpressionAttributeValues' =>
				 [
        			':val1' => ['N' => '1'],
        			':val2' =>['NS'=>[$user_id_string]]
        			        			
    			 	
    			 ] ,
				
				//'UpdateExpression' =>'SET #count= #count+ :val1 ,#Users = list_append(if_not_exists(#Users, :empty_list), :val2)',
				'UpdateExpression' =>'SET #count= #count+ :val1 ADD #Users :val2 ',
				//'ConditionExpression'=>'contains (batch_table.#Users, :val3)="true"' ,
				
				'ReturnValues' => 'ALL_NEW'
		];
		
		try 
		{
		$result = $dynamodb->updateItem($params);
		
			if($result["Item"])
			{	
			 	echo "Updated item.\n";
				
			}

		    
		} 
		
		catch (DynamoDbException $e) 
		{
		echo "Unable to update item:\n";
		echo $e->getMessage() . "\n";
		
		}


}




?>