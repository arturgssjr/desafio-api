<?php
return [
    'service_manager' => [
        'abstract_factories' => [],
    ],
    'doctrine' => [
        'driver' => [
            'Soluti_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => './module/Soluti/src/V1/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Soluti' => 'Soluti_driver',
                ],
            ],
        ],
    ],
    'router' => [
        'routes' => [
            'soluti.rest.doctrine.certificados' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/certificados[/:certificados_id]',
                    'defaults' => [
                        'controller' => 'Soluti\\V1\\Rest\\Certificados\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'soluti.rest.doctrine.certificados',
        ],
    ],
    'zf-rest' => [
        'Soluti\\V1\\Rest\\Certificados\\Controller' => [
            'listener' => \Soluti\V1\Rest\Certificados\CertificadosResource::class,
            'route_name' => 'soluti.rest.doctrine.certificados',
            'route_identifier_name' => 'certificados_id',
            'entity_identifier_name' => 'id',
            'collection_name' => 'certificados',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Soluti\V1\Entity\Certificados::class,
            'collection_class' => \Soluti\V1\Rest\Certificados\CertificadosCollection::class,
            'service_name' => 'Certificados',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Soluti\\V1\\Rest\\Certificados\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Soluti\\V1\\Rest\\Certificados\\Controller' => [
                0 => 'application/vnd.soluti.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Soluti\\V1\\Rest\\Certificados\\Controller' => [
                0 => 'application/vnd.soluti.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Soluti\V1\Entity\Certificados::class => [
                'route_identifier_name' => 'certificados_id',
                'entity_identifier_name' => 'id',
                'route_name' => 'soluti.rest.doctrine.certificados',
                'hydrator' => 'Soluti\\V1\\Rest\\Certificados\\CertificadosHydrator',
            ],
            \Soluti\V1\Rest\Certificados\CertificadosCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'soluti.rest.doctrine.certificados',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-apigility' => [
        'doctrine-connected' => [
            \Soluti\V1\Rest\Certificados\CertificadosResource::class => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'Soluti\\V1\\Rest\\Certificados\\CertificadosHydrator',
            ],
        ],
    ],
    'doctrine-hydrator' => [
        'Soluti\\V1\\Rest\\Certificados\\CertificadosHydrator' => [
            'entity_class' => \Soluti\V1\Entity\Certificados::class,
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation' => [
        'Soluti\\V1\\Rest\\Certificados\\Controller' => [
            'input_filter' => 'Soluti\\V1\\Rest\\Certificados\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Soluti\\V1\\Rest\\Certificados\\Validator' => [
            0 => [
                'name' => 'nome',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
                'description' => 'Nome do Certificado.',
                'error_message' => 'Insira o nome do certificado.',
                'field_type' => '',
            ],
            1 => [
                'name' => 'certificado',
                'required' => true,
                'filters' => [],
                'validators' => [],
                'description' => 'Certificado (PEM)',
                'error_message' => 'Insira o arquivo certificado (PEM).',
                'field_type' => '',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'Soluti\\V1\\Rest\\Certificados\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
        ],
    ],
];
