<?php
namespace Soluti\V1\Rest\Certificados;

use phpseclib\File\X509;
use ZF\ApiProblem\ApiProblem;
use ZF\Apigility\Doctrine\Server\Resource\DoctrineResource;

class CertificadosResource extends DoctrineResource
{
    /**
     * @var X509
     */
    private $x509;

    public function __construct()
    {
        $this->x509 = new X509();
    }
    /**
     * Método para retornar lista de certificados.
     */
    // public function fetchAll($data = [])
    // {
    //     $cert = parent::fetchAll($data);

    //     return $cert;
    // }

    /**
     * Método para remover um certificados.
     */
    // public function delete($id)
    // {
    //     $cert = parent::delete($id);

    //     return $cert;
    // }

    /**
     * Método para cadastrar certificado.
     */
    // public function create($data)
    // {
    //     $cert = parent::create($data);

    //     return $cert;
    // }

    /**
     * Método para retornar um certificado específico.
     */
    public function fetch($id)
    {
        $certificado = parent::fetch($id);

        if($certificado->status === 404) {
            return new ApiProblem(404, "Certificado com o ID: {$id}, não existe.");
        }

        $certLoad = $this->x509->loadX509($certificado->getCertificado());

        $cert = [
            'certSubject' => $this->x509->getSubjectDN($certLoad),
            'certIssuer' => $this->x509->getIssuerDN($certLoad),
            'certValidate' => [
                'notBefore' => $certLoad['tbsCertificate']['validity']['notBefore']['utcTime'],
                'notAfter' => $certLoad['tbsCertificate']['validity']['notAfter']['utcTime']
            ],
        ];

        return $cert;
    }
}
