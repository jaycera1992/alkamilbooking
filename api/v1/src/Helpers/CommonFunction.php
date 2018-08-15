<?php

namespace App\Helpers;

use \Firebase\JWT\JWT;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use PDO;

class CommonFunction
{
    protected $user;
    protected $file_url;
    /**
     * @param $str
     * @return $str
     */
    public function __construct(PDO $db)
    {
        $this->secretKey   = '2017i@mJamsL3tm3pAs51990'; // Change also in /middleware.php
        $this->db           = $db;
    }


        /**
     * Turn all URLs in clickable links.
     *
     * @param string $value
     * @param array  $protocols  http/https, ftp, mail, twitter
     * @param array  $attributes
     * @param string $mode       normal or all
     * @return string
     */

    public function generateJWT() {
        $now        = time();
        $start      = $now + 10;
        $expire     = $start + 86400; // 24 hours
        //$expire     = $start + 20; // 20 seconds, for testing only
        $serverName = 'jobsglobal.com';

        $token = array(
            "iss" => $serverName,
            "aud" => $serverName,
            "iat" => $now,
            "exp" => $expire
        );

        return JWT::encode($token, $this->secretKey);
    }



    public function getUniqueId() {
        try {

            $sql = "SELECT SUBSTRING(UUID(), 1, 8) as uniqueId";

            $statement = $this->db->prepare($sql);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $results = $statement->fetchAll();

            if (count($results) === 1) {
                return $results[0]['uniqueId'];
            } else {
                return false;
            }

        } catch (PDOException $e) {
            return $e;
        }
    }

    public function cleanJsonString($str) {

        $str = str_replace("\n", '\\n', $str);
        $str = str_replace("\r", '\\r', $str);
        $str = str_replace("\t", '\\t', $str);
        $str = str_replace("\b", '\\b', $str);
        $str = str_replace("\f", '\\f', $str);
        $str = str_replace("\u", '\\u', $str);

        $str = str_replace("&amp;bull", '<br>&amp;bull;', $str);

        return $str;
    }

    public function cleanString($str)
    {

        $str = htmlspecialchars(trim($str), ENT_QUOTES);

        return $str;
    }

    /**
     * @param $request
     * @param $response
     * @return $response
     */
    public function sendSms($mobile, $message)
    {
        $token = file_get_contents("http://209.95.52.78/1022/gettoken.php");

        $url = "http://209.95.52.78/1022/priority.php?token={$token}&telnum={$mobile}&message={$message}";
        try {

            $httpClient  = new Client();
            $getResponse = $httpClient->request("GET", $url, [
                'http_errors' => false,
            ]);

            if ($getResponse->getStatusCode() != 200) {
                return false;
            }

            $dstatus = "Submission result: {$getResponse->getBody()->getContents()}";

            return true;
        } catch (RequestException $e) {
            return false;
        }
    }

    public function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    public function getCurrentMonth() {
        return date('n');
    }

    public function getCurrentYear() {
        return date('Y');
    }

    public function getDateExpiry() {
        return date('Y-m-t');
    }

}
