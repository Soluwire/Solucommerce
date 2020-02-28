<?php
namespace SoluHelpers\Api;

class ApiResponses {
public static function Fail(){
    return Response("Fail",503);
}
public static function Success(){
    return Response("Success",200);
}
}
?>