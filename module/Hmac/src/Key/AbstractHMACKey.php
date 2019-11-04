<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hmac\Key;

use RB\Sphinx\Hmac\Key\HMACKey;

/**
 * Description of AbstractHMACKey
 *
 * @author Paulo Filipe Macedo dos Santos <paulo.santos@solutinet.com.br>
 */
abstract class AbstractHMACKey extends HMACKey
{
    
    public function getConfig(){
        return \Hmac\Factory\ServiceLocatorFactory::getInstance()->get('configuration');
    }
    
    public function getServiceLocator(){
        return \Hmac\Factory\ServiceLocatorFactory::getInstance();
    }
    
    public function getEvent(){
         return \Hmac\Factory\EventFactory::getInstance();
    }
    
    public function getObjectManager(){
        return \Hmac\Factory\ServiceLocatorFactory::getInstance()->get('doctrine.entitymanager.orm_default');
    }
}
