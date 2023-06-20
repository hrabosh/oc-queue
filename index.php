<?php
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'rlx-oc-hudebniny');
define('DB_PORT', '3306');
define('DB_PREFIX', '');


require 'vendor/autoload.php';
use Hrabja\OcQueue\OcQueueClass as QueueClass;


$queueClass = new QueueClass();

print_r($queueClass->getQueueManager()->push('test', 'test'));
print_r($queueClass->runWorker());
echo 'test';