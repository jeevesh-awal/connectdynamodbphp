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

    $tableName = 'StudentList';
    echo "Adding data to $tableName table. " . PHP_EOL;

    $response = $client->batchWriteItem(array(
        'RequestItems' => array(
            $tableName => array(
                array(
                    'PutRequest' => array(
                        'Item' => array(
                            'StudentId'       => array('N' => '001001'),
                            'StudentName'     => array('S' => 'Pragya Sharma'),
                            'StudentLocation' => array('S' => 'Delhi'),
                            'CoursesEnrolled' => array('SS' => array('AWS')),
                        )
                    ),
                ),
                array(
                    'PutRequest' => array(
                        'Item' => array(
                            'StudentId'       => array('N' => '001002'),
                            'StudentName'     => array('S' => 'Piyush Raj'),
                            'StudentLocation' => array('S' => 'New Delhi'),
                            'CoursesEnrolled' => array('SS' => array('AWS','Web Development')),
                        )
                    ),
                ),
                array(
                    'PutRequest' => array(
                        'Item' => array(
                            'StudentId'       => array('N' => '001003'),
                            'StudentName'     => array('S' => 'Atul Garg'),
                            'StudentLocation' => array('S' => 'Gurgaon'),
                            'CoursesEnrolled' => array('SS' => array('AWS','Embedded Systems','Java')),
                        )
                    ),
                )
            ),
        ),
    ));

    echo "Data added. " . PHP_EOL;



    $tableName = 'StudentCourses';
    echo "Adding data to $tableName. " . PHP_EOL;

    $response = $client->batchWriteItem(array(
        'RequestItems' => array(
            $tableName => array(
                array(
                    'PutRequest' => array(
                        'Item' => array(
                            'Name'     => array('S' => 'AWS Online Batch 1001'),
                            'MaxStudents' => array('N' => '20'),
                            'Location'  => array('S' => 'Online Course'),
                            'DurationInHours' => array('N' => '50'),
                        )
                    )
                ),
                array(
                    'PutRequest' => array(
                        'Item' => array(
                            'Name'     => array('S' => 'Web Online Batch 2001'),
                            'MaxStudents' => array('N' => '20'),
                            'Location'  => array('S' => 'PrismCode Gurgaon Branch'),
                            'DurationInHours' => array('N' => '50'),
                        )
                    )
                )
            )
        )
    ));

    echo "Data added. " . PHP_EOL;


    $tableName = 'StudentFeedback';
    echo "Adding data to $tableName. " . PHP_EOL;

    $response = $client->batchWriteItem(array(
        'RequestItems' => array(
            $tableName => array(
                array(
                    'PutRequest' => array(
                        'Item' => array(
                            'StudentName'     => array('S' => 'Atul Garg'),
                            'StudentCourse'   => array('S' => 'Embedded Systems'),
                            'StudentRating'   => array('N' => '9'),
                            'StudentComments' => array('S' => 'It was a great course.')
                        )
                    )
                ),
            ),
        )
    ));

    echo "Data added. " . PHP_EOL;
?>