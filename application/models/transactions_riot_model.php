<?php
//TODO: IMPLEMENT MONGO DB FOR STATTRAK
/**
 *
 * INSTALLATION OF MONGODB DRIVER IN PHP IS NEEDED, KEEP IN MIND IT IS THE NEW php_mongodb.dll.
 *
 * Class Transactions_riot_model
 */
class Transactions_riot_model {

    private $mongo_db;

    public function __construct() {
        //log_message('debug', __CLASS__.' loaded, connecting to Mongo DB...');
        $mongo_db = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $filter = array("cuisine" => "Bakery");
        $options = array("limit" => 10);
        $this->query = new MongoDB\Driver\Query($filter,$options);
        var_dump($this->query);
        $this->db = $mongo_db->executeQuery('test.restaurants',$this->query);
        //var_dump($this->db);
        foreach ($this->db as $r){
            var_dump($r);
        }

    }
}

$test = new Transactions_riot_model();