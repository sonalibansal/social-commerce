<?php

require 'aws.phar';

date_default_timezone_set('UTC');
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;


use Aws\DynamoDb\DynamoDbClient;
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
            'verify' => 'C:\xampp\php\cacert.pem'
          ]
    ]);



$dynamodb = $sdk->createDynamoDb();
//a$tableName='post';
$marshaler = new Marshaler();
?>