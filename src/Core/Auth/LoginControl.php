<?php

namespace Effernet\Core\Auth;

use Effernet\Core\Application\Session;

class LoginControl
{

    public static function controlLogin(): bool
    {
        if (isset($_SESSION['logged_in'])){
            return true;
        }else{
            return false;
        }
    }

}