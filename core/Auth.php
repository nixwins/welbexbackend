<?php

namespace Core;

use App\Model\UsersModel;  

class Auth
{
    private const USER_MANAGER = 3;
    
    public static function isLogin($token)
    {
        $tokenFromSession = (isset($_SESSION["token"]) && !empty($_SESSION["token"])) ? $_SESSION["token"] : null;
         $tokenFromPost = isset($token) && !empty($token) ? $token : null;
         
         if (($tokenFromPost !== null & $tokenFromSession !== null) && $tokenFromPost === $tokenFromSession) {
            
             return true;
        }
        return false;
    }
    
    public static function isManager()
    {
        $phone = (isset($_SESSION["phone"]) && !empty($_SESSION["phone"])) ? $_SESSION["phone"] : null;
        $userModel = new UsersModel();
        $user = $userModel->getUserByPhone($phone);
      //   print_r($user);
        //echo $user[0]["role_id"];
        if(count($user) > 0)
        {
            if ($user[0]["role_id"] == self::USER_MANAGER) {
                return true;
            }
            return false;
        }
        
       
    }
}

