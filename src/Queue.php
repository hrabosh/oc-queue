<?php
namespace Hrabja\OcQueue;

//queue
use Illuminate\Queue\Capsule\Manager as Queue2;

class Queue extends Queue2 {
    private Queue2 $queue;

    public function __construct($db){
        $this->queue = new Queue2();


        $this->queue->addConnector('database', function() use ($db) {
            $connection = $this->database->getConnection();
            $connectionResolver = new \Illuminate\Database\ConnectionResolver(['default' => $connection]);
            $connectionResolver->setDefaultConnection('default');

            return new \Illuminate\Queue\Connectors\DatabaseConnector($connectionResolver);
        });
    }



    
}
