<?php

declare(strict_types = 1);
namespace Sinergy;

trait SinergyAuth{
    use SinergyRequest;
    public static function Auth(string $key)
    {
        if(empty(self::$token)){
            self::$token = $key;
        }
        return self::$token;
    }
    
}