<?php

namespace Training\Seller\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Url extends AbstractHelper
{
    /**
     * @return string
     */
    public function getSellersUrl()
    {
        return '/sellers.html';
    }

    /**
     * @param string $identifier
     * @return string
     */
    public function getSellerUrl($identifier)
    {
        return '/seller/' . $identifier . '.html';
    }
}