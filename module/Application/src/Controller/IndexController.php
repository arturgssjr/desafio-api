<?php

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014-2016 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use ZF\Apigility\Admin\Module as AdminModule;
use RB\Sphinx\Hmac\Zend\Server\HMACServerHelper;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        if (class_exists(AdminModule::class, false)) {
            return $this->redirect()->toRoute('zf-apigility/ui');
        }
        return new ViewModel();
    }

    /**
     * A configuração requer autenticação HMAC por Header (sem sessão) para este Action
     * @return \Zend\View\Model\JsonModel
     */
    public function headerAction()
    {
        return new JsonModel(array(
            'datetime' => date('r'),
            'plugin' => array(
                'id' => $this->HMACKeyId(),
                'hmac' => $this->HMACAdapter()->getHmacDescription(),
            ),
            'helper' => array(
                'id' => HMACServerHelper::getHmacKeyId($this->getEvent()),
                'hmac' => HMACServerHelper::getHmacAdapter($this->getEvent())->getHmacDescription()
            )
        ));
    }

    /**
     * A configuração requer autenticação HMAC por Header (COM sessão) para este Action
     * @return \Zend\View\Model\JsonModel
     */
    public function sessionAction()
    {
        return new JsonModel(array(
            'datetime' => date('r'),
            'plugin' => array(
                'id' => $this->HMACKeyId(),
                'hmac' => $this->HMACAdapter()->getHmacDescription(),
            ),
            'helper' => array(
                'id' => HMACServerHelper::getHmacKeyId($this->getEvent()),
                'hmac' => HMACServerHelper::getHmacAdapter($this->getEvent())->getHmacDescription()
            )
        ));
    }

    /**
     * A configuração requer autenticação HMAC na URI (sem sessão) para este Action
     * @return \Zend\View\Model\JsonModel
     */
    public function uriAction()
    {
        return new JsonModel(array(
            'datetime' => date('r'),
            'plugin' => array(
                'id' => $this->HMACKeyId(),
                'hmac' => $this->HMACAdapter()->getHmacDescription(),
            ),
            'helper' => array(
                'id' => HMACServerHelper::getHmacKeyId($this->getEvent()),
                'hmac' => HMACServerHelper::getHmacAdapter($this->getEvent())->getHmacDescription()
            )
        ));
    }
}
