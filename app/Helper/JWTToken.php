<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {
    public static function createToken($userEmail,$userId) {
        $key = env('JWT_KEY');
        // dd(env('JWT_KEY')); // Check if this returns the correct value

        $payload = [
            'iss' => 'Laravel-Token',
            'iat' => time(),
            'exp' => time() + 60 * 60,
            'userEmail' => $userEmail,
            'userId' => $userId
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function createTokenForSetPassword($userEmail): string {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'Laravel-Token',
            'iat' => time(),
            'exp' => time() + 60 * 20,
            'userEmail' => $userEmail,
            'userId' => '0'
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function verifyToken($token) {
      try{
        if($token==null){
          return 'unauthorized';
        }else {
          $key = env('JWT_KEY');
          $decoded = JWT::decode($token, new Key($key, 'HS256'));
          return $decoded;
        }
       
      }catch(Exception $e){
        return 'unauthorized';
      }
    }
}
