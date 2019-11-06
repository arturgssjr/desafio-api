<?php

namespace Hmac\Factory;

use Zend\EventManager\Event;

class EventFactory 
{
    /**
     * @var Event
     */
    private static $event = null;
    
    /**
     * Disable constructor
     */
    private function __construct() { }
    
    /**
     * @return Zend\EventManager\Event
     */
    public static function getInstance()
    {
        if(null === self::$event) {
            throw new \Exception('Event is not set');
        }
        return self::$event;
    }
    /**
     * @param Event
     */
    public static function setInstance(Event $sm)
    {
        self::$event = $sm;
    }
}