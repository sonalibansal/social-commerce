<?php
require 'aws.phar';

//$post_id=4;

  date_default_timezone_set('UTC');
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;


use Aws\DynamoDb\DynamoDbClient;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
 use Aws\Common\Credentials\Credentials;


$dynamodb = DynamoDbClient::factory(array(
    'region' => 'ap-south-1',
     'version' => 'latest'


    // Credentials etc
));

$credentials = new Aws\Credentials\Credentials('AKIAJBGRY3QUTI4OAIHQ ', 'jnulLVt3+5GL6sAH1yNNRCtBCPg9A6wiZn1UpAIS');

$sdk = new Aws\Sdk([
        'region'   => 'ap-south-1',
        'version'  => 'latest',
		'credentials'=>$credentials,
        'http'    => [
            'verify' => 'F:\xampp\htdocs\amazon\curl-ca-bundle.crt'
          ]
    ]);



$dynamodb = $sdk->createDynamoDb();

$tableName='post';
$client = S3Client::factory(array(

    'region' => 'ap-south-1',
     'version' => 'latest',
     'credentials'=>$credentials,
     'http'    => [
            'verify' => 'F:\xampp\htdocs\amazon\curl-ca-bundle.crt'
          ]

));



//$bucket = uniqid("testnmn", true);
$bucket='socialcommerceitems';

//echo $tmp;




?>
