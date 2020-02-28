<?php
namespace SoluHelpers\Url;

Class StringToUrl{
    public static function ToUrl($url): String {
        return strtolower(str_replace(" ","-",$url));
    
    }
    public static function UrlToString($url): String {
        return strtolower(str_replace("-"," ",$url));
}
}

?>