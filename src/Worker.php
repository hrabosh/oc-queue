<?php
namespace Hrabja\OcQueue;

//worker
use Illuminate\Queue\Worker;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\WorkerOptions;

use Hrabja\OcQueue\Exception\QueueException;

class Worker2 extends Illuminate\Queue\Worker {
    public function __construct(){

    }

}