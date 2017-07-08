<?php
//include 'session.php';
require 'sr_database_connect.php';
include 'sr_get_item_posts.php';
require 'sr_create_item_batch_table.php';
require 'sr_update_item_batch_table.php';
require 'sr_scan_batch_table.php';

//1-->post table, 2--> batch_table
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

$params = [
'TableName' => 'updates',
'ProjectionExpression' => '#post_id,User_id,Reaction_value,updated_time,User_name',
'ExpressionAttributeNames'=> [ '#post_id' => 'post_id' ],
'Limit'=>6
];

//$login_id
$sdk2 = new Aws\Sdk
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

    


$dynamodb2 = $sdk2->createDynamoDb();

$marshaler2 = new Marshaler();

$count=0;

try
{	    
		$result = $dynamodb->scan($params);
		$count = $count + count ( $result['Items'] );
		
		foreach ($result['Items'] as $i) 
		{	
			
			$noti = $marshaler->unmarshalItem($i);
			
			$content=get_item_posts($noti['post_id']);
			
			


			
			$file = fopen("C:\Python27\log.txt", "w+") or die("Unable to open file!");
			
			fwrite($file, $content);
			fclose($file);	
			//scan_batch_table($noti['post_id'],$noti['User_id']);			
		
			$post_id_string2=(string)($noti['post_id']);

			$key2 = $marshaler2->marshalJson
			('
				{
								"post_id": ' . $post_id_string2 . '
				}
			
			');

			
			$params2 = 
					[
						'TableName' => 'batch_table',
						'Key' =>$key2,
						 'ExpressionAttributeNames'=> [ '#post_id'=>'post_id','#cnt' => 'count','#user'=>'Users' ],

						'ProjectionExpression' => '#post_id,#user,#cnt'
										
										
					];
				
			
			switch ($noti['Reaction_value'])
			{
				case "Rated":
					$arr="rated";
					break;
				
				case "Contributed":
					$arr="contributed to";
					break;
				
				case "Polled":
					$arr="polled on";
					break;

				case "Liked":
					$arr="liked";
					break;
				
					
				default:
				    $arr="rated";
					break;
			}

			?>
			
			<html>

			<head>
				<title>notifications</title>
			</head>
			
			<style>
					#name
					{
						color:black;
						background: seashell;
						text-align: left;
						height: 50px;
						width: 350px;
					}

			</style>
			
			<form action="sr_detailed_content.php" method ="post">
				<input type="hidden" name="post_id" value ='<?php  echo $noti['post_id']?>'/>
				<input type="hidden" name="User_id" value ='<?php  echo $noti['User_id']?>' />
				<input type="hidden" name="User_name" value ='<?php  echo $noti['User_name']?>' />
				<input type="hidden" name="updated_time" value ='<?php  echo $noti['updated_time']?>'/> 
				<input type="hidden" name="post_type" value ='<?php  echo $noti['Reaction_value']?>'/> 
				<input type="hidden" name="content" value ='<?php  echo $content ?>'  />
				
				<input type="submit" id ="name" height= "500px"  value='<?php
				
				$flag=scan_batch_table($noti['post_id'],$noti['User_id']);
				
				if($flag==1)
				{
						 $text= "User id ".$noti['User_id']." has ".$arr." the post: ";
							if(strlen($text.$content)<107)
								echo $text.$content."..";

						 else
						 { $handle = popen('C:\Python27\trim_final.py 2>&1', 'r');$read = fread($handle, 2096); pclose($handle); $newtext=$text.$read; 
											
							if (strlen($newtext)>=107)
									{	$x=(strlen($newtext)-107);
										$x=$x+5;
										$rest = substr($newtext, 0,-$x);
										$rest=$rest."..";
										echo wordwrap($rest, 55, "\n", true);
										//echo "#";
									}
							else 
								
							{	
								echo wordwrap($newtext,55, "\n", true);
							    //echo "#";
							}
						}

				}

				else
				{	
					$result2 = $dynamodb2->getItem($params2);								
					$n=count($result2['Item']['Users']['NS']);
					
					if($n==1)
					{
							 $text= "User id ".$noti['User_id']." has ".$arr." the post: ";
								if(strlen($text.$content)<107)
									echo $text.$content."..";

							 else
							 { $handle = popen('C:\Python27\trim_final.py 2>&1', 'r');$read = fread($handle, 2096); pclose($handle); $newtext=$text.$read; 
												
								if (strlen($newtext)>=107)
										{	$x=(strlen($newtext)-107);
											$x=$x+5;
											$rest = substr($newtext, 0,-$x);
											$rest=$rest."..";
											echo wordwrap($rest, 55, "\n", true);
											//echo "#";
										}
								else 
									
								{	
									echo wordwrap($newtext,55, "\n", true);
								    //echo "#";
								}
							}

					}
					
					else
					{
							$text= "Users: ";
							 "Users:  ";
									
							for($m=0;$m<$n;$m=$m+1)
									
							{										
										$text=$text.$result2['Item']['Users']['NS'][$m].",";
										
							}
							$text=$text. "have ".$arr." the post: ";
							if(strlen($text.$content)<107)
								echo $text.$content."..";

							 else
							 { $handle = popen('C:\Python27\trim_final.py 2>&1', 'r');$read = fread($handle, 2096); pclose($handle); $newtext=$text.$read; 
												
								if (strlen($newtext)>=107)
										{	$x=(strlen($newtext)-107);
											$x=$x+5;
											$rest = substr($newtext, 0,-$x);
											$rest=$rest."..";
											echo wordwrap($rest, 55, "\n", true);
											
										}
								else 
									
								{	
									echo wordwrap($newtext,55, "\n", true);
								    
								    
								}
							}

					}
					

				}

				;?>'  />

			
			</form>
			</html>
	
			

			<?php
				 	
		 
		}
		
		
		echo "~";
		
		echo $result['LastEvaluatedKey']["post_id"]["N"];
		echo "^";
		
}

catch (DynamoDbException $e) 
{
	echo "#";
	echo $e->getMessage() . "\n";
}


?>