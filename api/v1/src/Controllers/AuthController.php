<?php
namespace App\Controllers;

use App\Models\User;

use App\Helpers\CommonFunction;
use App\Helpers\PasswordHash;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use Respect\Validation\Validator as v;
/**
 * Class AuthController
 * @package App\Controllers
 */

class AuthController
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

    public function generateJWT($request, $response, $args)
    {
        $output = array(
            'success'   => true,
            'token'     => $this->commonFunction->generateJWT()
        );

        return $response->withStatus(200)->withJson($output);
    }


    public function decodeJWT($request, $response, $args)
    {
        print 'I am IN!';
    }


    /**
     * @param $request
     * @param $response
     * @return $response
     */

    public function checkUserLogin($request, $response, $args)
    {
        $data   = $request->getParam('data');
        $data   = (!empty($data)) ? json_decode($data) : NULL;

        if(empty($data)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $email      = strtolower($data->email);
        $password   = $data->password;
        
        $query = $this->user->checkUserLogin($email);

        if (empty($query)) {
            return $response->withStatus(200)->withJson(array(
                'success'       => false,
                'data'    => 'User not exist.' // No Email Account
            ));
        }
        
        $rPassword = $query['password'];

        if (!$this->passwordHash->checkPassword($rPassword, $password)) {
            return $response->withStatus(200)->withJson(array(
                'success'       => false,
                'error_code'    => 2 // Invalid Password
            ));
        }

        if ($query['date_created']) {
            $old_date_timestamp    = strtotime($query['date_created']);
            $query['date_created'] = date('F d Y', $old_date_timestamp);
        }

        unset($query['password']);

        $output = array(
            'success'   => true,
            'data'      => $query,
            'user_id'   => $query['user_id'],
            'token'     => $this->commonFunction->generateJWT()
        );

        return $response->withStatus(200)->withJson($output);
    }
}
