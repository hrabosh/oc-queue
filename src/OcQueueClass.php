<?php

namespace Hrabja\OcQueue;

//db
use Illuminate\Database\Capsule\Manager as Database;
//queue
use Illuminate\Queue\Capsule\Manager as Queue;
//worker
use Illuminate\Queue\Worker as Worker;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\WorkerOptions;
use Hrabja\OcQueue\Exception\QueueException;

class OcQueueClass extends Queue
{
    private Database $database;
    private Worker $worker;
    private Queue $queue;
    private $maintanance;

    public function __construct(){
        $this->setDatabase();
        $this->setQueue();
        $this->setWorker();

    }

    public function setDatabase(){
        $this->database = new Database();
        $this->database->addConnection([
            'driver' => 'mysql',
            'host' => DB_HOSTNAME,
            'database' => DB_DATABASE,
            'username' => DB_USERNAME,
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => DB_PREFIX,    
        ]);

    }

    public function setWorker(){
        $dispatcher = new Dispatcher();
        $exceptionHandler = new queueException();
        
        $this->worker = new Worker($this->queue->getQueueManager(), $dispatcher, $exceptionHandler, [$this, 'getMaintanance']);
        $options = new WorkerOptions();
        $options->maxTries = 3;
        $options->timeOut = 300;
        $this->worker->daemon('default', 'default', $options);

    }

    public function setQueue(){
        $this->queue = new Queue();
        $db = $this->getDatabase();

        $this->queue->addConnector('database', function() use ($db) {
            $connection = $this->database->getConnection();
            $connectionResolver = new \Illuminate\Database\ConnectionResolver(['default' => $connection]);
            $connectionResolver->setDefaultConnection('default');

            return new \Illuminate\Queue\Connectors\DatabaseConnector($connectionResolver);
        });

        $this->queue->addConnection([
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 90,
            'after_commit' => false,
        ]);
    }

    public function getDatabase(){
        return $this->database;

    }

    public function getWorker(){
        return $this->worker;
    }

    public function getQueue(){
        return $this->queue;

    }

    public function getQueueManager(){
        return $this->queue->getQueueManager();

    }

    public function runWorker(){
        // Run indefinitely
        while () {
            // Parameters: 
            // 'default' - connection name
            // 'default' - queue name
            // delay
            // time before retries
            // max number of tries
            
            $this->worker->pop('default', 'default', 0, 3, 1);
        }
    }

    public function setMaitanance($maintanance){
        $this->maintanance = $maintanance;
    }

    public function getMaintanance(){
        return $this->maintanance;
    }

    public function isDownForMaintanance($callback){
        return false;
    }


}
