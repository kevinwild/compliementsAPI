<?php

namespace App\Helpers;


class Common
{
    public static function handleEmpty()
    {
        return response()->json(["status" => false, "message" => "Record not found." ]);
    }
}