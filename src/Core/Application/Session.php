<?php

namespace Effernet\Core\Application;

use Effernet\Core\Secure\Encryption;

class Session{

    /**
     * @var Encryption
     */
    private Encryption $encryption;

    /**
     *
     */
    public function __construct()
    {
        $this->encryption = new Encryption();
    }

    /**
     * @param string $session_name
     * @param $data
     */
    public function createNewSession(string $session_name, $data): void
    {
        $_SESSION[$this->encryption->encryptSession($session_name)] = $data;
    }

    /**
     * @param string $session_name
     * @return false|mixed
     */
    public function getSessionData(string $session_name)
    {
        return $_SESSION[$this->encryption->encryptSession($session_name)] ?? false;
    }



}