<?php
return [
    'Soluti\\V1\\Rest\\Certificados\\Controller' => [
        'description' => 'API para importar, visualizar e excluir certificados (PEM).',
        'collection' => [
            'description' => 'Coleção de certificados.',
            'GET' => [
                'description' => 'Listar uma coleção de certificados.',
            ],
            'POST' => [
                'description' => 'Inserir uma coleção de certificados.',
            ],
        ],
        'entity' => [
            'description' => 'Entidade de um certificado específico.',
            'GET' => [
                'description' => 'Listar um certificado específico.',
            ],
            'DELETE' => [
                'description' => 'Remover um certificado específico.',
            ],
        ],
    ],
];
