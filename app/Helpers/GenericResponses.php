<?php

namespace App\Helpers;
use \Illuminate\Http\Response;

class GenericResponses
{

    public static function savedResource($status, $options = [])
    {
        (isset($options["name"])) ? $name = $options["name"] : $name = null;
        (isset($options["action"])) ? $action = $options["action"] : $action = null;

        if ($status) {
            $rsp = [
                "success" => true,
                "message" => $name . " " . $action . " properly"
            ];
        }
        else{
            $rsp = [
                "success" => false,
                "message" => $name . " did not " . $action . " properly"
            ];
        }
        return response()->json($rsp);
    }


}