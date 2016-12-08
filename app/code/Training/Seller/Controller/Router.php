<?php

namespace Training\Seller\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{

    protected $actionFactory;

    public function __construct(ActionFactory $actionFactory)
    {
       $this->actionFactory = $actionFactory;
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        if ($request->getPathInfo() == '/sellers.html') {
            $request->setPathInfo('/seller/seller/index');
            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }

        if (preg_match('%^/seller/(.*?)\.html$%', $request->getPathInfo(), $match)) {
            $request->setPathInfo(sprintf('/seller/seller/view/identifier/%s', $match[1]));
            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }
    }
}