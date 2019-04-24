<?php

namespace App\Helpers;

use ReallySimpleJWT\Token;
use App\User;

class Common
{
    public static function handleEmpty()
    {
        return response()->json(["status" => false, "message" => "Record not found." ]);
    }

    //.. Generate a JWT Token
    public static function generateJWT(User $user){
        $userID = $user->id;
        $secret = env("JWT_TOKEN");
        $expiration = time() + 3600;
        $issuer = 'localhost';
        return Token::create($userID, $secret, $expiration, $issuer);


    }

    public static function randomToken(){
        return md5(uniqid(rand(), true));
    }
}