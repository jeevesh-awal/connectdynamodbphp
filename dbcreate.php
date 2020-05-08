<?php
    date_default_timezone_set('Asia/Kolkata');
    
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);
    
    require 'vendor/autoload.php';
    use Aws\DynamoDb\DynamoDbClient;
    
    $client = DynamoDbClient::factory(array(
        'region' => 'ap-south-1',
        'version' => 'latest'
    ));
    
    $tableNames = array();
    
    $tableName = 'StudentList';
    echo "Creating table $tableName. " . PHP_EOL;
    
    $response = $client->createTable(array(
        'TableName' => $tableName,
        'AttributeDefinitions' => array(
            array(
                'AttributeName' => 'StudentId',
                'AttributeType' => 'N' 
            )
        ),
        'KeySchema' => array(
            array(
                'AttributeName' => 'StudentId',
                'KeyType' => 'HASH' 
            )
        ),
        'ProvisionedThroughput' => array(
             'ReadCapacityUnits'  => 6,
             'WriteCapacityUnits' => 5
        )
    ));
    $tableNames[] = $tableName;
    
    $tableName = 'StudentCourses';
    echo "Creating table $tableName. " . PHP_EOL;
    
    $response = $client->createTable(array(
        'TableName' => $tableName,
        'AttributeDefinitions' => array(
            array(
                'AttributeName' => 'Name',
                'AttributeType' => 'S' 
            )
        ),
        'KeySchema' => array(
            array(
                'AttributeName' => 'Name',
                'KeyType' => 'HASH'
            )
        ),
        'ProvisionedThroughput' => array(
            'ReadCapacityUnits'  => 6,
            'WriteCapacityUnits' => 5
        )
    ));
    $tableNames[] = $tableName;
    
    $tableName = 'StudentFeedback';
    echo "Creating table $tableName. " . PHP_EOL;
    
    $response = $client->createTable(array(
        'TableName' => $tableName,
        'AttributeDefinitions' => array(
            array(
                'AttributeName' => 'StudentName',
                'AttributeType' => 'S'
            ),
            array(
                'AttributeName' => 'StudentCourse',
                'AttributeType' => 'S'
            )
        ),
        'KeySchema' => array(
            array(
                'AttributeName' => 'StudentName',
                'KeyType' => 'HASH'
            ),
            array(
                'AttributeName' => 'StudentCourse',
                'KeyType' => 'RANGE'
            )
        ),
        'ProvisionedThroughput' => array(
            'ReadCapacityUnits'  => 6,
            'WriteCapacityUnits' => 5
        )
    ));
    $tableNames[] = $tableName;
        
    foreach($tableNames as $tableName) {
        echo "Creating $tableName. " . PHP_EOL;
        $client->waitUntil('TableExists', array('TableName' => $tableName));
        echo "$tableName created successfully. " . PHP_EOL;
    }
?>