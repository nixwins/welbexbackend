<?php

namespace Core;

class Validator
{
    public static function isNumber($num)
    {
        $phone = trim($num);
        
        if(is_numeric($phone))
        {
            return true;
        }
        return false;
    }
    
    public static function trim($str)
    {
        return \preg_replace('/\s+/', '', $str);
        
    }
        
}
    

