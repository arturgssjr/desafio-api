<?php

namespace Hmac\Key;

use Hmac\Key\AbstractHMACKey;

class ConfigKey extends AbstractHMACKey
{
    public function getKeyValue($keyId = NULL)
    {
        if(isset($this->getConfig()["rb_sphinx_hmac_server"]["auth"]["apps"]) && key_exists($keyId, $this->getConfig()["rb_sphinx_hmac_server"]["auth"]["apps"])){
            return $this->getConfig()["rb_sphinx_hmac_server"]["auth"]["apps"][$keyId];
        }

        return "[INVALID KEY]" . sha1(rand(0,9999));
    }
}