<?php

namespace App\Models;

use Ehann\RediSearch\Index;
use Predis\Client as Predis;

use PDO;

class User
{
    private $db;

    public function __construct(PDO $db, Predis $redisMaster, Predis $redisSlave)
    {
        $this->db = $db;

        $this->mRedis  = $redisMaster;
        $this->sRefis   = $redisSlave;

        $this->now = date('Y-m-d H:i:s');
        $this->gmnow = gmdate('Y-m-d H:i:s');
        $this->timestamp = strtotime($this->gmnow . ' UCT');
    }

    public function checkUserLogin($email) {
        try {
            $sql = "
                SELECT
                    designation, user_id, first_name, last_name, email_address, password, contact_number, role, is_deleted, date_created
                FROM
                    s_users
                WHERE
                    email_address = '$email'
                    AND is_deleted = 0
                GROUP BY
                    user_id
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

    public function getUsers($limit, $offset) {
        try {
            $sql = "
                SELECT
                    a.designation, a.user_id, a.first_name, a.last_name, a.email_address, a.contact_number, b.role, b.role_id, a.is_deleted, a.date_created
                FROM
                    s_users as a
                INNER JOIN
                    s_users_role as b
                ON  
                    a.role = b.role_id
                ORDER BY
                    date_created DESC
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

    public function getTotalUsers() {
        try {
            $sql = "
                SELECT
                   count(user_id) as total
                FROM
                    s_users
                ORDER BY
                    date_created
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

    public function getTotalDeletedUsers() {
        try {
            $sql = "
                SELECT
                   count(user_id) as total
                FROM
                    s_users
                WHERE
                    is_deleted = 1
                ORDER BY
                    date_created
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

    public function getTotalActiveUsers() {
        try {
            $sql = "
                SELECT
                   count(user_id) as total
                FROM
                    s_users
                WHERE
                    is_deleted = 0
                ORDER BY
                    date_created
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

    public function getTotalStaff() {
        try {
            $sql = "
                SELECT
                   count(user_id) as total
                FROM
                    data_tool_users
                WHERE
                    role != 'administrator'
                ORDER BY
                    date_created
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

    public function addUsers($userId, $firstName, $lastName , $email, $password, $adminRole, $designation, $mobileNumber, $currentUserId) {
        
        try {
            $sql = "
                    INSERT INTO
                        s_users
                        (user_id, first_name, last_name, email_address, password, role, designation, contact_number, created_user_id, date_created)
                    VALUES
                    ('$userId', '$firstName', '$lastName', '$email', '$password', '$adminRole', '$designation', '$mobileNumber', '$currentUserId', now());
                ";

            $statement = $this->db->prepare($sql);

            if (!$statement->execute()) {
                return false;
            }
            return true;

        } catch (PDOException $e) {
            return $e;
        }

    }

    public function deleteUser($userId, $deletedUserId) {
        try {
            $sql = "
                    UPDATE
                        s_users
                    SET
                        `is_deleted` = 1,
                        `updated_user_id` = '$userId',
                        `date_updated` = NOW()
                    WHERE
                        `user_id` = '$deletedUserId'
                ";

            $statement = $this->db->prepare($sql);

            if (!$statement->execute()) {
                return false;
            }

            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }

    public function updateUser($userId, $firstName, $lastName, $email, $password, $adminRole, $designation, $mobileNumber, $isActive, $updatedUserId) {
        try {
            $sql = "
                    UPDATE
                        s_users
                    SET
                        `first_name` = '$firstName',
                        `last_name` = '$lastName',
                        `email_address` = '$email',
                        $password
                        `role` = '$adminRole',
                        `designation` = '$designation',
                        `contact_number` = '$mobileNumber',
                        `is_deleted` = '$isActive',
                        `updated_user_id` = '$updatedUserId',
                        `date_updated` = NOW()
                    WHERE
                        `user_id` = '$userId'
                ";

            $statement = $this->db->prepare($sql);

            if (!$statement->execute()) {
                return false;
            }

            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getApproveLogs($limit, $offset) {
        try {
            $sql = "
                SELECT 
                    a.name, b.keyword, c.name as created_user, b.date_created
                FROM
                    data_tool_users as a
                LEFT JOIN 
                    data_tool_approve as b
                ON
                    a.user_id = b.approved_by_user_id
                LEFT JOIN
                    data_tool_users as c
                ON
                    b.created_user_id = c.user_id
                WHERE 
                    a.role = 'approver'
                ORDER BY
                    b.date_created DESC
                LIMIT
                    $offset, $limit
            ";
            // var_dump($sql);exit;
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

    public function getApproveLogsCount($limit, $offset) {
        try {
            $sql = "
                SELECT 
                    count(b.category_id) as total, a.name 
                FROM
                    data_tool_users as a
                LEFT JOIN 
                    data_tool_approve as b
                ON
                    a.user_id = b.approved_by_user_id
                WHERE
                    a.role = 'approver'
                    GROUP BY
                    a.name
                LIMIT
                    $offset, $limit
            ";
            // var_dump($sql);exit;
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
