<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 06/12/16
 * Time: 16:59
 */
namespace Training\Helloworld\Rewrite;

class Product extends \Magento\Catalog\Model\Product
{
    public function getName()
    {
        return parent::getName() . ' Hello world';
    }
}