<?php

use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;
use \Firebase\JWT\SignatureInvalidException;
use \Firebase\JWT\BeforeValidException;
use \Firebase\JWT\DomainException;

$jwt = function ($request, $response, $next) {
    $secretKey  = "2017i@mJamsL3tm3pAs51990"; // Change also in /Helpers/CommonFunction.php

    try {

        if(empty($request->getHeader('Authorization'))) {
            return $response->withStatus(401)->withJson([
                'success' => false,
                'message' => 'Unauthorized Request'
            ]);
        }

        $jwt = $request->getHeader('Authorization')[0];

        $decoded = (array) JWT::decode($jwt, $secretKey, array('HS256'));

        //print_r($decoded);
    } catch (ExpiredException $e) {
        return $response->withStatus(401)->withJson([
            'success' => false,
            'error_code' => 1, // Expired Token
            'message' => 'Unauthorized Request'
        ]);
    } catch (SignatureInvalidException $e) {
        return $response->withStatus(401)->withJson([
            'success' => false,
            'message' => 'Unauthorized Request'
        ]);
    } catch (BeforeValidException $e) {
        return $response->withStatus(401)->withJson([
            'success' => false,
            'message' => 'Unauthorized Request'
        ]);
    }

    $response   = $next($request, $response);

    return $response;
};




