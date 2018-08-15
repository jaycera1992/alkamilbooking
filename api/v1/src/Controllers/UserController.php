<?php
namespace App\Controllers;

use App\Models\User;

use App\Helpers\CommonFunction;
use App\Helpers\PasswordHash;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use Respect\Validation\Validator as v;
/**
 * Class UserController
 * @package App\Controllers
 */

class UserController
{
    protected $user;
    protected $commonFunction;
    protected $passwordHash;

    public function __construct(User $user, CommonFunction $commonFunction, PasswordHash $passwordHash)
    {
        $this->user             = $user;
        $this->commonFunction   = $commonFunction;
        $this->passwordHash     = $passwordHash;
    }

    /**
     * @param $request
     * @param $response
     * @return $response
     */

    public function getUsers($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];
        $offset         = ($args['offset'] == 1) ? 0 : $args['offset'] * 10;
        $limit  = 10;

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }
        if($offset != 0) {
            $offset -= 10;
        }

        $result = $this->user->getUsers($limit, $offset);

        foreach ($result as $key => $value) {
            if ($result[$key]['date_created']) {
                $old_date_timestamp           = strtotime($value['date_created']);
                $result[$key]['date_created'] = date('F d Y', $old_date_timestamp);
                $result[$key]['first_name'] =  html_entity_decode($result[$key]['first_name'], ENT_QUOTES);
            }
        }

        
        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function getTotalUsers($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $result = $this->user->getTotalUsers();

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function getDeletedTotalUsers($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $result = $this->user->getTotalDeletedUsers();

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }
    
    public function getActiveTotalUsers($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $result = $this->user->getTotalActiveUsers();

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function getTotalStaff($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $result = $this->user->getTotalStaff();

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function addUsers($request, $response, $args) {

        $currentUserId = (!empty($args['user_id'])) ? $args['user_id'] : null;
        
        $data = $request->getParam("data");
        $data = (!empty($data)) ? json_decode($data) : null;
        
        if (empty($data) || empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $firstName       = (!empty($data->firstName)) ? $data->firstName : null;
        $lastName       = (!empty($data->lastName)) ? $data->lastName : null;
        $email      = (!empty($data->email)) ? $data->email : null;
        $password   = (!empty($data->password)) ? $data->password : null;
        $adminRole  = (!empty($data->adminRole)) ? $data->adminRole : null;
        $designation  = (!empty($data->designation)) ? $data->designation : null;
        $mobileNumber  = (!empty($data->mobileNumber)) ? $data->mobileNumber : null;

        if (v::nullType()->validate($firstName) || v::nullType()->validate($lastName) || v::nullType()->validate($email) || v::nullType()->validate($password)
          || v::nullType()->validate($adminRole) || !v::email()->validate($email) || v::nullType()->validate($designation) || v::nullType()->validate($mobileNumber)) {

            return $response->withStatus(200)->withJson(array(
            'success' => false,
            'valid'   => false
            ));
        }
        

        $userId     = uniqid(bin2hex(openssl_random_pseudo_bytes(6)));
        $password   = $this->passwordHash->hash($password);
        $mobileNumber = '+971' . $mobileNumber;

        $result = $this->user->addUsers($userId, $firstName, $lastName , $email, $password, $adminRole, $designation, $mobileNumber, $currentUserId);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
                'error' => 'User creation'
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function deleteUser($request, $response, $args)
    {   
        $userId     = (!empty($args['user_id'])) ? $args['user_id'] : null;
        $deletedUserId = (!empty($args['delete_user_id'])) ? $args['delete_user_id'] : null;

        if (empty($userId) || empty($deletedUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }

        $result = $this->user->deleteUser($userId, $deletedUserId);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }

        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function updateUser($request, $response, $args) {

        $currentUserId = (!empty($args['user_id'])) ? $args['user_id'] : null;
        $updateUserId = (!empty($args['update_user_id'])) ? $args['update_user_id'] : null;

        $data = $request->getParam("data");
        $data = (!empty($data)) ? json_decode($data) : null;

        if (empty($data) || empty($currentUserId) || empty($updateUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $firstName       = (!empty($data->firstName)) ? $data->firstName : null;
        $lastName       = (!empty($data->lastName)) ? $data->lastName : null;
        $email      = (!empty($data->email)) ? $data->email : null;
        $password   = (!empty($data->password)) ? $data->password : null;
        $adminRole  = (!empty($data->adminRole)) ? $data->adminRole : null;
        $designation  = (!empty($data->designation)) ? $data->designation : null;
        $mobileNumber  = (!empty($data->mobileNumber)) ? $data->mobileNumber : null;
        $isActive  = (!empty($data->isActive)) ? $data->isActive : null;

        if (v::nullType()->validate($firstName) || v::nullType()->validate($lastName) || v::nullType()->validate($email)
          || v::nullType()->validate($adminRole) || !v::email()->validate($email) || v::nullType()->validate($designation) || v::nullType()->validate($mobileNumber)) {

            return $response->withStatus(200)->withJson(array(
            'success' => false,
            'valid'   => false
            ));
        }

        if(!empty($password)) {
            $password   = $this->passwordHash->hash($password);
            $password = "`password` = '" . $password . "',";
        }

        $mobileNumber = '+971' . $mobileNumber;

        $result = $this->user->updateUser($updateUserId, $firstName, $lastName, $email, $password, $adminRole, $designation, $mobileNumber, $isActive, $currentUserId);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
                'error' => 'User updating'
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function getApproveLogs($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];
        $offset         = ($args['offset'] == 1) ? 0 : $args['offset'] * 10;
        $limit  = 10;

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }
        
        if($offset != 0) {
            $offset -= 10;
        }

        $result = $this->user->getApproveLogs($limit, $offset);
        
        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function getApproveLogsCount($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];
        $offset         = ($args['offset'] == 1) ? 0 : $args['offset'] * 10;
        $limit  = 10;

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }
        
        if($offset != 0) {
            $offset -= 10;
        }

        $result = $this->user->getApproveLogsCount($limit, $offset);
        
        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }   
}
