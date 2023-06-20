<?php
namespace Hrabja\OcQueue;

//db
use Illuminate\Database\Capsule\Manager as DB;

class Database extends DB {
    private DB $database;

    public function __construct(){
        $this->database = new DB();
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
}