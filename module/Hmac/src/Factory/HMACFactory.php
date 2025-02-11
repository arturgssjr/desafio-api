<?php
namespace Hmac\Factory;

use RB\Sphinx\Hmac\HMAC;
use RB\Sphinx\Hmac\Hash\PHPHash;
use RB\Sphinx\Hmac\Key\StaticKey;
use RB\Sphinx\Hmac\Algorithm\HMACv0;
use RB\Sphinx\Hmac\Algorithm\HMACv1;
use RB\Sphinx\Hmac\Nonce\SimpleTSNonce;
use Zend\ServiceManager\ServiceLocatorInterface;

class HMACFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function __invoke($serviceLocator)
    {        
        $config = $serviceLocator->get('config');

        $settings = [
            'version' => 'v1',
            'hash' => 'sha256',
        ];

        //Selector version and hash config
        if (isset($config["rb_sphinx_hmac_server"]["selectors_config"]["Rbhmac\HMAC"])) {

            $selector = $config["rb_sphinx_hmac_server"]["selectors_config"]["Rbhmac\HMAC"];
            
            if (isset($selector["version"])) {
                $settings["version"] = $selector["version"];
            }

            if (isset($selector["hash"])) {
                $settings["hash"] = $selector["hash"];
            }
        }

        //Settings version
        switch ($settings["version"]) {
            case 'v0':
            case 'V0':
                $algo = new HMACv0();
                break;
            case 'v1':
            case 'V1':
            default:
                $algo = new HMACv1();
        }

        //Create a hash
        $hash = new PHPHash($settings["hash"]);

        //Create a key object
        $key = new StaticKey($config['secret_key']);

        //Get a nonce
        $nonce = new SimpleTSNonce();

        return new HMAC($algo, $hash, $key, $nonce);
    }
}