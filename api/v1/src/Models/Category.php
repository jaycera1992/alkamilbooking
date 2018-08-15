<?php

namespace App\Models;

use Ehann\RediSearch\Index;
use Predis\Client as Predis;

use PDO;

class Category
{
    private $db;
    protected $es;

    public function __construct(PDO $db, Predis $redisMaster, Predis $redisSlave, $es)
    {
        $this->db = $db;
        $this->es = $es;

        $this->mRedis  = $redisMaster;
        $this->sRefis   = $redisSlave;

        $this->now = date('Y-m-d H:i:s');
        $this->gmnow = gmdate('Y-m-d H:i:s');
        $this->timestamp = strtotime($this->gmnow . ' UCT');
    }

    public function addCategory($category) {
        
        try {
            $sql = "
                INSERT INTO
                category    
                    (text)
                VALUES
                ('$category');
            ";

            $statement = $this->db->prepare($sql);

            if (!$statement->execute()) {
                return false;
            }

            $id = $this->db->lastInsertId();

            $this->mRedis->set('category:' . $id, $category);

            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function addGroceryMarket($categoryId) {
        try {
            $sqlArr = array(); 

            $sqlArr[] = '("'. $categoryId .'", "'. rand(0,2000) .'", "'.  rand(0,2000) .'", "'. $this->generateRandomString() .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                )';

            $sql = "
                INSERT INTO 
                    `master_table`
                (`category_id`,`column_3`,`column_4`, `column_5`, `column_6`, `column_7`, `column_8`
                    , `column_9`, `column_10`, `column_11`, `column_12`, `column_13`, `column_14`, `column_15`
                    , `column_16`, `column_17`, `column_18`, `column_19`, `column_20`, `column_21`, `column_22`
                    , `column_23`, `column_24`, `column_25`, `column_26`, `column_27`, `column_28`, `column_29`
                    , `column_30`, `column_31`, `column_32`, `column_33`, `column_34`, `column_35`) VALUES " . implode(',', $sqlArr);

            $statement = $this->db->prepare($sql);

            if (!$statement->execute()) {
                return false;
            }

            $id = $this->db->lastInsertId();

            $key = 'category';
            
            $this->mRedis->hset($key . ':' . $id, 'category_id', $categoryId);
            $this->mRedis->hset($key . ':' . $id, 'column_3', rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_4', rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_5',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_6',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_7',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_8',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_9',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_10',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_11',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_12',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_13',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_14',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_15',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_16',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_17',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_18',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_19',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_20',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_21',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_22',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_23',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_24',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_25',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_26',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_27',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_28',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_29',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_30',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_31',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_32',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_33',  rand(0,2000));
            $this->mRedis->hset($key . ':' . $id, 'column_34',  $this->generateRandomString());
            $this->mRedis->hset($key . ':' . $id, 'column_35',  rand(0,2000));
            
            $this->generateEs($categoryId, $id);

            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }

    public function generateEs($categoryId, $id) {

        $params = [
            'index' => 'category',
            'type'  => 'info',
            'id'    => $id,
            'body'  => [
                'category_id' => $categoryId,
                'id' => $id,
                'date_created' => $this->now,
                'date_updated' => $this->now
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }

    }
     
    public function generateData() {

        try {
            $sqlArr = array(); 
            for($i = 0; $i < 100000; $i++) {
                $sqlArr[] = '("'. rand(1,17) .'", "'. rand(0,2000) .'", "'.  rand(0,2000) .'", "'. $this->generateRandomString() .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'", "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                , "'. $this->generateRandomString() .'", "'. rand(0,2000) .'"
                )';
            }

            $sql = "
                INSERT INTO 
                    `master_table`
                (`category_id`,`column_3`,`column_4`, `column_5`, `column_6`, `column_7`, `column_8`
                    , `column_9`, `column_10`, `column_11`, `column_12`, `column_13`, `column_14`, `column_15`
                    , `column_16`, `column_17`, `column_18`, `column_19`, `column_20`, `column_21`, `column_22`
                    , `column_23`, `column_24`, `column_25`, `column_26`, `column_27`, `column_28`, `column_29`
                    , `column_30`, `column_31`, `column_32`, `column_33`, `column_34`, `column_35`) VALUES " . implode(',', $sqlArr);
    
            $statement = $this->db->prepare($sql);

            if (!$statement->execute()) {
                return false;
            }
            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getCategoryData($limit, $offset) {
        try {
            $sql = "
            SELECT 
                a.id, a.category_id, b.text, a.date_created
            FROM
                master_table AS a
            INNER JOIN
                category AS b
            ON
                b.id = a.category_id
            ORDER BY
                a.id DESC   
            LIMIT
                $offset, $limit
            ";

            $statement = $this->db->prepare($sql);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $results = $statement->fetchAll();
            
            if (count($results) >= 1) {
              return $results;
            } else {
              return false;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getTotalCategory() {
        try {
            $sql = "
                SELECT
                    count(id) as total
                FROM
                    master_table
            ";

            $statement = $this->db->prepare($sql);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $results = $statement->fetchAll();
            
            if (count($results) >= 1) {
              return $results[0];
            } else {
              return false;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getCategoryCount($categoryId) {
        try {
            $sql = "
                SELECT 
                    count(category_id) as total
                FROM
                    master_table 
                WHERE 
                    category_id = '$categoryId';
            ";

            $statement = $this->db->prepare($sql);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $results = $statement->fetchAll();
            
            if (count($results) >= 1) {
              return $results[0];
            } else {
              return false;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getCategoryReference() {
        try {
            $sql = "
                SELECT
                    id, text
                FROM
                    category
                ORDER BY
                    text ASC
            ";

            $statement = $this->db->prepare($sql);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $results = $statement->fetchAll();
            
            if (count($results) >= 1) {
              return $results;
            } else {
              return false;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }
}
