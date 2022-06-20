<?php

namespace Effernet\Core\Secure;

class Encryption
{

    private const SESSION_HASH = "sha256";

    public function encryptSession(string $session)
    {
        return hash(self::SESSION_HASH, $session);
    }

    public function correctionSession(string $session, string  $encrypted_session): bool
    {
        return $encrypted_session == hash(self::SESSION_HASH, $session);
    }

}