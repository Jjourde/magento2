<?php

namespace Training\Helloworld\Observer;

use Magento\Framework\Event\ObserverInterface;
use \Psr\Log\LoggerInterface;

class PredispatchLogUrl implements ObserverInterface
{
    private $loggerInterface;

    public function __construct(LoggerInterface $loggerInterface)
    {
        $this->loggerInterface = $loggerInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var $request \Magento\Framework\App\Request\Http */
        $request = $observer->getRequest();
        $this->loggerInterface->debug($request->getPathInfo());
    }
}