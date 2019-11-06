<?php

return [
    'service_manager' => [
        'factories' => [
            'Rbhmac\HMAC' => 'Rbhmac\Factory\HMACFactory',
            'Rbhmac\HMACSession' => 'Rbhmac\Factory\HMACSessionFactory',
        ],
    ],
    'rb_sphinx_hmac_server' => [
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
            ],
            'Rbhmac\\HMACSession' => [
                'hash' => 'sha256',
                'version' => 'v1',
            ],
        ],
        'controllers' => [
            'Soluti\\V1\\Rest\\Certificados\\Controller' => [
                'selector' => 'HMAC',
                'adapter' => 'HMACHeaderAdapter',
            ],
        ],
    ],
];