<?php

namespace Album\Listener;
use Zend\Log\Writer\Stream;
use Zend\Log\Logger;

class Logging {
    public static function logOutput($event) {
        $logdir = dirname(__DIR__) . "/../../data/logs/";
        $stream = @fopen($logdir . "logs.log", 'a', false);
        if (!$stream) {
            $log->info('failed to open stream');
            throw new \Exception('Failed to open stream');
        }
        $writer = new Stream($stream);
        $logger = new Logger();
        $logger->addWriter($writer);
        switch ($event->getName()) {
            case 'isValid.pre':
                list($id, $title, $artist, $submit) = array_values ($event->getParams());
                $message = sprintf("Validating fields title: %s , artist: %s", $title, $artist, $event->getParam('id'));
                $logger->info($message);
                break;
            case 'isValid.post':
                list($id, $title, $artist, $submit, $isValid) = array_values ($event->getParams());
                $valid = $isValid ? 'valid' : 'invalid';
                $message = sprintf("The fields title: %s , artist: %s are %s", $title, $artist, $valid);
                $logger->info($message);
                break;
        }
        
    }
}