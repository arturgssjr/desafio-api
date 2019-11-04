<?php

return [
    'service_manager' => [
        'factories' => [
            'Rbhmac\HMAC' => 'Hmac\Factory\HMACFactory',
            'Rbhmac\HMACSession' => 'Hmac\Factory\HMACSessionFactory',
        ],
    ],
    'rb_sphinx_hmac_server' => [
        'auth'=> [
            'apps' => ''
        ],
        'selectors' => [
            //Default HMAC Selectors (Usa usuários do config]
            'HMAC' => 'Rbhmac\HMAC',
            'HMACSession' => 'Rbhmac\HMACSession',
        ],
        'default_selector' => 'HMAC',
        'default_adapter' => 'HMACHeaderAdapter',
        //Configurações dos seletores dinâmicos
        'selectors_config' => [
            'Rbhmac\\HMAC' => [
                'hash' => 'sha256',
                'version' => 'v1',
                'key' => 'RB\Sphinx\Hmac\Key\StaticKey',
            ],
            'Rbhmac\\HMACSession' => [
                'hash' => 'sha256',
                'version' => 'v1',
                'key' => 'RB\Sphinx\Hmac\Key\StaticKey',
            ],
        ],
        'controllers' => [
            'Soluti\\V1\\Rest\\Certificados\\Controller' => [
                'actions' => [
                    'get' => [
                        'selector' => 'HMAC',
                        'adapter' => 'HMACHeaderAdapter',
                        'key' => 'RB\Sphinx\Hmac\Key\StaticKey',
                    ],
                ],
            ],
        ],
    ],
];